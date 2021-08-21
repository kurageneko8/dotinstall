<?php

require('Post.php');

try {
    $posts[0] = new Post('!');
    $posts[1] = new Post('hello again');
    
    foreach ($posts as $post) {
        $post->show();
    }
} catch (Exception $e) {
    echo $e->getMessage() . nl2br(PHP_EOL);
}