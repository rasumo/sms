<?php

namespace Rasumo\Sms\Drivers;

use Rasumo\Sms\Sms;
use GuzzleHttp\Client;
use Rasumo\Sms\SmsMessage;
use Illuminate\Notifications\Notification;

abstract class Driver
{

    protected $guzzleClient;
    
    protected $sms;

    protected $from;

	const SUCCESS = 200;
    const INVALID_URL = 1001;
	const MISSING_PARAMS = 1001;
    const INVALID_CREDENTIALS = 1002;
	const INVALID_RECIPIENT = 1003;
	const INVALID_SENDER = 1004;
    const INVALID_MESSAGE = 1005;
	const INVALID_TYPE = 1006; 
    const INVALID_DELIVERY = 1007;
    const INSUFFICIENT_CREDIT = 1008;
	const RESPONSE_TIMEOUT = 1009;
    const INTERNAL_ERROR = 1010;
    const ACCOUNT_SUSPENDED = 1011;
    
    public function __construct(Sms $sms)
    {
        $this->guzzleClient = new Client();
        $this->sms = $sms;
        $this->from = $sms->from();
    }

    public function prepareAndSend($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('sms')) {
            return;
        }

        $message = $notification->toSms($notifiable);

        if (is_string($message)) {
            $message = new SmsMessage($message);
        }

        $payload = $this->getPayload($to, $message);

        $this->send($payload);
    }

    public function sendWithoutNotification($to, $message)
    {
        $message = new SmsMessage($message);

        $payload = $this->getPayload($to, $message);

        $this->send($payload);
    }

    abstract protected function getPayload(string $to, SmsMessage $message);
    abstract public function send(array $payload);
}