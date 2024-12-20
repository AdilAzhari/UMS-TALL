<?php

class Node
{
    public int $data;

    public ?Node $left;  // Explicitly specify that left can be Node or null

    public ?Node $right; // Explicitly specify that right can be Node or null

    public function __construct(int $value)
    {
        $this->data = $value;
        $this->left = null;
        $this->right = null;
    }

    public function insert(int $value): Node
    {
        if ($value <= $this->data) {
            if ($this->left === null) {
                $this->left = new Node($value);

                return $this->left;
            } else {
                return $this->left->insert($value);
            }
        } else {
            if ($this->right === null) {
                $this->right = new Node($value);

                return $this->right;
            } else {
                return $this->right->insert($value);
            }
        }
    }
}

// Create a new Node with the root value of 10
$a = new Node(10);
// $a->insert(9);
$a->insert(220);

// Output the data of the root node
echo $a->data;
