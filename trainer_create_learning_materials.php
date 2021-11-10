<?php 
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

function insert($section_id, $class_id ,$course_id, $description, $type, $document_name){
    $dsn = "mysql:host=localhost;dbname=lms;port=8888";
    $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
    $query = 'insert into learning_material (`section_id`, `class_id`,`course_id`, `description`, `type`, `document_name`) values (:section_id, :class_id, :course_id,:description, :type, :document_name)';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":section_id", $section_id);
    $stmt->bindParam(":class_id", $class_id);
    $stmt->bindParam(":course_id", $course_id);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":type", $type);
    $stmt->bindParam(":document_name", $document_name);

    $insertStatus = $stmt->execute();
    $stmt = null;
    $pdo = null;

    return;

}
$class_id = $_GET['class_id'];
$course_id = $_GET['course_id'];

if (isset($_POST['submit']))
    {
        if (empty($_POST['document_name'])  || empty($_POST['description']) || empty($_POST['section']) 
        || empty($_POST['type'])){
?>
            <script type="text/javascript">
            alert('Please enter all fields in the form!');
            </script>
<?php         
        }
        else{
            $target_dir= 'learningmaterials/';
            $target_file= $target_dir . basename($_FILES['customFile']['name']);
            $uploadOk = 1;
            move_uploaded_file($_FILES["customFile"]["tmp_name"], $target_file);
            $insertStatus= insert($_POST['section'], $class_id, $course_id,$_POST['description'], $_POST['type'],$_POST['document_name']);
            echo $insertStatus;
?>
            <script type="text/javascript">
                alert('Learning Materials has been added successfully!');
                location.href = 'trainer_view_section.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>';
            </script>
<?php            
        }

    }

?>


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
                                            Create Training Materials in <?php echo $course_id?> <?php echo $class_id?>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="trainer_view_section.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Section
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <form action = "trainer_create_learning_materials.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>" method = "POST" enctype = "multipart/form-data" id = 'new_learning_material'>
                                <div class="col-xl-12">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Learning Materials Details</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="document_name">Document Name</label>
                                                        <input required class="form-control" name = 'document_name' id="document_name"  type="text" placeholder="Enter Document Name" value="" />
                                                        
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="section">Section</label>
                                                        <select class="form-control" id="section" name="section" required>
                                                            <option value= '' disabled selected>Select Section</option>
                                                        <?php
                                                            
                                                            $dsn = "mysql:host=localhost;dbname=lms;port=8888";
                                                            $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
                                                            $sql = 'select * from section where course_id= :course_id and class_id= :class_id';
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->bindParam(':course_id', $_GET['course_id'] , PDO::PARAM_STR);
                                                            $stmt->bindParam(':class_id', $_GET['class_id'] , PDO::PARAM_STR);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row = $stmt->fetch())
                                                        {?>
                                                            <option value= '<?php echo $row['section_id']?>'><?php echo $row['section_name']?></option>
                                                        <?php 
                                                            } 
                                                            $stmt = null;
                                                            $pdo = null;
                                                        ?>     
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Form Group (description)-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="type">Document Type</label>
                                                        <select class="form-control" id="type" name="type" required>
                                                            <option value= '.docx'>.docx</option>
                                                            <option value= '.pdf'>.pdf</option>
                                                            <option value= '.pptx'>.pptx</option>
                                                            <option value= '.xlsx'>.xlsx</option>
                                                            <option value= '.mp4'>.mp4</option>
                                                            <option value= '.png'>.png</option>
                                                            <option value= '.jpeg'>.jpeg</option>
                                                            <option >Others</option>
                                                        </select>
                                                        
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="customFile">Insert File</label>
                                                        
                                                        <input type="file" class="form-control" id="customFile" required name="customFile"/>
                                                    </div>
                                                </div>

                                                
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="description">Description</label>
                                                    <textarea class="form-control" required name = 'description' id="description"  rows="3" type="text" placeholder="Enter your description for section" value=""></textarea>
                                                </div>
                                                <!-- Submit button-->
                                                <div class="mb-3" id='error_msg' style ="color:red">
                                                    
                                                    <!-- <label id="error_msg" style ="color:red"></label> -->
                                                </div>
                                                <button class="btn btn-primary" type="submit" id = "submit" name = "submit">Add Learning Materials</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
<?php include 'footer.html';?>