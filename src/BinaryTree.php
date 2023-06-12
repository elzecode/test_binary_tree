<?php

namespace Test;

use Exception;

class BinaryTree extends Helper
{
    private ?BinaryNode $root = null;

    public function getNode() : ?BinaryNode
    {
        return $this->root;
    }

    /**
     * @throws Exception
     */
    public function append($key): BinaryTree
    {
        $appendNode = new BinaryNode($key);
        $this->appendBinaryNode($appendNode, $this->root);
        return $this;
    }

    /**
     * @throws Exception
     */
    private function appendBinaryNode(BinaryNode $appendNode, ?BinaryNode &$rootNode)
    {
        if ($rootNode === null) {
            $rootNode = $appendNode;
        } else {
            if ($this->compare($appendNode->getValue(), $rootNode->getValue())) {
                $this->appendBinaryNode($appendNode, $rootNode->getRightNode());
            }
            if ($this->compare($rootNode->getValue(), $appendNode->getValue())) {
                $this->appendBinaryNode($appendNode, $rootNode->getLeftNode());
            }
        }
    }
}