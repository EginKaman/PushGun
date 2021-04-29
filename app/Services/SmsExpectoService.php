<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsExpectoService
{
    protected $url;

    protected $api_login;

    protected $api_password;

    public function __construct()
    {
        $this->url = config('services.smsexpecto.url');
        $this->api_login = config('services.smsexpecto.api_login');
        $this->api_password = config('services.smsexpecto.api_password');
    }

    public function url(string $profile): string
    {
        $segments = [
            $this->url,
            $profile
        ];
        return 'http://' . $this->api_login . ':' . $this->api_password . '@' . implode('/', $segments);
    }

    public function send(string $phone, string $text, string $sender  = 'Expecto'): string
    {
        $url = $this->url('send');
        $response = Http::get($url, [
            'phone' => $phone,
            'text' => $text,
            'sender' => $sender
        ]);
        return $response->body();
    }

    public function checkDispatchStatus(string $id): string
    {
        $url = $this->url('status');
        $response = Http::get($url, [
            'id' => $id
        ]);
        return $response->body();
    }
}
