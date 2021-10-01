<?php 
     spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );

    function insertListing($quiz_id, $question_no, $description, $option_1, $option_2, $option_3, $option_4, $answer, $type){
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();
        $sql = 'insert into question(`quiz_id`, `question_no`, `description`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `type`) VALUES 
        (:quiz_id, :question_no, :description, :option_1, :option_2, :option_3, :option_4, :answer, :type)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":quiz_id", $quiz_id);
        $stmt->bindParam(":question_no", $question_no);
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
        header('Location: create_question.php');
    }
    else
    {
        $quiz_id = '5';
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

            echo $quiz_id.'<br>';
            echo $i.'<br>';
            echo $question.'<br>';
            echo $answer_one.'<br>';
            echo $answer_two.'<br>';
            echo $answer_three.'<br>';
            echo $answer_four.'<br>';
            echo $correct_answer.'<br>';
            echo $question_type.'<br>';

            $insertStatus = insertListing($quiz_id, $i, $question, $answer_one, $answer_two, $answer_three, $answer_four, $correct_answer, $question_type);
            var_dump($insertStatus);

        }
    }


?>
