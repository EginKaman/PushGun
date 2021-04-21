<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\SmsMessage;
use Illuminate\Console\Command;
use Nexmo\Laravel\Facade\Nexmo;

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
        ])->orWhere('date_send', null)->with(['contacts', 'addressbook','addressbook.contacts', 'user'])->get();
        foreach ($messages as $message) {
            if($message->contacts) {
                foreach($message->contacts as $contact) {
                    Nexmo::message()->send([
                        'to' => $contact->address,
                        'from' => $message->sender_name,
                        'text' => $message->text,
                        'type' => 'unicode'
                    ]);
                }
            } else if ($message->addressbook->contacts) {
                foreach($message->addressbook->contacts as $contact) {
                    Nexmo::message()->send([
                        'to' => $contact->address,
                        'from' => $message->sender_name,
                        'text' => $message->text,
                        'type' => 'unicode'
                    ]);
                }
            }
        }
        return 1;
    }
}
