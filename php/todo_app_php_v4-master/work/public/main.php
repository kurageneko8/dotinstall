<?php

class Post 
{
    public function show()
    {
        echo "$this->message ($this->likes)" . nl2br(PHP_EOL);
    }
}

try {
    $pdo = new PDO(
        'mysql:host=db;dbname=myapp;charset=utf8mb4',
        'myappuser',
        'myapppass',
        [
            pdo::ATTR_ERRMODE => pdo::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,                           
            pdo::ATTR_EMULATE_PREPARES => false,
        ]
    );

    $pdo->query("drop table if exists comments");// created mysql apply lessons
    $pdo->query("drop table if exists posts");
    
    $pdo->query(
        "create table posts (
            id INT not null auto_increment,
            message varchar(140),
            likes int,
            primary key (id)
        )"
    );

    $pdo->query("
        INSERT into posts (message, likes) values 
            ('Thanks', 12),
            ('thanks', 4),
            ('Arigato', 15)
    ");

    $pdo->beginTransaction();
    $stmt = $pdo->query(
        "update posts set likes = likes + 1 where id = 1"
    );
    
    $stmt = $pdo->query(
        // "update posts set likes = likes - 1 where id = 2"
        "update post set likes = likes - 1 where id = 2"
    );
    $pdo->commit();

} catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage() . PHP_EOL;
    // exit;
} finally {
    $stmt = $pdo->query("select * from posts");
    $posts = $stmt->fetchAll(PDO::FETCH_CLASS, 'Post');
    foreach ($posts as $key => $post) {
        $post->show();
    }
}