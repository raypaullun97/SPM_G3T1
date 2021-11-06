<?php 
require './model/ThreadDAO.php';

class ThreadTest extends \PHPUnit\Framework\TestCase
{   
    public function testAddThread()
    {
        $thread = new ThreadDAO();
        $status = $thread->add('100', 'Testing TDD', '1');
        $this->assertEquals(true, $status);

        $dsn = "mysql:host=127.0.0.1;dbname=lms;port=3306";
        $pdo = new PDO($dsn,"root",'');
        $sql = 'delete from thread where forum_id = "100" and description = "Testing TDD" and engineer_id = "1"';
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $stmt = null;
        $pdo = null;

    }
}
