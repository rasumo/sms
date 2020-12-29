<?php

namespace Rasumo\Sms\Console\Commands;

use Rasumo\Sms\Sms;
use Illuminate\Console\Command;

class SmsSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send {to} {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS';

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
     * @return mixed
     */
    public function handle()
    {
        $sms = new Sms(config('sms'));
        
        $sms->getDriver()->sendWithoutNotification(
            $this->argument('to'),
            $this->argument('message')
        );
    }
}