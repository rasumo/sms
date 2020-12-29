<?php

namespace Rasumo\Sms;

use Illuminate\Support\ServiceProvider;
use Rasumo\Sms\Console\Commands\SmsSendCommand;

class SmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sms.php' => config_path('sms.php')
            ], 'config');

            $this->commands([
                SmsSendCommand::class,
            ]);
        }
        
        $this->app->when(SmsChannel::class)
            ->needs(Sms::class)
            ->give(function () {
                return new Sms(config('sms'));
            });
    }
}