<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
function retrieveQnCount($quiz_id)
{
    $count = 0;
    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    $sql = 'select * from question where quiz_id = :quiz_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":quiz_id", $quiz_id);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $stmt->fetch())
    {
        $count ++;
    }
    $stmt = null;
    $pdo = null;
    return $count;
}
function deleteQuestion($quiz_id, $question_id)
{
    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    $sql = 'delete from question where quiz_id = :quiz_id and question_id = :question_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":quiz_id", $quiz_id);
    $stmt->bindParam(":question_id", $question_id);

    $stmt->execute();
    $stmt = null;
    $pdo = null;
    
    return;
}

function insertQuestion($quiz_id, $question_no, $description, $option_1, $option_2, $option_3, $option_4, $answer, $type){
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

    $stmt->execute();
    $stmt = null;
    $pdo = null;
    
    return;
}

function updateQuiz($quiz_id, $quiz_name, $passing_mark, $time_limit, $type)
{
    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
    $pdo = new PDO($dsn,"root",'');
    $query = 'UPDATE quiz set quiz_name = :quiz_name, passing_mark = :passing_mark, time_limit = :time_limit, type = :type where quiz_id = :quiz_id';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":quiz_name", $quiz_name);
    $stmt->bindParam(":passing_mark", $passing_mark);
    $stmt->bindParam(":time_limit", $time_limit);
    $stmt->bindParam(":type", $type);
    $stmt->bindParam(":quiz_id", $quiz_id);

    $stmt->execute();
    $stmt = null;
    $pdo = null;

    return; 
}

function updateQuestions($question_id, $description, $option_1, $option_2, $option_3, $option_4, $answer, $type, $quiz_id)
{
    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
    $pdo = new PDO($dsn,"root",'');
    $query = 'UPDATE question set description = :description, option_1 = :option_1, option_2 = :option_2, option_3 = :option_3, option_4 = :option_4, answer = :answer, type = :type where quiz_id = :quiz_id and question_id = :question_id';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":question_id", $question_id);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":option_1", $option_1);
    $stmt->bindParam(":option_2", $option_2);
    $stmt->bindParam(":option_3", $option_3);
    $stmt->bindParam(":option_4", $option_4);
    $stmt->bindParam(":answer", $answer);
    $stmt->bindParam(":type", $type);
    $stmt->bindParam(":quiz_id", $quiz_id);


    $stmt->execute();
    $stmt = null;
    $pdo = null;

    return; 
}

if (isset($_POST['submit']))
    {
        if (empty($_POST['quiz_name'])  || empty($_POST['passing_mark']) || empty($_POST['time_limit']) || empty($_POST['type']))
        {
?>
            <script type="text/javascript">
            alert('Please enter all fields in the form!');
            </script>
<?php 
        }
        else
        {
            $qn_count = $_POST['qn_count'];
            $num_inDB = retrieveQnCount($_GET['quiz_id']);

            updateQuiz($_GET['quiz_id'], $_POST['quiz_name'], $_POST['passing_mark'], $_POST['time_limit'], $_POST['type']);   
            
            for ($i = 1; $i <= $num_inDB; $i++)
            {
                updateQuestions($i, $_POST['qn_'.$i], $_POST['qn'.$i.'_option1'], $_POST['qn'.$i.'_option2'], $_POST['qn'.$i.'_option3'], $_POST['qn'.$i.'_option4'], $_POST['qn'.$i.'_correctans'], $_POST['qn'.$i.'_type'], $_GET['quiz_id']);
            }
            if ($qn_count > $num_inDB)
            {
                $num_inDB += 1;

                for ($k = $num_inDB; $k <= $qn_count; $k++)
                {
                    insertQuestion($_GET['quiz_id'], $k, $_POST['qn_'.$k], $_POST['qn'.$k.'_option1'], $_POST['qn'.$k.'_option2'], $_POST['qn'.$k.'_option3'], $_POST['qn'.$k.'_option4'], $_POST['qn'.$k.'_correctans'], $_POST['qn'.$k.'_type']);
                }
            }

?>
            <script type="text/javascript">
            alert('Quiz has been updated successfully!');
            location.href = 'trainer_view_section.php?course_id=<?php echo $_GET['course_id'];?>&class_id=<?php echo $_GET['class_id'];?>';
            </script>
<?php            
        }
    }

