<?php

namespace App\Helpers;

class SetColumnParamUpdate
{
    public array $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __toString(): string
    {
        $columns = '';

        foreach ($this->data as $column => $value) {
            $columns .= "$column = '$value', ";
        }

       return trim($columns,', ' );
    }
}