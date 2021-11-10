<?php include 'learner_header.html';?>
<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
//session_start();
//$course_id = $_SESSION['course_id'];
if(isset($_GET['course_id'])){
    $course_id = $_GET['course_id'];
}
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
                                            Upcoming class schedule and details
                                        </h1>
                                        <div class="page-header-subtitle">Our classes are all offline classes with precorded zoom links and training materials</div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                                            <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                                            <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
                                        </div>
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
                                            <th>Class Name</th> 
                                            <th>Date</th> 
                                            <th>Timing</th>
                                            <th>Capacity</th>
                                            <th>Remaining slots</th>
                                            <th>Trainer Name</th>
                                            <th>Enrollment Period</th>
                                            <th>Register</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            $dsn = "mysql:host=localhost;dbname=lms;port=8888";
                                            $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
                                            $sql = 'select * from class c inner join engineer e on c.engineer_id = e.engineer_id where course_id =:course_id and start_register_date <= cast(now() as date) and end_register_date >= cast(now() as date)';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(":course_id",$_GET['course_id'],PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {
                                            $class_id = $row['class_id'];
                                        ?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['class_id'];?></td>
                                            <td><?php $start_date = strtotime($row['start_date']); echo  date('d-M', $start_date); ?> - <?php $end_date = strtotime($row['end_date']); echo  date('d-M', $end_date); ?></td> 
                                            <td><?php $start_time = strtotime($row['start_time']); echo  date('g.iA', $start_time);?> - <?php $end_time = strtotime($row['end_time']); echo  date('g.iA', $end_time);?></td> 
                                            <td><?php echo $row['capacity'];?></td> 
                                            <td><?php 
                                            $con = mysqli_connect('localhost', 'root', '');
                                            mysqli_select_db($con, 'lms');
                                            $sql = "select * from learner_enrollment where class_id ='$class_id' and course_id = '$course_id' and status = 'Enrolled'";
                                            $result = mysqli_query($con, $sql);
                                            $number_of_results = mysqli_num_rows($result);
                                            $remaining_slot = (int)$row['capacity'] - $number_of_results  ;
                                            echo $remaining_slot;
                                            ?></td>
                                            <td><?php echo $row['engineer_name'];?></td>
                                            <td><?php $start_register_date = strtotime($row['start_register_date']); echo  date('d-M', $start_register_date);?>- <?php $end_register_date = strtotime($row['end_register_date']); echo  date('d-M', $end_register_date);?></td>
                                            <td>
                                                <?php if($remaining_slot == "0"){?>
                                                    <a href="learner_view_class.php?course_id=<?php echo $row['course_id']?>" class="btn btn-danger mt-auto disabled" style = "float:center; clear: both">Full Slot</a>
                                                <?php 
                                                }
                                                else{?>
                                                    <form method="post"  action ="insert_enrollment.php">
                                                        <input type="hidden" name="class_id" value="<?php echo $row['class_id']?>">
                                                        <input type="hidden" name="course_id"  value="<?php echo $row['course_id']?>">
                                                        <input type="hidden" name="engineer_id" value="<?php echo $engineer_id?>">
                                                        <input type="hidden" name="status" value="Pending">
                                                        <button  name= "create_enrollment" value="create_enrollment" class="btn btn-primary mt-auto" type="submit">Enroll</button>
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
