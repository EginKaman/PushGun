<?php

namespace App\Console\Commands;

use App\SmsMessage;
use Carbon\Carbon;
use Illuminate\Console\Command;

class runSmsMailings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:smsmailings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $now = Carbon::now();
        $to = Carbon::now()->addMinutes(5);
        $messages = SmsMessage::where('is_sent', 0)->whereBetween('date_send', [
            $now,
            $to
        ])->orWhere('date_send', null)->with(['contacts', 'addressbook', 'user'])->get();
        foreach ($messages as $message) {
        }
        return 0;
    }
}
