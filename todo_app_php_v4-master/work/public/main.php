<?php

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
    
    $message = 'Merci';
    $likes = 8;
    $stmt = $pdo->prepare(
        "insert into 
            posts (message, likes)
        Values
            (:message, :likes)"
    );
    $stmt->bindParam('message', $message,PDO::PARAM_STR);
    $stmt->bindParam('likes', $likes,PDO::PARAM_INT);
    $stmt->execute();

    $message = 'Gracias';
    $likes = 5;
    $stmt->execute();

    $message = 'Danke';
    $likes = 11;
    $stmt->execute();

    $stmt = $pdo->query("select * from posts");
    $posts = $stmt->fetchAll();
    foreach ($posts as $key => $post) {
        echo '<pre>';

        printf(
            '%s (%d)' . PHP_EOL,
            $post['message'],
            $post['likes']
        );
        echo '</pre>';

    }
    // echo '<pre>';
    // var_dump($);
    // echo '</pre>';

} catch (PDOException $e) {
    echo $e->getMessage() . PHP_EOL;
    exit;
}