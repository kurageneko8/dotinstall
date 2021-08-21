<?php

interface LikeInterface
{
    public function like();
}

abstract class BasePost
{
    protected $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    abstract public function show();
}
class Post extends BasePost implements LikeInterface
{
   private $likes = 0;

   public function like()
   {
       $this->likes++;
   }
    
    public function show()
    {
        printf('%s (%d)' . nl2br(PHP_EOL), $this->text, $this->likes);
    } 

}

class SponsoredPost extends BasePost
{
    private $sponsor;

    public function __construct($text, $sponsor)
    {
        parent::__construct($text);
        $this->sponsor = $sponsor;
    }

    public function show()
    {
        printf('%s by %s' . nl2br(PHP_EOL), $this->text, $this->sponsor);
    } 
}


class PremiumPost extends BasePost implements LikeInterface
{
    private $price;
    private $likes = 0;

    public function like()
    {
        $this->likes++;
    }

    public function __construct($text, $price)
    {
        parent::__construct($text);
        $this->price = $price;
    }

    public function show()
    {
        printf('%s (%d) [%d JPY]' . nl2br(PHP_EOL), $this->text, $this->likes, $this->price);
    } 
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');
$posts[2] = new SponsoredPost('hello hello', 'dotinstall');
$posts[3] = new PremiumPost('hello hello', 300);

// $posts[0]->like();
// $posts[3]->like();

function processLikeable(LikeInterface $likeable)
{
    $likeable->like();
}

processLikeable($posts[0]);
processLikeable($posts[3]);

function processPost(BasePost $post)
{
    $post->show();
}

foreach ($posts as $key => $post) {
    processPost($post);
}
// $posts[0]->show();
// $posts[1]->show();
// $posts[2]->show();