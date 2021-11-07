<?php include 'learner_header.html';?>
<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
//session_start();
//$course_id = $_SESSION['course_id'];

$engineer_id = "1";
?>
<div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary ">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="book"></i></div>
                                            My Self-Enrollment
                                        </h1>
                                        <div class="page-header-subtitle">You can withdraw from a self-enrolled class before or during the self-enrollment period. After the period, you will have to write to L&D for action.</div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-bordered" id="datatablesSimple"> 
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Course ID</th> 
                                            <th>Course Name</th> 
                                            <th>Class ID</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select co.course_id, course_name, cl.class_id, le.status, end_register_date, enrollment_id from course co 
                                                    inner join class cl on co.course_id = cl.course_id
                                                    inner join learner_enrollment le on le.class_id = cl.class_id and le.course_id = cl.course_id
                                                    where le.engineer_id = :engineer_id 
                                                    and type = "Self"';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(":engineer_id",$engineer_id,PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {
                                            $class_id = $row['class_id'];
                                        ?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['course_id'];?></td>
                                            <td><?php echo $row['course_name'];?></td>
                                            <td><?php echo $row['class_id'];?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <td>
                                                
                                            
                                                <?php
                                                $end_register_date = $row['end_register_date'];
                                                $today = date("Y-m-d");
                                                if($row['status'] == "Enrolled" & strtotime($end_register_date) > strtotime($today)){?>
                                                    <form method="post"  action ="withdraw_enrollment.php">
                                                        <input type="hidden" name="enrollment_id" value="<?php echo $row['enrollment_id']?>">
                                                        <input type="hidden" name="course_id" value="<?php echo $row['course_id']?>">
                                                        <input type="hidden" name="engineer_id" value="<?php echo $engineer_id?>">
                                                        <input type="hidden" name="status" value="Withdrawn">
                                                        <button  name= "withdraw" value="withdraw" class="btn btn-primary mt-auto" type="submit">Withdraw</button>
                                                    </form>
                                                <?php }
                                               ?>
                                            </td>   
                                        </tr>     
                                        
                                            
                                         
                                        <?php 
                                            } 
                                            $stmt = null;
                                            $pdo = null;
                                        ?> 
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </main>

<?php include 'footer.html';?>
