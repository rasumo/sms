<?php

namespace Rasumo\Sms\Drivers;

use Rasumo\Sms\SmsMessage;
use Rasumo\Sms\Exceptions\CouldNotSendNotification;

class FlowrouteDriver extends Driver
{	
    protected $apiBase = 'https://api.flowroute.com/v2/messages';

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
        $response = $this->guzzleClient->post($this->apiBase, [
            'auth' => $this->sms->getAuth(),
            'json' => $payload,
        ]);

        if (!in_array($response->getStatusCode(), [200, 201])) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }

    protected function getPayload(string $to, SmsMessage $message)
    {
        return [
            'from'  => $message->from ?: $this->from,
            'to'    => $to,
            'body'  => $message->getBody(),
        ];
    }
}