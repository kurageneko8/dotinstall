<?php

class Post 
{
    public $text;
    public $likes;

    public function show()
    {
        printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
        echo nl2br("\n");
    } 
}

$posts = [];
// $posts[0] = ['text' => 'hello','likes' => 0];
$posts[0] = new Post();
$posts[0]->text = 'hello';
$posts[0]->likes = 0;
$posts[1] = new Post();
$posts[1]->text = 'hello again';
$posts[1]->likes = 0;
// $posts[1] = ['text' => 'hello again','likes' => 0];

$posts[0]->show();
$posts[1]->show();