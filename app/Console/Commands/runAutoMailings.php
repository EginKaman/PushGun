<?php

namespace App\Console\Commands;

use App\AutoMailing;
use App\Notifications\SendPush;
use App\Push;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class runAutoMailings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:automailings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Receives push notifications every N minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateFrom = Carbon::now();
        $week = $dateFrom->format('l');
        $this->info("{$week} \n");
        $from = $dateFrom->isoFormat('HH:mm:ss');
        $to = now()->addMinutes(5)->isoFormat('HH:mm:ss');
        $this->info("{$from} - {$to}");
        $mailings = AutoMailing::where([
            [$week, 1],
            ['status_id', 1]
        ])
            ->whereBetween('time', [
                $from,
                $to
            ])
            ->get();
        $mailings->each(function ($mailing) {
            $pushes = $mailing->pushes()->with('sites')->get();
            $sites = $mailing->sites()->get();
            $mailing->series += 1;
            $mailing->save();
            $prevSendTime = null;
            foreach ($pushes as $push) {
                // тут создается messange
                $message = new SendPush();
                if ($push->image !== null) {
                    $message->image(asset(Storage::url($push->image)));
                }
                $message->body($push->text)
                    ->url(route('transition.store', $push));
                $when = null;
                if ($prevSendTime !== null) {
                    $when = $prevSendTime;
                    if ($push->time_id === 1) {
                        $when->addMinutes($push->delay);
                    } else if ($push->time_id === 2) {
                        $when->addHours($push->delay);
                    } else if ($push->time_id === 3) {
                        $when->addDays($push->delay);
                    }
                } else {
                    if ($push->time_id === 1) {
                        $when = Carbon::parse($mailing->time)->addMinutes($push->delay);
                    } else if ($push->time_id === 2) {
                        $when = Carbon::parse($mailing->time)->addHours($push->delay);
                    } else if ($push->time_id === 3) {
                        $when = Carbon::parse($mailing->time)->addDays($push->delay);
                    }
                }
                $prevSendTime = $when;
                // $this->info("prev: {$prevSendTime}");
                // $this->info("when: {$when}");
                foreach ($sites as $site) {
                    // оправляется
                    $message->title($push->title)
                        ->icon(asset(Storage::url($push->icon ?? $site->image)));
                    $site->notify(($message)->delay($when));
                    $this->info("
                        Site_id: {$site->id}
                        Push_id: {$push->id}
                        Time: {$when}
                    ");
                }
            }
        });
        return 0;
    }
}
