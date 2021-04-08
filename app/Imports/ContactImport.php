<?php

namespace App\Imports;

use App\Contact;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ContactImport implements ToModel, ShouldQueue, WithChunkReading
{

    public function __construct($addressbook)
    {
        $this->addressbook = $addressbook;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!isset($row[0])) {
            return null;
        }
        $validator = Validator::make(['email' => $row[0]], [
            'email' => ['required', 'email']
        ]);
        if (!$validator->passes()) {
            return;
        }
        return new Contact([
            'address' => $row[0],
            'is_email' => true,
            'address_book_id' => $this->addressbook
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
