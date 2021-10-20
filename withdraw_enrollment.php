<?php
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );

    $enrollment_id = $_POST['enrollment_id'];
    $engineer_id = $_POST['engineer_id'];
    $course_id = $_POST['course_id'];
    $status = $_POST['status'];
    

    $dao = new LearnerEnrollmentDAO();
    $status_creation = $dao->updateStatus($enrollment_id, $status);
    $dao2 = new CourseStatusDAO();
    $status_creation2 = $dao2->deleteCourseStatusDAO($engineer_id, $course_id);
    if($status_creation && $status_creation2){ 
        
        echo '<script>alert("Withdrawal enrollment to admin successfully")</script>';
        // echo "<script>document.getElementById('unique_course_id').textContent";
        echo "<script>window.location.href = 'http://localhost/SPM_G3T1/learner_view_self_enrollment.php'</script>";
        // header("Location: http://localhost/SPM_G3T1/learner_view_class.php?course_id=$course_id");

    }
        

