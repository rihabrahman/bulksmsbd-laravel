<?php

namespace RihabRahman\BulkSmsBD\Events;

class SmsFailed
{
    public $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
