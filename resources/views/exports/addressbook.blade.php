<table class="iksweb">
    <tbody>
        <tr>
            <td>Номер</td>
            <td>Адрес</td>
        </tr>
        @foreach ($addressbook->contacts as $index => $contact)
            <tr>
                <td style="text-align: left">{{ $index + 1 }}</td>
                <td style="text-align: left">{{ $contact->address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
