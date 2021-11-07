<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
session_start();
$engineer_id = 1;
?>
<?php include 'learner_header.html';?>
<div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary ">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="book"></i></div>
                                            My Enrolled Class
                                        </h1>
                                        <div class="page-header-subtitle"></div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <?php
                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                            $pdo = new PDO($dsn,"root",'');
                            $sql = "SELECT * from learner_enrollment 
                                    inner join course on course.course_id = learner_enrollment.course_id 
                                    inner join class c on c.course_id = course.course_id and c.class_id  = learner_enrollment.class_id
                                    where learner_enrollment.engineer_id= :engineer_id and status= 'Enrolled' and start_date <= cast(now() as date)";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(":engineer_id",$engineer_id,PDO::PARAM_STR);
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $stmt->fetch())           
                            { ?>
                            <div class="col-4 mb-4">
                                <div class="card h-100" style="width: 20rem;" >
                                    <div class="card-header"><?php echo $row['course_id'];?> </div>
                                    <div class="card-body flex-column d-flex">
                                        <h6 class="card-title mb-2 "><?php echo $row['course_name'];?> <?php echo $row['class_id'];?></h6>
                                        <p class="card-text"><?php echo $row['description']?></p>
                                            <a href="learner_my_class.php?course_id=<?php echo $row['course_id']?>&class_id=<?php echo $row['class_id'];?>" class="btn btn-primary mt-auto " style = "float:center; clear: both">View Class</a>  
                                    </div>
                                </div>    
                            </div>
                            <?php }?>
                        </div>
                        
                    </div>
                </main>
<?php include 'footer.html';?>