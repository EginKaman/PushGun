<?php

namespace App\Console\Commands;

use App\Services\SmsExpectoService;
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
        $expecto = new SmsExpectoService();
        $messages = SmsMessage::where([
            [
                'is_sent', 0
            ],
            [
                'is_confirmed', 1
            ]
        ])->whereBetween('date_send', [
            $now,
            $to
        ])->orWhere('date_send', null)->with(['contacts', 'addressbook', 'addressbook.contacts', 'user'])->get();
        $price = config('app.sms_price');
        foreach ($messages as $message) {
            if ($message->user->balance === 0) {
                return;
            }
            if ($message->contacts) {
                foreach ($message->contacts as $contact) {
                    if ($message->user->balance < $price) {
                        return;
                    }
                    $msg = $expecto->send($contact->address, $message->text, 'Expecto');
                    $this->info($msg);
                    $message->user->balance -= $price;
                    $message->user->save();
                }
            } else if ($message->addressbook->contacts) {
                foreach ($message->addressbook->contacts as $contact) {
                    if ($message->user->balance < $price) {
                        return;
                    }
                    $msg = $expecto->send($contact->address, $message->text, 'Expecto');
                    $this->info($msg);
                    $message->user->balance -= $price;
                    $message->user->save();
                }
            }
        }
        return 1;
    }
}
