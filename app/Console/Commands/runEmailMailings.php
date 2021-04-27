<?php

namespace App\Console\Commands;

use App\EmailMailing;
use App\Mail\EmailMailing as MailEmailMailing;
use App\TariffEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class runEmailMailings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:emailmailings';

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
        // $this->info("$now - $to");
        $emailmailings = EmailMailing::where('is_sent', 0)->whereBetween('date_send', [
            $now,
            $to
        ])->orWhere('date_send', null)->with(['emailMessage', 'addressBook', 'user', 'user.tariffEmail', 'emailSender'])->get();

        foreach ($emailmailings as $emailmailing) {
            $emails = [];
            $actualTariff = $emailmailing->user->getActualEmailTariff();
            if ($actualTariff) {
                if (count($emailmailing->addressbook->contacts) > $actualTariff->max_contacts) {
                    // если кол-во контактов превышает максимум тарифного плана
                    return;
                }
                foreach ($emailmailing->addressbook->contacts as $contact) {
                    if ($contact->is_email) {
                        $when = $emailmailing->date_send === null ?  $now : $emailmailing->date_send;
                        $emails[] = $contact->address;
                    }
                }
                Mail::to($emails)->send(new MailEmailMailing($emailmailing->emailmessage->body, $emailmailing->emailSender->address));
                $emailmailing->is_sent = true;
                $emailmailing->number_of_not_sent = count(Mail::failures());
                $emailmailing->number_of_sent = count($emails) - $emailmailing->number_of_not_sent;
                $emailmailing->save();
            }
        }
        return 1;
    }
}
