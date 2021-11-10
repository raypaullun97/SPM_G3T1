<?php 
#DONE BY JIA XIANG
require './model/PostDAO.php';

class PostTest extends \PHPUnit\Framework\TestCase
{   
    public function testAddPost()
    {
        $post = new PostDAO();
        $status = $post->add('5', 'Testing', '1', '13:00:05', '2012-11-05');
        $this->assertEquals(true, $status);

        $dsn = "mysql:host=127.0.0.1;dbname=lms;port=8888";
        $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
        $sql = 'delete from post where thread_id = "5" and engineer_id = "1" and post_time = "13:00:05" and post_date = "2012-11-05"';
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $stmt = null;
        $pdo = null;

    }
}
