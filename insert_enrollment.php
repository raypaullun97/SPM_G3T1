<?php
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
    session_start();
    $engineer_id = $_POST['engineer_id'];
    $course_id = $_POST['course_id'];
    $class_id = $_POST['class_id'];
    $status = $_POST['status'];
    

    $dao = new LearnerEnrollmentDAO();
    $status_creation = $dao->add($engineer_id, $course_id,$class_id, $status);
    if($status_creation){ 
        
        echo '<script>alert("Send enrollment to admin successfully")</script>';
        // echo "<script>document.getElementById('unique_course_id').textContent";
        echo "<script>window.location.href = 'http://localhost/SPM_G3T1/learner_view_course.php'</script>";
        // header("Location: http://localhost/SPM_G3T1/learner_view_class.php?course_id=$course_id");

    }
        

