<?php

namespace App\Console\Commands;

use App\Notifications\User\Payment;
use App\User;
use Illuminate\Console\Command;

class ExpiredTariff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tariff:notify-expired';

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
        $users = User::whereBetween('tariff_expired_at', [
            now()->subDays(7)->startOfDay(),
            now()->subDays(7)->endOfDay()
        ])->orWhereBetween('tariff_expired_at', [
            now()->subDays(3)->startOfDay(),
            now()->subDays(3)->endOfDay()
        ])->orWhereBetween('tariff_expired_at', [
            now()->subDays(1)->startOfDay(),
            now()
        ])->get();
        $users->each(function ($user) {
            $user->notify(new \App\Notifications\ExpiredTariff());
        });
        return 0;
    }
}
