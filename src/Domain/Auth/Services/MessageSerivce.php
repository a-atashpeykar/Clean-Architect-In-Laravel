<?php


namespace Domain\Auth\Services;


use Domain\Auth\Abstracts\MessageInterface;

class MessageSerivce
{
    private $message;

    public function __construct(MessageInterface $message)
    {
        $this->message = $message;
    }

    public function send(){
        return $this->message->fire();
    }
}
