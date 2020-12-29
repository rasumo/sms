<?php

namespace Rasumo\Sms;

use Rasumo\Sms\Drivers\FlowrouteDriver;
use Rasumo\Sms\Drivers\RoutemobileDriver;

class Sms
{
    protected $driver;
    /** @var string */
    protected $access_key;
    /** @var string */
    protected $secret_key;
    /** @var string */
    protected $from;

    /**
     * Create an instance.
     *
     * @param array $config
     * @return void
     */
    public function __construct(array $config)
    {
        $this->access_key = $config['access_key'];
        $this->secret_key = $config['secret_key'];
        $this->from = $config['from'];
        $this->driver = $config['driver'];
    }
    /**
     * Number SMS is being sent from.
     *
     * @return string
     */
    public function from()
    {
        return $this->from;
    }

    public function getAuth()
    {
        return [
            $this->access_key,
            $this->secret_key,
        ];
    }

    public function getDriver()
    {
        switch ($this->driver) {
            case 'flowroute':
                return new FlowrouteDriver($this);
            case 'routemobile':
                return new RoutemobileDriver($this);
        }
    }

    public function accessKey()
    {
        return $this->access_key;
    }

    public function secretKey()
    {
        return $this->secret_key;
    }
}