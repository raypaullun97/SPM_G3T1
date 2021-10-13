<?php 
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );

    include 'header.html';

    function retrieveGrade($section_id, $engineer_id, $class_id, $course_id, $quiz_id)
    {
        $grade = 0;
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();
        $sql = '
        SELECT mark FROM `section_quiz_grade` WHERE section_id = :section_id and engineer_id = :engineer_id and class_id = :class_id and course_id = :course_id and quiz_id = :quiz_id order by attempts DESC limit 1
        ';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":section_id",$section_id);
        $stmt->bindParam(":engineer_id",$engineer_id);
        $stmt->bindParam(":class_id",$class_id);
        $stmt->bindParam(":course_id",$course_id);
        $stmt->bindParam(":quiz_id",$quiz_id);
        $stmt->execute();

        if($row = $stmt->fetch()){
            $grade = $row['mark'];
        }

        $stmt = null;
        $pdo = null;

        return $grade;
    }

    function retrieveNumAttempts($section_id, $engineer_id, $class_id, $course_id, $quiz_id)
    {
        $num = 0;
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();
        $sql = 'select count(*) as num from section_quiz_grade where section_id = :section_id and engineer_id = :engineer_id and class_id = :class_id
        and course_id = :course_id and quiz_id = :quiz_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":section_id",$section_id);
        $stmt->bindParam(":engineer_id",$engineer_id);
        $stmt->bindParam(":class_id",$class_id);
        $stmt->bindParam(":course_id",$course_id);
        $stmt->bindParam(":quiz_id",$quiz_id);
        $stmt->execute();

        if($row = $stmt->fetch()){
            $num = $row['num'];
        }

        $stmt = null;
        $pdo = null;

        return $num;
    }
    
?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <div class = 'row mb-3'>
                                            <h1 class="page-header-title">
                                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                                Quiz List
                                            </h1>
                                        </div>
                                        <div class = 'row mb-3'>
                                            <h1 class="page-header-title">
                                                <div class="page-header-icon"><i data-feather="layers"></i></div>
                                                <!-- To be changed -->
                                                IS112 IDP G2
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="#">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Course (TBD)
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
                                            <th>Section</th>
                                            <th>Current Quizzes</th>
                                            <th>Grade</th>
                                            <th>Status</th>        
                                            <th>Attempts</th>                                                                          
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <!-- HARD CODED-->
                                        <?php
                                            $course_id = 'IS412';
                                            $class_id = 'G2';
                                            $course_id = 'IS412';
                                            $engineer_id = '1';

                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select * from quiz where course_id = :course_id and class_id = :class_id';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(":course_id",$course_id);
                                            $stmt->bindParam(":class_id",$class_id);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {
                                            $num = retrieveNumAttempts($row['section_id'], $engineer_id, $class_id, $course_id, $row['quiz_id']);

                                        ?>
                                            <td><?php echo $row['section_id']?></td>;    
                                            <td>
                                                <a href = "learner_attempt_quiz.php?quiz_id=<?php echo $row['quiz_id'];?>" onclick = "return confirm('Are you sure you want to start quiz?')"><?php echo $row['quiz_id'];?></a>
                                            </td>
                                            <td>
                                                <?php
                                                    $grade = retrieveGrade($row['section_id'], $engineer_id, $class_id, $course_id, $row['quiz_id']);
                                                    echo $grade; 
                                                ?>
                                            </td>      
                                            <td>
                                            <?php 
                                                if ($num > 0)
                                                {
                                                    echo 'Completed';
                                                }
                                                else
                                                {
                                                    echo "Incomplete";
                                                }
                                            ?>
                                            </td>
                                            <td><?php echo $num;?> / Unlimited</td>
                                        
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