include 'header.html';
 ?>
 <style>

     table td textarea{
        width:100%;
        height: 100px;
        border:none;
     }



     table td{
        box-sizzing: border-box;
     }
 </style>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">                                            
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_view_section.php?course_id=<?php echo $_GET['course_id'];?>&class_id=<?php echo $_GET['class_id'];?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Section List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <?php
                            $quiz_id = $_GET['quiz_id'];
                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                            $pdo = new PDO($dsn,"root",'');
                            $sql = 'select * from quiz where quiz_id = :quiz_id';
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':quiz_id', $quiz_id , PDO::PARAM_STR);
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $stmt->fetch())
                            {
                        ?>
                        <div class="row">
                            <form action = 'trainer_edit_quiz.php?quiz_id=<?php echo $_GET['quiz_id'];?>&class_id=<?php echo $_GET['class_id'];?>&course_id=<?php echo $_GET['course_id'];?>&section_id=<?php echo $_GET['section_id'];?>' method="POST" id="quiz_form" class="checkout__form">
                                <div class="col-xl-12">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Quiz Details</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Quiz Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="quiz_name">Quiz Name</label>
                                                        <input class="form-control" name = 'quiz_name' id="quiz_name"  type="text" placeholder="Enter the Quiz Name" value="<?php echo $row['quiz_name']?>" />
                                                    </div>
                                                    <!-- Form Group (Passing Mark)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="passing_mark">Passing Mark</label>
                                                        <input class="form-control" name = 'passing_mark' id="passing_mark" type="text" placeholder="Enter the Passing Mark for the quiz" value="<?php echo $row['passing_mark']?>" />
                                                    </div>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Time Limit)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="time_limit">Time Limit</label>
                                                        <input class="form-control" name = 'time_limit' id="time_limit"  type="text" placeholder="Enter the Time Limit for the quiz" value="<?php echo $row['time_limit']?>" />
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="type">Quiz Type</label>
                                                        <select class="form-control" id="type" name="type" required>
                                                            <option value= 'Ungraded'>Ungraded</option>
                                                            <option value= 'Graded'>Graded</option>
                                                        </select>
                                                        
                                                    </div>
                                                </div>

                                                <table class="table table-hover table-bordered" name = 'qnTable' id = 'qnTable'> 
                                                    <thead class="thead-dark">
                                                        <tr> 
                                                            <th rowspan = '2'>#</th> 
                                                            <th rowspan = '2'>Question</th>
                                                            <th rowspan = '2'>Type</th>
                                                            <th colspan = '4' style = 'text-align: center;'>Options
                                                            </th>
                                                            <th rowspan = '2' style = 'text-align: center;'>Correct Answer</th>
                                                            <th rowspan = '2'>Remove</th>

                                                        </tr> 
                                                        <tr>
                                                            <th>Option 1</th>
                                                            <th>Option 2</th>
                                                            <th>Option 3</th>
                                                            <th>Option 4</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id = 'table_body'>
                                                        <?php
                                                            $qn_count = 0;
                                                            $dsn2 = "mysql:host=localhost;dbname=lms;port=3306";
                                                            $pdo2 = new PDO($dsn2,"root",'');
                                                            $sql2 = 'select * from question where quiz_id = :quiz_id';
                                                            $stmt2 = $pdo2->prepare($sql2);
                                                            $stmt2->bindParam(":quiz_id",$quiz_id);
                                                            $stmt2->execute();
                                                            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row2 = $stmt2->fetch())
                                                        {
                                                            $qn_count ++;    
                                                        ?>
                                                        <tr> 
                                                            <!--FETCHING DATA FROM EACH  
                                                                ROW OF EVERY COLUMN--> 
                                                            <td><?php echo $row2['question_id'];?></td> 
                                                            <td><textarea required name = 'qn_<?php echo $row2['question_id'];?>' id = 'qn_<?php echo $row2['question_id'];?>' value = '<?php echo $row2['description'];?>'><?php echo $row2['description'];?></textarea></td> 
                                                            <td><select style = 'width: 80px;' class="form-control" id="qn<?php echo $row2['question_id'];?>_type" name="qn<?php echo $row2['question_id'];?>_type" required>
                                                        <?php 
                                                            if ($row2['type'] == 'True or False')
                                                            {
                                                        ?>
                                                                <option value= 'MCQ'>MCQ</option>
                                                                <option value= 'True or False' selected>T/F</option>
                                                        <?php
                                                            }
                                                            else
                                                            {
                                                        ?>
                                                            <option value= 'MCQ' selected>MCQ</option>
                                                            <option value= 'True or False' >T/F</option>
                                                        <?php
                                                            }
                                                        ?>

                                                            </select></td>
                                                            <td><textarea required name = "qn<?php echo $row2['question_id'];?>_option1" id = "qn<?php echo $row2['question_id'];?>_option1" value = '<?php echo $row2['option_1'];?>'><?php echo $row2['option_1'];?></textarea></td> 
                                                            <td><textarea required name = "qn<?php echo $row2['question_id'];?>_option2" id = "qn<?php echo $row2['question_id'];?>_option2" value = '<?php echo $row2['option_2'];?>'><?php echo $row2['option_2'];?></textarea></td> 
                                                            <td><textarea required name = "qn<?php echo $row2['question_id'];?>_option3" id = "qn<?php echo $row2['question_id'];?>_option3" value = '<?php echo $row2['option_3'];?>'><?php echo $row2['option_3'];?></textarea></td> 
                                                            <td><textarea required name = "qn<?php echo $row2['question_id'];?>_option4" id = "qn<?php echo $row2['question_id'];?>_option4" value = '<?php echo $row2['option_4'];?>'><?php echo $row2['option_4'];?></textarea></td> 
                                                            <td><select class="form-control" id="qn<?php echo $row2['question_id'];?>_correctans" name="qn<?php echo $row2['question_id'];?>_correctans" required>
                                                        <?php 
                                                            $selected = '';
                                                            
                                                            for ($i = 1; $i <= 4; $i++)
                                                            {
                                                                if ($i == $row2['answer'][-1])
                                                                {
                                                                    $selected = 'selected';
                                                                }
                                                                else
                                                                {
                                                                    $selected = '';
                                                                }
                                                                
                                                                echo "<option value= 'Answer ".$i."'".$selected.">Option ".$i."</option>";
                                                            }
                                                        ?>
                                                                </select>
                                                            </td> 
                                                            <td><a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" onclick = "deleteQuestion($_GET['quiz_id'], $_row2['question_id'])" title="Delete Quiz"><i data-feather="trash-2"></i></a></td>

                                                        </tr> 
                                                        <?php 
                                                            } 
                                                            $stmt2 = null;
                                                            $pdo2 = null;
                                                        ?> 
                                                        <div id = 'newQns'>

                                                        </div>
                                                    </tbody>
                                                </table>
                                                <!-- Submit button-->
                                                <button button= 'button' class="btn btn-outline-primary mt-2" onclick = 'addQuestion(); return false;'><i class = 'fa fa-plus'></i><span style = 'padding-left: 5px;'>Add Question</span></button>
                                                <button style = 'float:right; margin-top: 5px;' class="btn btn-primary" type="submit" id = "submit" name = "submit">Update Quiz</button>
                                            <div id = 'count'>
                                            <input type = 'hidden' name = 'qn_count' id = 'qn_count' value = '0'></input>
                                                        </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php    
                            };
                        ?>
                    </div>
                </main>
