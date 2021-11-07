<?php 
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

$course_id = $_GET['course_id'];
$engineer_id = 3;
$class_id = $_GET['class_id'];
$quiz_id = $_GET['quiz_id'];
$section_id = $_GET['section_id'];

function retrieveQuizID()
{
    $lastQuiz_id = 0;
    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    $sql = '
    SELECT quiz_id FROM `quiz` order by quiz_id DESC limit 1
    ';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    if($row = $stmt->fetch()){
        $lastQuiz_id = $row['quiz_id'];
    }

    $stmt = null;
    $pdo = null;

    return $lastQuiz_id;
}

function insertQuiz($class_id, $course_id, $section_id, $engineer_id, $passing_mark, $time_limit, $quiz_type, $quiz_name){
    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    $sql = 'insert into quiz(`class_id`, `course_id`,`section_id`, `engineer_id`, `passing_mark`, `time_limit`, `type`, `quiz_name`) VALUES 
    (:class_id, :course_id, :section_id, :engineer_id, :passing_mark, :time_limit, :type, :quiz_name)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":class_id",$class_id);
    $stmt->bindParam(":course_id",$course_id);
    $stmt->bindParam(":section_id",$section_id);
    $stmt->bindParam(":engineer_id",$engineer_id);
    $stmt->bindParam(":passing_mark",$passing_mark);
    $stmt->bindParam(":time_limit",$time_limit);
    $stmt->bindParam(":type",$quiz_type);
    $stmt->bindParam(":quiz_name",$quiz_name);

    $quizCreation = $stmt->execute();
    $stmt = null;
    $pdo = null;

    return $quizCreation;
 }

function insertQuestion($quiz_id, $question_id ,$description, $option_1, $option_2, $option_3, $option_4, $answer, $type){
    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
    $pdo = new PDO($dsn,"root",'');
    $query = 'insert into question (`quiz_id`, `question_id`,`description`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `type`) values (:quiz_id, :question_id, :description, :option_1, :option_2, :option_3, :option_4, :answer, :type)';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":quiz_id", $quiz_id);
    $stmt->bindParam(":question_id", $question_id);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":option_1", $option_1);
    $stmt->bindParam(":option_2", $option_2);
    $stmt->bindParam(":option_3", $option_3);
    $stmt->bindParam(":option_4", $option_4);
    $stmt->bindParam(":answer", $answer);
    $stmt->bindParam(":type", $type);
    
    $insertStatus = $stmt->execute();
    $stmt = null;
    $pdo = null;
    
    return;
}

if (isset($_POST['submit']))
    {
        if (empty($_POST['class_input'])  || empty($_POST['section_input'])){
?>
            <script type="text/javascript">
            alert('Please enter all fields in the form!');
            </script>
<?php         
        }
        else
        {
            #Copy Quiz Details
            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
            $pdo = new PDO($dsn,"root",'');
            $sql = 'select * from quiz where course_id= :course_id and class_id= :class_id and section_id = :section_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);
            $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
            $stmt->bindParam(':section_id', $section_id , PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch())
            {
                $insert_status = insertQuiz($_POST['class_input'], $course_id, $_POST['section_input'], $engineer_id, $row['passing_mark'], $row['time_limit'], $row['type'], $row['quiz_name']);
            } 
            $stmt = null;
            $pdo = null;

            #Copy Quiz Questions
            $lastQuiz_id = retrieveQuizID();
            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
            $pdo = new PDO($dsn,"root",'');
            $sql = 'select * from question where quiz_id = :quiz_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':quiz_id', $quiz_id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch())
            {
                $insertQuiz = insertQuestion($lastQuiz_id, $row['question_id'] ,$row['description'], $row['option_1'], $row['option_2'], $row['option_3'], $row['option_4'], $row['answer'], $row['type']);
            } 
            $stmt = null;
            $pdo = null;

?>
            <script type="text/javascript">
                alert('Quiz has been copied successfully!');
                //location.href = 'trainer_view_section.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>';
            </script>
<?php            
        }

    }

?>


<?php include 'trainer_header.html';?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user"></i></div>
                                            Copying Quiz ID <?php echo $quiz_id?>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_view_section.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Section
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <form action = "trainer_copy_quiz.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>&quiz_id=<?php echo $quiz_id;?>&section_id=<?php echo $section_id;?>" method = "POST" enctype = "multipart/form-data" id = 'new_learning_material'>
                                <div class="col-xl-12">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Quiz Details</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="quiz_name">Course</label>
                                                        <input disabled class="form-control" name = 'quiz_name' id="quiz_name" placeholder="Course" value="<?php echo $course_id;?>" />
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="class_input">Class</label>
                                                        <select class="form-control" id="class_input" name="class_input" required>
                                                            <option value= '' disabled selected>Select Class & Section</option>
                                                        <?php
                                                            $class_array = array();
                                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                            $pdo = new PDO($dsn,"root",'');
                                                            $sql = 'select * from class where course_id= :course_id and engineer_id= :engineer_id';
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);
                                                            $stmt->bindParam(':engineer_id', $engineer_id , PDO::PARAM_STR);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row = $stmt->fetch())
                                                        {?>
                                                            <option value= '<?php echo $row['class_id']?>'><?php echo $row['class_id']?></option>
                                                        <?php 
                                                            array_push($class_array, $row['class_id']);
                                                            } 
                                                            $stmt = null;
                                                            $pdo = null;
                                                        ?>     
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Form Group (description)-->

                                                <div class = "row gx-3 mb-3">
                                                    <div class = "col-md-6 mb-3">

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="section_input">Section</label>
                                                        <select class="form-control" id="section_input" name="section_input" required>
                                                            <option value= '' disabled selected>Select Section</option>
                                                        <?php
                                                            for ($i = 0; $i < count($class_array); $i++)
                                                            {
                                                                $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                                    $pdo = new PDO($dsn,"root",'');
                                                                    $sql = 'select * from section where course_id= :course_id and class_id= :class_id';
                                                                    $stmt = $pdo->prepare($sql);
                                                                    $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);
                                                                    $stmt->bindParam(':class_id', $class_array[$i] , PDO::PARAM_STR);
                                                                    $stmt->execute();
                                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                                    while ($row = $stmt->fetch())
                                                                {?>
                                                                    <option value= '<?php echo $row['section_id']?>'><?php echo $class_array[$i].' '.$row['section_name']?></option>
                                                                <?php 
                                                                    } 
                                                                    $stmt = null;
                                                                    $pdo = null;
                                                                ?>     
                                                        <?php
                                                            }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit" id = "submit" name = "submit">Copy Quiz</button>
                                                
                                                <!-- Submit button-->
                                               
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
<?php include 'footer.html';?>