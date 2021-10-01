
<?php 
    include 'header.html';
    $section_id='';
    $class_id= 'IS212G2'; 

    function insert($section_id, $class_id, $description, $type, $document_name){
            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
            $pdo = new PDO($dsn,"root",'');
            $query = 'insert into learning_material (`section_id`, `class_id`, `description`, `type`, `document_name`) values (:section_id, :class_id, :description, :type, :document_name)';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":section_id", $section_id);
            $stmt->bindParam(":class_id", $class_id);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":type", $type);
            $stmt->bindParam(":document_name", $document_name);

            $insertStatus = $stmt->execute();
            $stmt = null;
            $pdo = null;
        
            return;

        }


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

            $insertStatus= insert($_POST['section'], $class_id, $_POST['description'], $_POST['type'],$_POST['document_name']);
            echo $insertStatus;
?>
            <script type="text/javascript">
                alert('Learning Materials has been added successfully!');
                location.href = 'learning_materials_trainer_page.php';
            </script>
<?php            
        }

    }

?>

            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Learning Materials
                                        </h1>
                                        <div class="page-header-subtitle">Insert new materials</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                     <!-- Sidebar -->
                <body>
                    <div class='container'> <br>
                    <button class="btn btn-primary" onclick="location.href='learning_materials_trainer_page.php'" >Back</button>
                        <form action= 'learning_materials_insert_page.php' method='POST' enctype = "multipart/form-data" id = 'new_learning_material'>
                            <div class="form-group"><br>
                                <label for="documentName">Document Name</label>
                                <input type="text" class="form-control" placeholder="Enter Document Name" id="document_name" name="document_name">
                            </div>
                        
                            <div class="form-group"><br>
                                <label for="documentName">Description</label>
                                <input type="text" class="form-control" placeholder="Enter Description" id="description" name="description">
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col"><br>
                                    <label for="section">Section</label>
                                    <input type="text" class="form-control" placeholder="Section" id="section" name="section">
                                </div>
                                
                                <div class="form-group col"><br>
                                    <label for="type">Document Type</label>
                                    <select class="form-control" id="type" name="type">
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
                            </div>
                            <br>
                                <label class="form-label" for="customFile">Insert File</label>
                                <input type="file" class="form-control" id="customFile" name="customFile"/>
                            <br>
                            <button type="submit" class="btn btn-primary" id="submit" name="submit" >Submit</button>
                            
                        </form>
                        
                    </div>
                </body>
<?php include 'footer.html';?>
