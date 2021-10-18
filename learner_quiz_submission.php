<?php include 'header.html';
     spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
    $quiz_id = $_GET['quiz_id'];
    $class_id = $_GET['class_id'];
    $course_id = $_GET['course_id'];
    $section_id = $_GET['section_id'];
    $engineer_id = 1;
    $passingmark = 0;
    function getPassingMark($quiz_id){
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();
        $sql = 'select * from quiz where quiz_id = :quiz_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":quiz_id",$quiz_id);
        $stmt->execute();
    
        if($row = $stmt->fetch()){
            $passingmark = $row['passing_mark'];
        }
    
        $stmt = null;
        $pdo = null;
    
        return $passingmark;
     }
     

     function submitQuiz($section_id, $engineer_id, $class_id, $course_id, $mark, $quiz_id){
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();
        $sql = 'insert into section_quiz_grade(`section_id`, `engineer_id`, `class_id`, `course_id`, `mark`, `quiz_id`) 
        values (:section_id, :engineer_id, :class_id, :course_id, :mark, :quiz_id)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":section_id",$section_id);
        $stmt->bindParam(":engineer_id",$engineer_id);
        $stmt->bindParam(":class_id",$class_id);
        $stmt->bindParam(":course_id",$course_id);
        $stmt->bindParam(":mark",$mark);
        $stmt->bindParam(":quiz_id",$quiz_id);
    
        $submitStatus = $stmt->execute();
        $stmt = null;
        $pdo = null;
    
        return $submitStatus;
     }