<?php include 'footer.html';?>


<script type = "text/javascript">

    var question_num = <?php echo $qn_count;?>

    function addQuestion()
    {
        question_num ++;
        var html= `
        <tr> 
            <td>${question_num}</td> 
            <td><textarea required name = 'qn_${question_num}' id = 'qn_${question_num}' value = ''></textarea></td> 
            <td><select style = 'width: 80px;' class="form-control" id="qn${question_num}_type" name="qn${question_num}_type" required>
                <option value= 'MCQ'>MCQ</option>
                <option value= 'True or False' selected>T/F</option>
                </select></td>
            <td><textarea required name = "qn${question_num}_option1" id = "qn${question_num}_option1" value = ''></textarea></td> 
            <td><textarea required name = "qn${question_num}_option2" id = "qn${question_num}_option2" value = ''></textarea></td> 
            <td><textarea required name = "qn${question_num}_option3" id = "qn${question_num}_option3" value = ''></textarea></td> 
            <td><textarea required name = "qn${question_num}_option4" id = "qn${question_num}_option4" value = ''></textarea></td> 
            <td><select class="form-control" id="qn${question_num}_correctans" name="qn${question_num}_correctans" required>
                <option value= 'Answer 1'>Option 1</option>
                <option value= 'Answer 2'>Option 2</option>
                <option value= 'Answer 3'>Option 3</option>
                <option value= 'Answer 4'>Option 4</option>

                </select>
            </td> 
            <td><a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href = '#' onclick = "return confirm('Are you sure you want to delete?')" title="Delete Quiz"><i data-feather="trash-2"></i></a></td>
        </tr>
        `;
        document.getElementById('table_body').innerHTML += html;
        document.getElementById('count').innerHTML = `
        <input type = 'hidden' name = 'qn_count' id = 'qn_count' value = '${question_num}'></input>
        `;
    }
</script>
