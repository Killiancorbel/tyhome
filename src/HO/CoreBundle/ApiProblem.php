<?php

namespace HO\CoreBundle;

class ApiProblem {
    private $statusCode;
    private $type;
    private $title;
    private $extraData = array();

    public function __construct($statusCode, $type = "validation_error", $title = "There was a validation error")
    {
        $this->statusCode = $statusCode;
        $this->type = $type;
        $this->title = $title;
    }

    public function set($name, $value)
    {
        $this->extraData[$name] = $value;
    }

    public function toArray()
    {
        return array_merge(
            $this->extraData,
            array(
                'status' => $this->statusCode,
                'type' => $this->type,
                'title' => $this->title,
            )
        );
    }
}