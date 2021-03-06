<?php 
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
    
    $id = $_GET['section_id'];
    $class_id = $_GET['class_id'];
    $course_id = $_GET['course_id'];

    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    
    $sql = 'delete from section where section_id =:section_id and class_id = :class_id and course_id = :course_id';
    $stmt1 = $pdo->prepare($sql);
    $stmt1->bindParam(":section_id",$id);
    $stmt1->bindParam(":class_id",$class_id);
    $stmt1->bindParam(":course_id",$course_id);
    
    $delStatus = $stmt1->execute();
    $stmt1 = null;
    $pdo = null;
    
    if ($delStatus)
    {
        header('location:trainer_view_section.php?course_id='. $course_id . '&class_id='. $class_id) ;
    }
   

?>
