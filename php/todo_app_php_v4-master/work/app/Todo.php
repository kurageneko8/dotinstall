<?php

class Todo
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        Token::create();        
    }

    public function processPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Token::validate();
            $action = filter_input(INPUT_GET, 'action');

            switch ($action) {
                case 'add':
                    $this->add();
                    break;

                case 'toggle':
                    $this->toggle();
                    break;

                case 'delete':
                    $this->delete();
                    break;

                default:
                    exit;
            }


            header('Location: ' . SITE_URL);
            exit;
        }
    }

    private function add()
    {
        $title = trim(filter_input(INPUT_POST, 'title'));
        if ($title === '') {
            return;
        }

        $stmt = $this->pdo->prepare("insert into todos (title) values (:title)");
        $stmt->bindValue('title', $title, PDO::PARAM_STR);
        $stmt->execute();
    }

    private function toggle()
    {
        $id = filter_input(INPUT_POST, 'id');
        if (empty($id)) {
            return;
        }

        $stmt = $this->pdo->prepare("update todos set is_done = NOT is_done where id = :id");
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function delete()
    {
        $id = filter_input(INPUT_POST, 'id');
        if (empty($id)) {
            return;
        }

        $stmt = $this->pdo->prepare("delete from todos where id = :id");
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("select * from todos order by id desc");
        $todos = $stmt->fetchAll();
        return $todos;
    }
}
