<?php 
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

function getNumOfSection($class_id, $course_id)
{
    $section_id = '';
    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    $sql = "SELECT section_id FROM `section` WHERE course_id = :course_id and class_id = :class_id order by section_id DESC limit 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":class_id",$class_id);
    $stmt->bindParam(":course_id",$course_id);
    $stmt->execute();

    if($row = $stmt->fetch()){
        $section_id = $row['section_id'];
    }

    $stmt = null;
    $pdo = null;

    return $section_id;
}


$time_limit = $_POST['time_limit'];
$passing_mark = $_POST['passing_mark'];
$section = $_POST['section'];
$class_id = $_GET['class_id'];
$course_id = $_GET['course_id'];
$quiz_name = $_POST['quiz_name'];

if (isset($_POST['quiz_type']))
{
    $quiz_type = $_POST['quiz_type'];
    $section = getNumOfSection($class_id, $course_id);

}
else
{
    $quiz_type = 'Ungraded';
}


?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
    select {
        -webkit-appearance:none;
        -moz-appearance:none;
        -ms-appearance:none;
        appearance:none;
        outline:0;
        box-shadow:none;
        border:0!important;
        background: #5c6664;
        background-image: none;
        flex: 1;
        padding: 0 .5em;
        color:#fff;
        cursor:pointer;
        font-size: 1em;
        font-family: 'Open Sans', sans-serif;
    }
    select::-ms-expand {
        display: none;
    }
    .select {
        position: relative;
        display: flex;
        width: 15em;
        height: 2em;
        line-height: 2;
        background: #5c6664;
        overflow: hidden;
        border-radius: .25em;
    }
    .select::after {
        content: '\25BC';
        position: absolute;
        top: 0;
        right: 0;
        padding: 0 1em;
        background: #2b2e2e;
        cursor:pointer;
        pointer-events:none;
        transition:.25s all ease;
    }
    .select:hover::after {
        color: #23b499;
    }
</style>



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
                                            Create Quiz Question in <?php echo $course_id?> <?php echo $class_id?>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_view_section.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Section
                                        </a>
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_create_quiz.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Quiz
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <div class = 'container mt-2' >
                                <form action = 'trainer_quiz_creation.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>' method = 'POST'>
                                <!--Each Question-->
                                
                                <div id = 'questions_row'>
                                    <div>
                                    <div class = 'row'>
                                        <div class = 'col-sm-6'>
                                            <div class = 'container ml-5' >
                                                <div class = 'row'>
                                                <label for="q1">Question 1</label>
                                                </div>
                                                <div class = 'row'>
                                                    <textarea required class = 'form-control' name = 'qn1text' id = 'qn1text' placeholder = "E.g What is your name?"></textarea>
                                                </div>
                                                <div class = 'row'>
                                                    <label class = 'radio-inline'>
                                                        <input required type = 'radio' id = 'qn1_tf' name ='question1_type' value = 'True or False' onclick = 'tftype("1")'>&nbsp;True or False</input>
                                                    </label>
                                                    <label class = 'radio-inline'>
                                                        <input required type = 'radio' id = 'qn1_mcq' name ='question1_type' value = 'MCQ' onclick = 'mcqtype("1")'>&nbsp;Multiple Choice</input>
                                                    </label>
                                                </div>

                                                <!--Correct Answer-->
                                                <div class = 'row'>
                                                    <div id ='dropdownanswer1'>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Each Answer -->
                                        <div class = 'col-sm-6'>
                                            <div class = 'row' id = 'q1answer'>

                                            </div>
                                        </div>

                                        <!-- Add question button-->
                                        <div class = 'container' style = 'text-align:center;'>
                                            <button button= 'button' class="btn btn-outline-primary mt-2" onclick = 'addQuestion(); return false;'><i class = 'fa fa-plus'></i><span style = 'padding-left: 5px;'>Add Question</span></button>
                                        </div>
                                        <div id = 'questionspace'>
                                            <input type = 'hidden' value = '1' name = 'questionnumber'>
                                        </div>

                                    </div>
                                </div>
                                </div>

                                    <br>
                                    <hr>
                                    <br>
                                    
                                    <div class = 'container'>
                                        <div class = 'col-sm-6'>
                                            <button type="submit" class="btn btn-primary mt-2" id = "submit" name = "submit">Create Quiz</button>
                                            <input type = 'hidden' value = '<?php echo $time_limit; ?>' name = 'time_limit'>
                                            <input type = 'hidden' value = '<?php echo $passing_mark; ?>' name = 'passing_mark'>
                                            <input type = 'hidden' value = '<?php echo $section; ?>' name = 'section'>
                                            <input type = 'hidden' value = '<?php echo $quiz_name; ?>' name = 'quiz_name'>
                                            <input type = 'hidden' value = '<?php echo $quiz_type; ?>' name = 'quiz_type'>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
<?php include 'footer.html';?>

