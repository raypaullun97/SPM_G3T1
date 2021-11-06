<?php
    class QuestionDAO{

        # Add a new user to the database
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
}
?>