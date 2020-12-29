<?php

namespace Rasumo\Sms;

use Illuminate\Notifications\Notification;

class SmsChannel
{
    protected $sms;

    public function __construct(Sms $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\Flowroute\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $this->sms->getDriver()->prepareAndSend($notifiable, $notification);
    }
}