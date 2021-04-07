<?php

namespace App\Console\Commands;

use App\EmailMailing;
use App\Mail\EmailMailing as MailEmailMailing;
use App\SentLetter;
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
        ])->orWhere('date_send', null)->with(['emailMessage', 'addressBook', 'user'])->get();
        foreach ($emailmailings as $emailmailing) {
            foreach ($emailmailing->addressbook->contacts as $contact) {
                if ($contact->is_email) {
                    $when = $emailmailing->date_send === null ?  $now : $emailmailing->date_send;
                    Mail::to($contact->address)->send(new MailEmailMailing(
                        $emailmailing->emailmessage->body
                    ));
                    $sentLetter = new SentLetter;
                    $sentLetter->user()->associate($emailmailing->user);
                    $sentLetter->contact()->associate($contact);
                    $sentLetter->emailMessage()->associate($emailmailing->emailmessage);
                    $sentLetter->save();
                }
            }
            // Mail::to($)->send(new MailableClass);
            $emailmailing->is_sent = true;
            $emailmailing->save();
        }
        return 1;
    }
}
