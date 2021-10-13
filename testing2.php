<?php 
     spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );

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

     function getQuestionAnswer($quiz_id, $question_id){
        $correct_answer = '';
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();
        $sql = 'select * from question where quiz_id = :quiz_id and question_id = :question_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":quiz_id",$quiz_id);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->execute();

        if($row = $stmt->fetch()){
            $correct_answer = $row['answer'];
        }

        $stmt = null;
        $pdo = null;

        return $correct_answer;
     }

    if (!isset($_POST['submit']))
    {
        header('Location: trainer_create_question.php');
    }
    else
    {
        $grade = 0;
        $quiz_id = $_POST['quiz_id'];
        $question_count = $_POST['question_count'];

        $passing_mark = getPassingMark($quiz_id);

        for ($i = 1; $i <= $question_count; $i++)
        {
            $correct_answer = getQuestionAnswer($quiz_id, $i);

            if ($_POST['question'.$i.'_ans'] == $correct_answer)
            {
                $grade ++;
            }
        }

        #HARDCODED
        $course_id = 'IS412';
        $class_id = 'G2';
        $section_id = 1;
        $engineer_id = '1';

        $submitStatus = submitQuiz($section_id, $engineer_id, $class_id, $course_id, $grade, $quiz_id);

        if ($grade >= $passing_mark)
        {
            echo "You have passed!";
        }
        else
        {
            echo "You have failed!";
        }
    }


?>
