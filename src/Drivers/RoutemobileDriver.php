<?php

namespace Rasumo\Sms\Drivers;

use Rasumo\Sms\SmsMessage;
use Rasumo\Sms\Exceptions\CouldNotSendNotification;

class RoutemobileDriver extends Driver
{	
    protected $apiBase = 'https://api.rmlconnect.net/bulksms/bulksms';

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\Flowroute\Exceptions\CouldNotSendNotification
     */
    public function send(array $payload)
    {
        $response = $this->guzzleClient->get($this->apiBase, [
            'query' => $payload
        ]);

        if (!in_array($response->getStatusCode(), [200, 201])) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }

    protected function getPayload(string $to, SmsMessage $message)
    {
        return [
            'source'  => $message->from ?: $this->from,
            'destination'    => $to,
            'message'  => $message->getBody(),
            'type' => '0',
            'dlr' => '0',
            'username' => $this->sms->accessKey(),
            'password' => $this->sms->secretKey()
        ];
    }
}