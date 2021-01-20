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
    protected $description = '
    Receives push notifications every N minutes';

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
        $week = strtolower($dateFrom->format('l'));
        echo "{$week} \n";
        $from = $dateFrom->isoFormat('hh:mm:ss');
        $to = Carbon::now()->addMinutes(40)->isoFormat('hh:mm:ss');
        echo "{$from} - {$to} \n";
        // ->whereBetween('time', [$from, $to])
        $mailings = AutoMailing::where("$week", 1)->get();
        $pushes = [];
        foreach ($mailings as $mailing) {
            $push = $mailing->push()->with('site')->first();
            $message = new SendPush();
            $message->title($push->title)->icon(asset(Storage::url($push->icon ?? $push->site->image)));
            if ($push->image !== null) {
                $message->image(asset(Storage::url($push->image)));
            }
            $message->body($push->text)
                ->url(route('transition.store', $push));
            $push->site->notify($message);
            echo 'success';
        }
        return 0;
    }
}
