<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
session_start();
$engineer_id = "1";
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
                                            View All Course
                                        </h1>
                                        <div class="page-header-subtitle">Shows all available and completed course</div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                                                <span class="input-group-text"><i class="text-primary" data-feather="more-vertical"></i></span>
                                                
                                                    <select class="form-control" name ="course_criteria"> 
                                                        <option value = "All" selected>All</option>
                                                        <option value = "Available" >Available</option>
                                                        <option value = "Completed">Completed</option>
                                                    </select>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <!-- DB Connection Start for pagination-->
                            <?php
                            $con = mysqli_connect('localhost', 'root', '');
                            mysqli_select_db($con, 'lms');
                            $results_per_page = 6;
                            $sql = 'select * from course C left outer join course_prerequisite cp on c.course_id = cp.course_id ORDER BY c.course_id ';
                            $result = mysqli_query($con, $sql);
                            $number_of_results = mysqli_num_rows($result);

                            $number_of_pages = ceil($number_of_results / $results_per_page);
                            // $previous = 0;
                            // $next = 0;
                            $p_status = '';
                            $n_status = '';
                            $active = '';
                            if (!isset($_GET['page'])) {
                                $page = 1;
                            }
                            else
                            {
                                $page = $_GET['page'];
                            }
                            $this_page_first_result = ($page - 1) * $results_per_page;
                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                            $pdo = new PDO($dsn,"root",'');
                            $sql = "SELECT * from course_prerequisite c right outer join course cp on c.course_id = cp.course_id ORDER BY cp.course_id   LIMIT " . $this_page_first_result . ',' . $results_per_page;
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $stmt->fetch())           
                            { ?>
                            <div class="col-4 mb-4">
                                <div class="card h-100" style="width: 20rem;" >
                                    <div class="card-header"><?php echo $row['course_id'];?> </div>
                                    <div class="card-body flex-column d-flex">
                                        <h6 class="card-title mb-2 "><?php echo $row['course_name'];?></h6>
                                        <p class="card-text"><?php echo $row['description']?></p>
                                        <p class="card-text">Pre requisite: 
                                            <?php 
                                                if ($row['prerequisite'] == null) { 
                                                    echo "<b>None</b> </p>";
                                                    $prerequisite = $row['prerequisite'];
                                                    $pre_status = "nil";} 
                                                else{
                                                    echo "<b>" . $row['prerequisite'] . 
                                                    "</b>";
                                                    $prerequisite = $row['prerequisite'];
                                                    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                    $pdos = new PDO($dsn,"root",'');
                                                    $sqls = "SELECT status from course_status where engineer_id = :engineer_id and course_id = :course_id and status = 'Completed' ";
                                                    $stmts = $pdos->prepare($sqls);
                                                    $stmts->bindParam(":course_id",$prerequisite,PDO::PARAM_STR);
                                                    $stmts->bindParam(":engineer_id",$engineer_id,PDO::PARAM_STR);
                                                    $stmts->execute();
                                                    $course = null;
                                                    $stmts->setFetchMode(PDO::FETCH_ASSOC);
                                                    
                                                    if($rows = $stmts->fetch()){
                                                        $pre_status = "completed";
                                                            ?>
                                                            <span class='badge bg-success text-white rounded-pill' style='width: 60px; float:right'>Done</span></p>
                                                        <?php }
                                                    else{
                                                        $pre_status = "not completed";
                                                        ?><span class='badge bg-danger text-white rounded-pill' style='width: 80px; float:right'>Not Done</span></p>
                                                    <?php  };
                                                }
                                            $course_id = $row['course_id'];
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdoss = new PDO($dsn,"root",'');
                                            $sqlss = "SELECT status from course_status where engineer_id = :engineer_id and course_id = :course_id and status = 'Completed' ";
                                            $stmtss = $pdoss->prepare($sqlss);
                                            $stmtss->bindParam(":course_id",$course_id,PDO::PARAM_STR);
                                            $stmtss->bindParam(":engineer_id",$engineer_id,PDO::PARAM_STR);
                                            $stmtss->execute();
                                            $course = null;
                                            $stmtss->setFetchMode(PDO::FETCH_ASSOC);
                                            
                                            if($rowss = $stmtss->fetch()){   
                                                
                                                #completed the course
                                                ?><a href="learner_view_class.php?course_id=<?php echo $row['course_id']?>" class="btn btn-primary mt-auto disabled" style = "float:center; clear: both">Completed</a>
                                            <?php }
                                            else{
                                                
                                                #means not completed the course, can be prerequisite not done and just not done
                                                if($pre_status == "not completed"){

                                                    ?><a href="learner_view_class.php?course_id=<?php echo $row['course_id']?>" class="btn btn-danger mt-auto disabled" style = "float:center; clear: both">Complete prerequisite first</a>
                                                <?php }

                                                
                                                else{
                                                    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                    $pdosss = new PDO($dsn,"root",'');
                                                    $sqlsss = "SELECT status from learner_enrollment where engineer_id = :engineer_id and course_id = :course_id and (status = 'Pending' or status = 'Enrolled') ";
                                                    $stmtsss = $pdosss->prepare($sqlsss);
                                                    $stmtsss->bindParam(":course_id",$course_id,PDO::PARAM_STR);
                                                    $stmtsss->bindParam(":engineer_id",$engineer_id,PDO::PARAM_STR);
                                                    $stmtsss->execute();
                                                    $stmtsss->setFetchMode(PDO::FETCH_ASSOC);
                                                    if($rowsss = $stmtsss->fetch()){ 
                                                        
                                                        if ($rowsss['status'] == "Pending"){
                                                            ?><a href="learner_view_class.php?course_id=<?php echo $row['course_id']?>" class="btn btn-secondary mt-auto disabled" style = "float:center; clear: both">Pending enrollment</a>
                                                         <?php }
                                                         else{
                                                            ?><a href="learner_view_class.php?course_id=<?php echo $row['course_id']?>" class="btn btn-primary mt-auto disabled" style = "float:center; clear: both">Enrolled</a>
                                                         <?php }
                                                       
                                                         }
                                                    else{
                                                        ?><a href="learner_view_class.php?course_id=<?php $_SESSION['course_id'] = $row['course_id']; echo $row['course_id']?>" class="btn btn-primary mt-auto" style = "float:center; clear: both">View Class</a>
                                                   <?php }
                                                   
                                                     }
                                            }
                                            
                                            ?>   
                                    </div>
                                </div>    
                            </div>
                            <?php }?>
                        </div>
                        <!-- pagination page numbers Start-->
                        <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">

                            <!-- <li class="page-item <?php echo $p_status?>">
                            <a class="page-link" href="web_products.php?page=<?php echo $previous?>" tabindex="-1">Previous</a>
                            </li> -->

                        <?php
                            $html = '';
                        for ($i=1; $i<=$number_of_pages; $i++) {
                            if ($i == $page)
                            {
                                $active = "style = 'background-color: #007bff; color: white;'";
                            }
                            else
                            {
                                $active = '';
                            }
                            
                            echo "<li class='page-item'><a class='page-link' $active href='learner_view_course.php?page=$i'>$i</a></li>";
                        }

                        ?>

                            <!-- <li class="page-item <?php echo $n_status?>">
                            <a class='page-link' href='web_products.php?page=<?php echo $next?>'>Next</a>
                            </li> -->
                        </ul>
                        </nav>
                        <!-- pagination page numbers End-->             
                    </div>
                </main>
<?php include 'footer.html';?>