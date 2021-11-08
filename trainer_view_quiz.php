<?php 
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );

    $quiz_id = $_GET['quiz_id'];
    $course_id = $_GET['course_id'];
    $class_id = $_GET['class_id'];
    $section_id = $_GET['section_id'];

?>
<?php include 'trainer_header.html';
?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user"></i></div>
                                            Quiz List
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_view_section.php?course_id=<?php echo $_GET['course_id']?>&class_id=<?php echo $_GET['class_id']?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Section
                                        </a>
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_edit_quiz.php?quiz_id=<?php echo $quiz_id;?>&class_id=<?php echo $class_id;?>&course_id=<?php echo $course_id;?>&section_id=<?php echo $section_id;?>">
                                            <i class="me-1" data-feather="user-plus"></i>
                                            Edit Quiz
                                        </a>
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_copy_quiz.php?quiz_id=<?php echo $quiz_id;?>&class_id=<?php echo $class_id;?>&course_id=<?php echo $course_id;?>&section_id=<?php echo $section_id;?>">
                                            <i class="me-1" data-feather="copy"></i>
                                            Copy Quiz
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


                                
                                <table class="table table-hover table-bordered" id="datatablesSimple"> 
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Question No.</th> 
                                            <th>Question</th>
                                            <th>Option 1</th>
                                            <th>Option 2</th>
                                            <th>Option 3</th>
                                            <th>Option 4</th>
                                            <th>Correct Answer</th>                                            
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            $quiz_id = $_GET['quiz_id'];
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select * from question where quiz_id = :quiz_id';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(":quiz_id",$quiz_id);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['question_id'];?></td> 
                                            <td><?php echo $row['description'];?></td> 
                                            <td><?php echo $row['option_1'];?></td>
                                            <td><?php echo $row['option_2'];?></td>
                                            <td><?php echo $row['option_3'];?></td>
                                            <td><?php echo $row['option_4'];?></td>  
                                            <td><?php echo $row['answer'];?></td>  
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

