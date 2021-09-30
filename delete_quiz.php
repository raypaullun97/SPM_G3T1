<?php 
spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

function deleteQuiz($quiz_id)
{
    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
    $pdo = new PDO($dsn,"root",'');
    $sql = 'delete from quiz where quiz_id = :temp';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":temp", $quiz_id);
    $delStatus = $stmt->execute();
    $stmt = null;
    $pdo = null;
    
    return $delStatus;
}

    $quiz_id = $_GET['quiz_id'];
    $delStatus = deleteQuiz($quiz_id);

    if (delStatus)
    {
        header('Location: view_quiz.php');
    }
?>