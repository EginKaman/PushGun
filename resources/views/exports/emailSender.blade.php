<table class="iksweb">
    <tbody>
        <tr>
            <td>Email адрес </td>
            <td>Имя</td>
            <td>Состояние</td>
        </tr>
        @foreach ($emailSenders as $emailSender)
            <tr>
                <td style="text-align: left">{{ $emailSender->address }}</td>
                <td style="text-align: left">{{ $emailSender->name }}</td>
                <td style="text-align: left">
                    {{ $emailSender->status ? 'Активно' : 'Не активно' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
