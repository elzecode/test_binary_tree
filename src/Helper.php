<?php

namespace Test;

use Exception;

abstract class Helper
{
    /**
     * @throws Exception
     */
    public function compare($left, $right) : bool {
        if (gettype($left) != gettype($right)) {
            throw new Exception('type in field not equal');
        }
        if (gettype($left) == "string") {
            return strcmp($left, $right) > 0;
        }
        return $left > $right;
    }
}