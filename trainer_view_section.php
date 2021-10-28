<?php 
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

function createSections($class_id, $course_id, $section_name, $description){
    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    $sql = 'insert into section(`class_id`, `course_id`, `section_name`, `description`) VALUES 
    (:class_id, :course_id, :section_name, :description)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":class_id",$class_id);
    $stmt->bindParam(":course_id",$course_id);
    $stmt->bindParam(":section_name",$section_name);
    $stmt->bindParam(":description",$description);
    $insertStatus = $stmt->execute();
    $stmt = null;
    $pdo = null;

    return $insertStatus;
}
$class_id = $_GET['class_id'];
$course_id = $_GET['course_id'];
$section_id='';
if (isset($_GET['section_id'])){
    $section_id = $_GET['section_id'];
}
if (isset($_POST['submit']))
{
     if (empty($_POST['section_name'])  || empty($_POST['description']))
     {
?>
        
        <script type="text/javascript">

        // alert('Please enter all fields in the form!');
        document.getElementById('error_msg').innerHTML  = "Please enter all fields in the form!";
        </script>
<?php 
    
     }
     else
     {


         $insertStatus = createSections($class_id, $course_id, $_POST['section_name'],$_POST['description']);
     
?>
         <script type="text/javascript">
         alert('Section has been created successfully!');
        location.href = 'trainer_view_class.php';
         </script>
<?php            
     }
 }?>


<?php include 'header.html';?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user"></i></div>
                                            Create Section in <?php echo $course_id?> <?php echo $class_id?>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_view_class.php">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Class
                                        </a>
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_create_section.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>">
                                            <i class="me-1" data-feather="user-plus"></i>
                                            Add New Section
                                        </a>
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_create_learning_materials.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>">
                                            <i class="me-1" data-feather="user-plus"></i>
                                            Add New Training Materials
                                        </a>
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_create_quiz.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>">
                                            <i class="me-1" data-feather="user-plus"></i>
                                            Add Quiz
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4">
                        <div class="card">
                            <div class="card-header">
                                Section
                            </div>
                            <div class="card-body">
                                
                                <table class="table table-hover table-bordered" id="datatablesSimple" > 
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Section Name</th> 
                                            <th>Description</th>
                                            <th><a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="trainer_view_section.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>" title="View All Training Materials and Quizzes"><i data-feather="user-check"></i></a></th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select * from section where course_id= :course_id and class_id= :class_id';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);
                                            $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['section_name'];?></td> 
                                            <td><?php echo $row['description'];?></td> 
                                            <td>
                                                <?php $class_id = $row['class_id'];?>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="trainer_view_section.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>&section_id=<?php echo $row['section_id']?>" title="View <?php echo $row['section_name']?> Training Materials and Quiz"><i data-feather="user-check"></i></a>
                                                <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="admin_self_enrollment.php?course_id=<?php echo $row['course_id']?>&class_id=<?php echo $row['class_id']?>" title="View Training Materials"><i data-feather="user-check" ></i></button> -->
                                                <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark mx-2" onclick="runPop(this);" href=""  title="Self-Enrollment"   value="<?php $class_id;?>"><i data-feather="user-check"></i></button> -->

                                            </td>
                                        </tr> 
                                        <?php 
                                            } 
                                            $stmt = null;
                                            $pdo = null;
                                        ?> 
                                        
                                    </tbody>
                                </table>
                               
                        </div>
                    </div>
                    <div class="container-fluid pt-4 px-2">
                        <div class="card">
                            <div class="card-header">
                                Training Materials
                            </div>
                            <div class="card-body">
                                
                                <table class="table table-hover table-bordered"  > 
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Document Name</th> 
                                            <th>Description</th>
                                            
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($section_id == ''){
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = "select * from learning_material where class_id = :class_id and course_id= :course_id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);
                                            $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            }
                                            else{
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = "select * from learning_material where class_id = :class_id and section_id= :section_id and course_id= :course_id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                            $stmt->bindParam(':section_id', $section_id , PDO::PARAM_STR);
                                            $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            }
                                            while ($row = $stmt->fetch())
                                        {?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            
                                                <?php $file_location= "learningmaterials/". $row["document_name"];
                                                $file_location .= $row['type'];?>
                                            
                                            <td><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td> 
                                            <td><?php echo $row['description'];?></td> 
                                            <td>
                                                <?php $class_id = $row['class_id'];?>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="trainer_edit_learning_materials.php?learning_material_id=<?php echo $row['learning_material_id']?>"  title="Edit Learning Materials"><i data-feather="edit"></i></a>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!" title="Delete Learning Materials"><i data-feather="trash-2"></i></a>
                                                <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark mx-2" onclick="runPop(this);" href=""  title="Self-Enrollment"   value="<?php $class_id;?>"><i data-feather="user-check"></i></button> -->
                                                <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark mx-2" onclick="runPop(this);" href=""  title="Self-Enrollment"  data-toggle="modal" data-target="#self_enrollment" value="<?php $class_id;?>"><i data-feather="user-check"></i></button> -->
                                            </td>
                                        </tr> 
                                        <?php 
                                            } 
                                            $stmt = null;
                                            $pdo = null;
                                        ?> 
                                    </tbody>
                                </table>
                               
                        </div>
                    </div>
                    <div class="container-fluid pt-4 px-2">
                        <div class="card">
                            <div class="card-header">
                                Quizzes
                            </div>
                            <div class="card-body">
                                
                                <table class="table table-hover table-bordered"  > 
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Quiz ID</th> 
                                            <th>Passing Mark</th>
                                            <th>Time Limit (Minute)</th>   
                                            <th>Type</th>  
                                            
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($section_id == ''){
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = "select * from quiz where class_id = :class_id and course_id= :course_id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);
                                            $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            }
                                            else{
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = "select * from quiz where class_id = :class_id and course_id= :course_id and section_id= :section_id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                            $stmt->bindParam(':section_id', $section_id , PDO::PARAM_STR);
                                            $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            }
                                            while ($row = $stmt->fetch())
                                        {
                                        ?>
                                        <tr> 
                                           
                                            
                                            <td><?php echo $row['quiz_name'];?></td> 
                                            <td><?php echo $row['passing_mark'];?></td> 
                                            <td><?php echo $row['time_limit'];?></td> 
                                            <td><?php echo $row['type'];?></td> 
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2 mx-2" href="trainer_edit_quiz.php?quiz_id=<?php echo $row['quiz_id'].'&class_id='.$row['class_id'].'&course_id='.$row['course_id'].'&section_id='.$row['section_id'];?>"  title="Edit Quiz"><i data-feather="edit"></i></a>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href='trainer_view_quiz.php?course_id=<?php echo $row['course_id']?>&class_id=<?php echo $row['class_id']?>&quiz_id=<?php echo $row['quiz_id'];?>&section_id=<?php echo $row['section_id'];?>' title="View Quiz"><i data-feather="eye"></i></a>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href = 'trainer_delete_quiz.php?course_id=<?php echo $row['course_id']?>&class_id=<?php echo $row['class_id']?>&quiz_id=<?php echo $row['quiz_id'];?>' onclick = "return confirm('Are you sure you want to delete?')" title="Delete Quiz"><i data-feather="trash-2"></i></a>
                                            </td>
                                        </tr> 
                                        <?php 
                                            } 
                                            $stmt = null;
                                            $pdo = null;
                                        ?> 
                                    </tbody>
                                </table>
                               
                        </div>
                    </div>
                </main>
<?php include 'footer.html';?>