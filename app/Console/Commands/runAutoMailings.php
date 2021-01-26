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
        $mailings = AutoMailing::where($week, 1)
            ->whereBetween('time', [
                $from,
                $to
            ])
            ->get();
        $mailings->each(function ($mailing) {
            $mailing->push = $mailing->push()->with('sites')->first();
            foreach ($mailing->push->sites as $site) {
                $message = new SendPush();
                $message->title($mailing->push->title)
                    ->icon(asset(Storage::url($mailing->push->icon ?? $site->image)));
                if ($mailing->push->image !== null) {
                    $message->image(asset(Storage::url($mailing->push->image)));
                }
                $message->body($mailing->push->text)
                    ->url(route('transition.store', $mailing->push));
                $when = Carbon::parse($mailing->time);
                $this->info($when);
                $site->notify(($message)->delay($when));
                $this->info('success');
            }
        });
        return 0;
    }
}
