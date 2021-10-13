<?php include 'header.html';
 $quiz_id = $_GET['quiz_id'];
?>

<script>

var minutes = 1;

   var seconds = 5;
   function secondPassed() {
   var minutes = Math.round((seconds - 30)/60);
   var remainingSeconds = seconds % 60;
   if (remainingSeconds < 10) {
      remainingSeconds = "0" + remainingSeconds; 
   }
   document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
   if (seconds <= 0) {
       alert('Times up!');
       document.getElementById('submitBtn2').click();

    clearInterval(countdownTimer);


   } else {
    seconds--;
   }
   }
    var countdownTimer = setInterval('secondPassed()', 1000);
</script>

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
                                            Attempt Quiz <?php echo $quiz_id;?>
                                        </h1>
                                    <div class="page-header-subtitle pt-2" style = 'color: #FFFFFF;'>Time Left: 
                                    <span id="countdown" class="timer"></span>
                                </div>
                                </div>
                            </div>
                        </div>
            </div>
                    </header>
                    <!-- Main page content-->    
                    <div class = 'container mt-2'>
                        <form action = 'learner_quiz_submission.php' method = 'POST' name ='myForm' id = 'myForm'>
                        <input type = 'hidden' value = '<?php echo $quiz_id; ?>' name = 'quiz_id'>

                            <!--Each Question-->
                <?php 
                    $question_count = 0;
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
                                    if ($row['type'] == 'MCQ')
                                    {
                                ?>
                                    <div class = 'row'>
                                        <label class = 'radio-inline'>
                                            <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 1'>&nbsp;<?php echo $row['option_1'];?></input>
                                        </label>
                                    </div>
                                    <div class = 'row'>
                                        <label class = 'radio-inline'>
                                            <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 2'>&nbsp;<?php echo $row['option_2'];?></input>
                                        </label>
                                    </div>
                                    <div class = 'row'>
                                        <label class = 'radio-inline'>
                                            <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 3'>&nbsp;<?php echo $row['option_3'];?></input>
                                        </label>
                                    </div>
                                    <div class = 'row'>
                                        <label class = 'radio-inline'>
                                            <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 4'>&nbsp;<?php echo $row['option_4'];?></input>
                                        </label>
                                    </div>
                                <?php 
                                    }
                                    else
                                    {
                                ?>
                                <div class = 'row'>
                                    <label class = 'radio-inline'>
                                        <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 1'>&nbsp;<?php echo $row['option_1'];?></input>
                                    </label>
                                </div>
                                <div class = 'row'>
                                    <label class = 'radio-inline'>
                                        <input type = 'radio' id = 'qn<?php echo $row['question_id'];?>_ans' name ='question<?php echo $row['question_id'];?>_ans' value = 'Answer 2'>&nbsp;<?php echo $row['option_2'];?></input>
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
                ?>
                            
   

                            <!-- Submit Button -->
                            <div class = 'container'>
                                <div class = 'col-sm-6'>
                                    <a type="submit" class="btn btn-danger mt-2" id = "submit" name = "submit" href = 'learner_view_quiz_list.php'>Leave</a>
                                </div>
                                <div class = 'col-sm-6'>
                                    <button type="submit" class="btn btn-primary mt-2" id = "submitBtn" name = "submit" onclick = "return confirm('Are you sure you want to submit the quiz?')">Submit Quiz</button>
                                    <button type="submit" style = 'display:none;' class="btn btn-primary mt-2" id = "submitBtn2" name = "submitBtn2">Submit Quiz</button>
                                    <input type = 'hidden' value = '<?php echo $question_count;?>'  name = 'question_count'>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
<?php include 'footer.html';?>