<?php

namespace App\Exports;

use App\AddressBook;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class AddressBookExport implements FromView, ShouldAutoSize, WithTitle
{
    private $users;
    /**
     * @var array
     */
    private $input;

    public function __construct(AddressBook $addressbook)
    {
        $this->addressbook = $addressbook;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('exports.addressbook', [
            'addressbook' => $this->addressbook
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return "Адресная книга - " . $this->addressbook->name;
    }
}
