<?php

namespace Framework\Response;

use Framework\Helper\JSON;

class JSONResponse
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function __toString()
    {
        return JSON::Encode($this->data);
    }
}