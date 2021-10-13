<?php 
     spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );

    function createQuiz($quiz_id, $class_id, $course_id, $section_id, $engineer_id, $passing_mark, $time_limit){
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();
        $sql = 'insert into quiz(`quiz_id`, `class_id`, `course_id`,`section_id`, `engineer_id`, `passing_mark`, `time_limit`) VALUES 
        (:quiz_id, :class_id, :course_id, :section_id, :engineer_id, :passing_mark, :time_limit)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":quiz_id",$quiz_id);
        $stmt->bindParam(":class_id",$class_id);
        $stmt->bindParam(":course_id",$course_id);
        $stmt->bindParam(":section_id",$section_id);
        $stmt->bindParam(":engineer_id",$engineer_id);
        $stmt->bindParam(":passing_mark",$passing_mark);
        $stmt->bindParam(":time_limit",$time_limit);

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
        #Quiz ID will be combination of courseID, classID and SectionID
        #Format is like IS212G2S1
        $quiz_id = $course_id.$class_id.'S'.$section_id;
        $engineer_id = '3';
        $passing_mark = $_POST['passing_mark'];
        $time_limit = $_POST['time_limit'];

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

            echo $quiz_id;
            echo $i;
            echo $question;
            echo $answer_one;
            echo $answer_two ;
            echo $answer_three;
            echo $answer_four;
            echo $correct_answer;
            echo $question_type;



           $insertStatus = insertListing($quiz_id, $i, $question, $answer_one, $answer_two, $answer_three, $answer_four, $correct_answer, $question_type);
        }

     $quizStatus = createQuiz($quiz_id, $class_id, $course_id, $section_id, $engineer_id, $passing_mark, $time_limit);
     echo $quizStatus;
     header('Location: trainer_view_section.php?course_id='. $course_id .'&class_id=' . $class_id);


    }


?>
