<?php 
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

 function createQuiz($course_id, $section_id, $engineer_id, $passing_mark, $time_limit){
    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    $sql = 'insert into quiz(`course_id`,`section_id`, `engineer_id`, `passing_mark`, `time_limit`) VALUES 
    (:course_id, :section_id, :engineer_id, :passing_mark, :time_limit)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":course_id",$course_id);
    $stmt->bindParam(":section_id",$section_id);
    $stmt->bindParam(":engineer_id",$engineer_id);
    $stmt->bindParam(":passing_mark",$passing_mark);
    $stmt->bindParam(":time_lmiit",$time_limit);

    $insertStatus = $stmt->execute();
    $stmt = null;
    $pdo = null;

    return $insertStatus;
 }

 /*if (isset($_POST['submit']))
 {
     if (empty($_POST['section_name'])  || empty($_POST['description']))
     {
?>
         <script type="text/javascript">
         alert('Please enter all fields in the form!');
         </script>
<?php 
     }
     else
     {
         $class_id = '2';
         $insertStatus = createSections($class_id, $_POST['section_name'],$_POST['description']);
     
?>
         <script type="text/javascript">
         alert('Section has been created successfully!');
         </script>
<?php            
     }
 }
*/
include 'header.html';?>

            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Create Quiz
                                        </h1>
                                        <div class="page-header-subtitle">Creation of Quizzes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class = 'container'>
                        <form action = "create_quiz.php" method = "POST" enctype = "multipart/form-data" id = 'newSectionForm'>
                            <div class="form-group row" style = 'margin-top: 20px;'>
                                <label for="PassingMark" class="col-sm-2 col-form-label">Passing Mark</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name = 'passing_mark' id="passing_mark" placeholder="Passing Mark">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    Time Limit
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name = 'description' rows="3" id="description" placeholder="Time Limit of Quiz"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-primary" style = "margin-top: 10px; float:right;">Next</button>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                    </div>
                </main>
<?php include 'footer.html';?>