?>

            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i>
                                            </div>
                                            Quiz Grading <?php echo $quiz_id;?>
                                        </h1>
                                </div>
                            </div>
                        </div>
            </div>
                    </header>
                    <!-- Main page content-->    
                    <div class = 'container mt-2'>
                        <form action = 'learner_quiz_submission.php' method = 'POST'>
                        <input type = 'hidden' value = '<?php echo $quiz_id; ?>' name = 'quiz_id'>

                            <!--Each Question-->
                <?php 
                    $grade = 0;
                    $question_count = 0;
                    $count = 1;
                    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                    $pdo = new PDO($dsn,"root",'');
                    $sql = 'select * from question where quiz_id = :quiz_id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":quiz_id",$quiz_id);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row = $stmt->fetch())
                    {
                        $question_count ++;
                ?>
                 <div id = 'questions_row'>
                    <div class = 'row'>
                        <div class = 'col-sm-6'>
                            <div class = 'container ml-5' >
                                <div class = 'row'>
                                    <label for="q<?php echo $row['question_id'];?>">Question <?php echo $row['question_id'];?>.</label>
                                </div>
                                <div class = 'row'>
                                    <p readonly name = 'qn1text' id = 'qn1text'><?php echo $row['description'];?></p>
                                </div>

                                <?php 
                                    $selected = '';
                                    $correct_answer = $row['answer'];
                                    $correct_answer2 = (int)$row['answer'][-1];
                                    $selected_answer = $_POST['question'.$row['question_id'].'_ans'];
                                    $selected_answer = (int)$selected_answer[-1];
                                    $selected_answer2 = $_POST['question'.$row['question_id'].'_ans'];                                    
                                    if ($selected_answer2 == $correct_answer)
                                    {
                                        $grade ++;
                                    }


                                    if ($row['type'] == 'MCQ')
                                    {
                                ?>
                                    <div class = 'row'>
                                        <label class = 'radio-inline'>
                                            <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' <?php if ($count == $selected_answer){echo 'checked';}?> 
                                            disabled name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 1'>&nbsp;<?php echo $row['option_1'];?></input>
                                            <?php 
                                                if ($count == $correct_answer2)
                                                {
                                                    echo '<span style = "color: #04d43f">&#10003;</span>';
                                                }

                                                if ($selected_answer != $correct_answer2 and $count == $selected_answer)
                                                {
                                                    echo '<span style = "color: #FF0000	">&#88;</span>';

                                                }
                                                $count ++;
                                            ?>
                                        </label>
                                    </div>
                                    <div class = 'row'>
                                        <label class = 'radio-inline'>
                                            <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' <?php if ($count == $selected_answer){echo 'checked';}?> 
                                            disabled name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 2'>&nbsp;<?php echo $row['option_2'];?></input>
                                            <?php 
                                                if ($count == $correct_answer2)
                                                {
                                                    echo '<span style = "color: #04d43f">&#10003;</span>';
                                                }

                                                if ($selected_answer != $correct_answer2 and $count == $selected_answer)
                                                {
                                                    echo '<span style = "color: #FF0000	">&#88;</span>';

                                                }
                                                $count ++;
                                            ?>
                                        </label>
                                    </div>
                                    
                                    <div class = 'row'>
                                        <label class = 'radio-inline'>
                                            <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' <?php if ($count == $selected_answer){echo 'checked';}?> 
                                            disabled name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 3'>&nbsp;<?php echo $row['option_3'];?></input>
                                            <?php 
                                                if ($count == $correct_answer2)
                                                {
                                                    echo '<span style = "color: #04d43f">&#10003;</span>';
                                                }

                                                if ($selected_answer != $correct_answer2 and $count == $selected_answer)
                                                {
                                                    echo '<span style = "color: #FF0000	">&#88;</span>';

                                                }
                                                $count ++;
                                            ?>
                                        </label>
                                    </div>
                                    <div class = 'row'>
                                        <label class = 'radio-inline'>
                                            <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' <?php if ($count == $selected_answer){echo 'checked';}?> 
                                            disabled name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 4'>&nbsp;<?php echo $row['option_4'];?></input>
                                            <?php 
                                                if ($count == $correct_answer2)
                                                {
                                                    echo '<span style = "color: #04d43f">&#10003;</span>';
                                                }

                                                if ($selected_answer != $correct_answer2 and $count == $selected_answer)
                                                {
                                                    echo '<span style = "color: #FF0000	">&#88;</span>';
                                                }
                                                $count = 1;
                                            ?>
                                        </label>
                                    </div>
                                <?php 
                                    }
                                    else
                                    {
                                ?>
                                <div class = 'row'>
                                    <label class = 'radio-inline'>
                                        <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' <?php if ($count == $selected_answer){echo 'checked';}$count ++;?> 
                                        disabled name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 1'>&nbsp;<?php echo $row['option_1'];?></input>
                                    </label>
                                </div>
                                <div class = 'row'>
                                    <label class = 'radio-inline'>
                                        <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' <?php if ($count == $selected_answer){echo 'checked';}$count = 1;?> 
                                        disabled name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 2'>&nbsp;<?php echo $row['option_2'];?></input>
                                    </label>
                                </div>
                                <?php
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <?php 
                    }
                    $stmt = null;
                    $pdo = null;

                    $passingmark = getPassingMark($quiz_id);

                    #Quiz Attempt Submission
                    $submit_attempt = submitQuiz($section_id, $engineer_id, $class_id, $course_id, $grade, $quiz_id)
                ?>
                            <div class = 'container'>
                                <div class = 'col-sm-6'>
                                    <p><b>Final Grade:</b> <?php echo $grade.' / '.$question_count;?></p>
                                    <p>
                                    <?php 
                                    if ($grade >= $passingmark)
                                    {
                                        echo 'Congratulations you have <b>Passed</b> the quiz!';
                                    }
                                    else
                                    {
                                        echo 'Unfortunately, you have <b>Failed</b> the quiz. The passing mark required is '.$passingmark. ' / '.$question_count;;
                                    }
                                    ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class = 'container'>
                                <div class = 'col-sm-6'>
                                <a type="submit" class="btn btn-primary mt-2" id = "submit" name = "submit" href = 'learner_my_class.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>'>Done</a>
                                    <input type = 'hidden' value = '<?php echo $question_count;?>'  name = 'question_count'>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
<?php include 'footer.html';?>
