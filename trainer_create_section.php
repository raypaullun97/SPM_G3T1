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
                            <form action = "trainer_create_section.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>" method = "POST"  id = 'newSectionForm'>
                                <div class="col-xl-12">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Section Details</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="section_name">Section Name</label>
                                                        <input class="form-control" name = 'section_name' id="section_name"  type="text" placeholder="Enter your Section Name" value="" />
                                                        
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                       
                                                    </div>
                                                </div>
                                                <!-- Form Group (description)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="description">Description</label>
                                                    <textarea class="form-control" name = 'description' id="description"  rows="3" type="text" placeholder="Enter your description for section" value=""></textarea>
                                                </div>
                                                <!-- Submit button-->
                                                <div class="mb-3" id='error_msg' style ="color:red">
                                                    
                                                    <!-- <label id="error_msg" style ="color:red"></label> -->
                                                </div>
                                                <button class="btn btn-primary" type="submit" id = "submit" name = "submit">Add Section</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
<?php include 'footer.html';?>