<?php

namespace App\Exports;

use App\AddressBook;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class EmailSenderExport implements FromView, ShouldAutoSize, WithTitle
{
    private $users;
    /**
     * @var array
     */
    private $input;

    public function __construct($emailSenders)
    {
        $this->emailSenders = $emailSenders;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('exports.emailSender', [
            'emailSenders' => $this->emailSenders
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return "Адрес отправителя - ";
    }
}
