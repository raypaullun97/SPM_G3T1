<?php 
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
$course_id = $_GET['course_id'];
$class_id = $_GET['class_id'];

?>


<?php include 'admin_header.html';?>

<script>
function approveuser(id){
    
    trid=id.split('-')[1];
    //alert(id);

    $.ajax({
        
        url: "update_enrollment.php",
        type:"post",
        data:{ val : id },

        beforeSend: function() {    
            console.log( "Processing..." );
        },
        success: function(result){
            //alert(result);
            // $('table#sHold tr#'+trid).remove();
            //alert('Updated');
            if(result == "Enrolled"){
                alert("Successfully enrolled");
            }
            else{
                alert("Successfully rejected");
            }
            location.reload(true);


    }
    });

}
</script>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user"></i></div>
                                            Self Enrollment in  <?php echo $_GET['course_id']?> <?php echo $_GET['class_id']?>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="admin_view_class.php?course_id=<?php echo $_GET['course_id']?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Class
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                    $start_date = "";
                                    $dsn = "mysql:host=localhost;dbname=lms;port=8888";
                                    $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
                                    $sql = "select * from class where course_id =:course_id and class_id =:class_id";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindParam(':course_id', $_GET['course_id'] , PDO::PARAM_STR);
                                    $stmt->bindParam(':class_id', $_GET['class_id'] , PDO::PARAM_STR);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                if ($row = $stmt->fetch())
                                {
                                    $start_date = $row['start_date'];
                                }
                                $today = date("Y-m-d");
                                if(strtotime($today) < strtotime($start_date)){

                                
                                ?>
                                    <table class="table table-hover table-bordered" id="datatablesSimple" > 
                                        <thead class="thead-dark">
                                            <tr> 
                                            <th>Engineer ID</th> 
                                            <th>Engineer Name</th>
                                            <th>Engineer username</th>
                                            <th>Status</th>
                                            <th>Assign</th>
                                                
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            <?php
                                                $dsn = "mysql:host=localhost;dbname=lms;port=8888";
                                                $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
                                                $sql = "select enrollment_id, learner_enrollment.engineer_id, engineer_name, username, learner_enrollment.status
                                                from engineer
                                                inner join learner_enrollment on learner_enrollment.engineer_id = engineer.engineer_id where course_id = :course_id and class_id = :class_id and learner_enrollment.status = 'Pending' and type = 'Self' ";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->bindParam(':course_id', $_GET['course_id'] , PDO::PARAM_STR);
                                                $stmt->bindParam(':class_id', $_GET['class_id'] , PDO::PARAM_STR);
                                                $stmt->execute();
                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                while ($row = $stmt->fetch())
                                            {
                                            ?>
                                            <tr> 
                                                <!--FETCHING DATA FROM EACH  
                                                    ROW OF EVERY COLUMN--> 
                                                <?php $sId = $row['enrollment_id'];?>
                                                <?php $engineer_id = $row['engineer_id'];?>
                                                <td><?php echo $row['engineer_id'];?></td> 
                                                <td><?php echo $row['engineer_name'];?></td>
                                                <td><?php echo $row['username'];?></td>
                                                <td><?php echo $row['status'];?></td>  
                                                
                                                <td class="col-2"><div class="form-check">
                                                <button class="btn btn-light text-primary mx-2" id="acc-<?php echo $sId?>-<?php echo $course_id?>-<?php echo $engineer_id?>" value ="Accept"  onclick='approveuser(this.id)'><i data-feather="check"></i>Accept</button>
                                                <button class="btn btn-light text-primary " id="rec-<?php echo $sId?>-<?php echo $course_id?>-<?php echo $engineer_id?>" value ="Reject"  onclick='approveuser(this.id)'><i data-feather="x"></i>Reject</button>
                    
                                                </div>
                                                </td>
                                            </tr> 
                                            <?php 
                                                } 
                                                $stmt = null;
                                                $pdo = null;
                                            ?> 
                                        </tbody>
                                    </table>
                                <?php 
                                }
                                else{
                                ?>
                                <h1 class='text-center'>The class has started already</h1>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>

<?php include 'footer.html';?>
