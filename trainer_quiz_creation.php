<?php 
     spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );

    function retrieveQuizID($course_id, $class_id, $section_id)
    {
        $quiz_id = 0;
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();
        $sql = '
        SELECT quiz_id FROM `quiz` WHERE course_id = :course_id and class_id = :class_id and section_id = :section_id order by quiz_id DESC limit 1
        ';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":course_id",$course_id);
        $stmt->bindParam(":class_id",$class_id);
        $stmt->bindParam(":section_id",$section_id);
        $stmt->execute();

        if($row = $stmt->fetch()){
            $quiz_id = $row['quiz_id'];
        }

        $stmt = null;
        $pdo = null;

        return $quiz_id;
    }

    function createQuiz($class_id, $course_id, $section_id, $engineer_id, $passing_mark, $time_limit, $quiz_type, $quiz_name){
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

    function insertListing($quiz_id, $question_no, $description, $option_1, $option_2, $option_3, $option_4, $answer, $type){
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();
        $sql = 'insert into question(`quiz_id`, `question_id`, `description`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `type`) VALUES 
        (:quiz_id, :question_id, :description, :option_1, :option_2, :option_3, :option_4, :answer, :type)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":quiz_id", $quiz_id);
        $stmt->bindParam(":question_id", $question_no);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":option_1",$option_1);
        $stmt->bindParam(":option_2",$option_2);
        $stmt->bindParam(":option_3",$option_3);
        $stmt->bindParam(":option_4",$option_4);
        $stmt->bindParam(":answer",$answer);
        $stmt->bindParam(":type",$type);

        $insertStatus = $stmt->execute();
        $stmt = null;
        $pdo = null;
    
        return $insertStatus;
    }

    if (!isset($_POST['submit']))
    {
        header('Location: trainer_create_question.php');
    }
    else
    {
        #FOR QUIZ TABLE
        $course_id = $_GET['course_id'];
        $class_id = $_GET['class_id'];
        $section_id = $_POST['section'];
        $engineer_id = '3';
        $passing_mark = $_POST['passing_mark'];
        $time_limit = $_POST['time_limit'];
        $quiz_name = $_POST['quiz_name'];
        $quiz_type = $_POST['quiz_type'];
        $quizStatus = createQuiz($class_id, $course_id, $section_id, $engineer_id, $passing_mark, $time_limit, $quiz_type, $quiz_name);
        $quiz_id = retrieveQuizID($course_id, $class_id, $section_id);

        #FOR QUESTION TABLE
        $question_num = $_POST['questionnumber'];
        $question_num = (int)$question_num;

        for ($i = 1; $i <= $question_num; $i ++)
        {
            $question = $_POST['qn'.$i.'text'];
            $question_type = $_POST['question'.$i.'_type'];
            $correct_answer = $_POST['q'.$i.'correct'];

            if ($question_type == 'True or False')
            {
                $answer_one = 'True';
                $answer_two = 'False';
                $answer_three = 'NIL';
                $answer_four = 'NIL';
            }

            else
            {
                $answer_one = $_POST['q'.$i.'a1'];
                $answer_two = $_POST['q'.$i.'a2'];
                $answer_three = $_POST['q'.$i.'a3'];
                $answer_four = $_POST['q'.$i.'a4'];
            }

           $insertStatus = insertListing($quiz_id, $i, $question, $answer_one, $answer_two, $answer_three, $answer_four, $correct_answer, $question_type);
        }
        echo $quiz_id;

     header('Location: trainer_view_section.php?course_id='. $course_id .'&class_id=' . $class_id);


    }


?>
