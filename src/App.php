<?php

namespace Test;

use Exception;

class App
{
    const INDEX_FILE = 'binaryTree.index';
    const DATA_FILE = 'dataSource.json';

    public array $arg;
    public array $data;

    public function __construct($arg)
    {
        $this->arg = $arg;
        $dataJson = file_get_contents(self::DATA_FILE);
        $this->data = json_decode($dataJson, true);
    }

    /**
     * @throws Exception
     */
    private function build()
    {
        $field = $this->arg[2] ?? false;
        if (!$field) {
            throw new Exception('field not found');
        }
        $binaryTree = new BinaryTree();
        foreach ($this->data as $item) {
            if (isset($item[$field])) {
                $binaryTree->append($item[$field]);
            }
        }
        $this->saveBinaryTree($binaryTree);
        echo "done\n";
    }

    /**
     * @throws Exception
     */
    private function binarySearch()
    {
        $search = $this->arg[2] ?? false;
        if (!$search) {
            throw new Exception('search arg not found');
        }

        $binaryTree = $this->loadBinaryTree();
        $binaryTreeSearch = new BinaryTreeSearch();
        if ($node = $binaryTreeSearch->find($search, $binaryTree->getNode())) {
            $this->say('find - ' . $node->getValue());
            $this->say("$binaryTreeSearch->iteration iteration");
        } else {
            $this->say('not found');
        }
    }

    private function simpleSearch()
    {
        $field = $this->arg[2] ?? false;
        if (!$field) {
            throw new Exception('field arg not found');
        }

        $search = $this->arg[3] ?? false;
        if (!$search) {
            throw new Exception('search arg not found');
        }

        $simpleSearch = new SimpleSearch();
        if ($result = $simpleSearch->find($search, $this->data, $field)) {
            $this->say('find - ' . $result);
            $this->say("$simpleSearch->iteration iteration");
        } else {
            $this->say('not found');
        }
    }

    public function run()
    {
        try {
            switch ($this->arg[1] ?? false) {
                case 'build':
                    $this->build();
                    break;
                case 'binary_search':
                    $this->binarySearch();
                    break;
                case 'simple_search':
                    $this->simpleSearch();
                    break;
                default:
                    $this->say('action not found');
            }
        } catch (Exception $e) {
            $this->say("Oops\n" . $e->getMessage());
        }
    }

    private function saveBinaryTree(BinaryTree $binaryTree)
    {
        file_put_contents(self::INDEX_FILE, serialize($binaryTree));
    }

    /**
     * @throws Exception
     */
    private function loadBinaryTree() : BinaryTree
    {
        if (!file_exists(self::INDEX_FILE)) {
            throw new Exception('index file not found');
        }
        return unserialize(file_get_contents(self::INDEX_FILE));
    }

    private function say(string $msg)
    {
        echo $msg . "\n";
    }
}