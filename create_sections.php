<?php 
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

 function createSections($class_id, $section_name, $description){
    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    $sql = 'insert into section(`class_id`,`section_name`, `description`) VALUES 
    (:class_id, :section_name, :description)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":class_id",$class_id);
    $stmt->bindParam(":section_name",$section_name);
    $stmt->bindParam(":description",$description);
    $insertStatus = $stmt->execute();
    $stmt = null;
    $pdo = null;

    return $insertStatus;
 }

 if (isset($_POST['submit']))
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
                                            Create Sections
                                        </h1>
                                        <div class="page-header-subtitle">Creation of sections</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class = 'container'>
                        <form action = "create_sections.php" method = "POST" enctype = "multipart/form-data" id = 'newSectionForm'>
                            <div class="form-group row" style = 'margin-top: 20px;'>
                                <label for="SectionName" class="col-sm-2 col-form-label">Section Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name = 'section_name' id="section_name" placeholder="Name of Section">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    Description
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name = 'description' rows="3" id="description" placeholder="Description of Section"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" style = "margin-top: 10px; float:right;" id = "submit" name = "submit">Submit</button>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                    </div>
                </main>
<?php include 'footer.html';?>