<script type = "text/javascript">

    var question = 1;
    var qid = 'q1answer';
    var dropdownid = 'dropdownanswer';

    function addQuestion()
    {

        question++;
        qid = 'q' + question + 'answer';
        dropdownid = 'dropdownanswer' + question;
        
        var container = document.createElement("div");
        container.innerHTML = `
        <br><hr><br>

        <div class = 'row'>
            <div class = 'col-sm-6'>
                <div class = 'container ml-5' >
                    <div class = 'row'>
                    <label for="q` + question + `">Question ` + question + `</label>
                    </div>
                    <div class = 'row'>
                        <textarea required class = 'form-control' name = 'qn` + question + `text' id = 'qn` + question + `text' placeholder = "E.g What is your name?"></textarea>
                    </div>
                    <div class = 'row'>
                        <label class = 'radio-inline'>
                            <input required type = 'radio' id = 'qn` + question + `_tf' name ='question` + question + `_type' value = 'True or False' onclick = 'tftype("` + question + `")'>&nbsp;True or False</input>
                        </label>
                        <label class = 'radio-inline'>
                            <input required type = 'radio' id = 'qn` + question + `_mcq' name ='question` + question + `_type' value = 'MCQ' onclick = 'mcqtype("` + question + `")'>&nbsp;Multiple Choice</input>
                        </label>
                    </div>

                    <!--Correct Answer-->
                    <div id ='dropdownanswer` + question + `'>

                    </div>
                </div>

            </div>
            <!-- Each Answer -->
            <div class = 'col-sm-6'>
                <div class = 'row' id = 'q` + question + `answer'>

                </div>
            </div>

            <!-- Add question button-->
            <div class = 'container' style = 'text-align:center;'>
                <button type="button" class="btn btn-outline-primary mt-2" onclick = 'addQuestion()'><i class = 'fa fa-plus'></i><span style = 'padding-left: 5px;'>Add Question</span></button>
            </div>
            <div id = 'questionspace'>
                <input type = 'hidden' value = '` + question + `' name = 'questionnumber'>
            </div>

        </div>

        `;
        document.getElementById('questions_row').appendChild(container);
    
        
    }

    function tftype(q_number) 
    {

        dropdownid = 'dropdownanswer' + q_number;
        qid = 'q' + q_number + 'answer';
        var html = `
        <div class = 'col-sm-6'>
            <label for="q` + q_number + `a1">Answer 1</label>
            <input required type="text" class="form-control" id="q` + q_number + `a1" name = "q` + q_number + `a1" value = 'True'>                                    
        </div>

        <div class = 'col-sm-6'>
            <label for="q` + q_number + `a2">Answer 2</label>
            <input required type="text" class="form-control" id="q` + q_number + `a2" name = "q` + q_number + `a2" value = 'False'>                                    
        </div>
        `;

        document.getElementById(qid).innerHTML = html;


        var html2 = `
            <select required name = 'q` + q_number + `correct'>
                <option selected disabled>Select Correct Answer</option>
                <option value = "Answer 1">Answer 1</option>
                <option value = "Answer 2">Answer 2</option>
            </select>
        `;

        document.getElementById(dropdownid).innerHTML = html2;

    }

    function mcqtype(q_number)
    {

        dropdownid = 'dropdownanswer' + q_number;
        qid = 'q' + q_number + 'answer';
        var html = `
        <div class = 'col-sm-6'>
            <label for="q` + q_number + `a1">Answer 1</label>
            <input required type="text" class="form-control" id="q` + q_number + `a1" name ="q` + q_number + `a1" placeholder="Answer 1">                                    
        </div>

        <div class = 'col-sm-6'>
            <label for="q` + q_number + `a2">Answer 2</label>
            <input required type="text" class="form-control" id="q` + q_number + `a2" name = "q` + q_number + `a2" placeholder="Answer 2">                                    
        </div>

        <div class = 'col-sm-6 mt-2'>
            <label for="q` + q_number + `a3">Answer 3</label>
            <input required type="text" class="form-control" id="q` + q_number + `a3" name = "q` + q_number + `a3" placeholder="Answer 3">                                    
        </div>

        <div class = 'col-sm-6 mt-2'>
            <label for="q` + q_number + `a4">Answer 4</label>
            <input required type="text" class="form-control" id="q` + q_number + `a4" name = "q` + q_number + `a4" placeholder="Answer 4">                                    
        </div>
        `;

        document.getElementById(qid).innerHTML = html;

        var html2 = `
            <select required name = 'q` + q_number + `correct'>
                <option selected disabled>Select Correct Answer</option>
                <option value = "Answer 1">Answer 1</option>
                <option value = "Answer 2">Answer 2</option>
                <option value = "Answer 3">Answer 3</option>
                <option value = "Answer 4">Answer 4</option>
            </select>
        `;

        document.getElementById(dropdownid).innerHTML = html2;

    }
</script>
