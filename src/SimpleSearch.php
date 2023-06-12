<?php

namespace Test;

class SimpleSearch
{
    public int $iteration = 0;

    public function find($value, $data, $field)
    {
        foreach ($data as $item) {
            $this->iteration++;
            if (!isset($item[$field])) {
                continue;
            }
            if ($item[$field] == $value) {
                return $value;
            }
        }

        return null;
    }
}