<?php

namespace RihabRahman\BulkSmsBD\Events;

class SmsDelivered
{
    public $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
