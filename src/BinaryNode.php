<?php

namespace Test;

class BinaryNode
{
    private $value;
    protected ?BinaryNode $leftNode = null;
    protected ?BinaryNode $rightNode = null;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function &getLeftNode() : ?BinaryNode
    {
        return $this->leftNode;
    }

    public function &getRightNode() : ?BinaryNode
    {
        return $this->rightNode;
    }
}