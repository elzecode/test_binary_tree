<?php

namespace Test;

use Exception;

class BinaryTreeSearch extends Helper
{
    public int $iteration = 0;

    /**
     * @throws Exception
     */
    public function find($value, ?BinaryNode $binaryNode) : ?BinaryNode
    {
        $this->iteration++;

        if (!$binaryNode) {
            return null;
        }

        if ($value === $binaryNode->getValue()) {
            return $binaryNode;
        } else {
            if ($this->compare($value, $binaryNode->getValue())) {
                return $this->find($value, $binaryNode->getRightNode());
            }
            if ($this->compare($binaryNode->getValue(), $value)) {
                return $this->find($value, $binaryNode->getLeftNode());
            }
        }

        return null;
    }
}