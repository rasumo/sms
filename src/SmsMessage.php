<?php

namespace Rasumo\Sms;

class SmsMessage
{
    /**
     * The message content.
     *
     * @var string
     */
    public $content;
    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $from;

    /**
     * The view to use to render this message.
     *
     * @var string
     */
    public $view;

    /**
     * The data to pass to the view.
     *
     * @var array
     */
    public $data = [];

    /**
     * Create a new message instance.
     *
     * @param  string $content
     *
     * @return static
     */
    public static function create($content = '')
    {
        return new static($content);
    }

    /**
     * Create a new message instance.
     *
     * @param  string  $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param  string  $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Set the phone number the message should be sent from.
     *
     * @param  string  $from
     *
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    public function view($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;

        return $this;
    }

    public function getBody()
    {
        if ($this->content) {
            return trim($this->content);
        }

        if ($this->view) {
            return view($this->view, $this->data)->render();
        }
    }
}