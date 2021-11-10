<?php 
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
    
    $id = $_GET['course_id'];

    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    
    $sql = 'delete from course where course_id = :course_id';
    $stmt1 = $pdo->prepare($sql);
    $stmt1->bindParam(":course_id",$id);
    
    $delStatus = $stmt1->execute();
    $stmt1 = null;
    $pdo = null;
    
    if ($delStatus)
    {
        header('location:admin_view_course.php');
    }

?>
