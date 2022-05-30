<?php

namespace app\service;

use JsonSerializable;

class Res implements JsonSerializable
{
    private int $code;
    private string $message;
    private array $data;

    /**
     * Res constructor.
     * @param int $code
     * @param string $message
     * @param array $data
     */
    public function __construct(int $code, string $message, array $data = [])
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function jsonSerialize() : mixed
    {
        // TODO: Implement jsonSerialize() method.
        return ["code" => $this->code, "msg" => $this->message, "data" => $this->data];
    }
}