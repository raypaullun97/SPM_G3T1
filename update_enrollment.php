<?php 
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
?>
<?php
$data=$_POST['val'];
$status =explode('-',$data);
$user_id=$status[1];
$course_id = $status[2];
$engineer_id = $status[3];

if($status[0]=='acc'){
    $value= "Enrolled";
    
}
elseif($status[0]=='rec'){
    $value= "Rejected";
}
$dao = new LearnerEnrollmentDAO();
$status = $dao->updateStatus($user_id, $value);
$dao = new Assign_EngineerDAO();
$status = $dao->addEngineer_course_status($engineer_id, $course_id, "Pending");
echo $value;
?>