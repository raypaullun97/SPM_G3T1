
<?php
    session_start();
    include 'learner_header.html';
    $section_id='';
    $class_id= 'G2'; 
    $course_id= 'IS212'; 

    $learning_material_id = $_SESSION['learning_material'];
    var_dump($learning_material_id);

    function update($section_id, $class_id ,$course_id, $description, $type, $document_name, $learning_material_id){
            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
            $pdo = new PDO($dsn,"root",'');
            $query = 'UPDATE learning_material SET section_id=:section_id, class_id=:class_id, course_id=:course_id, description=:description, type=:type, document_name = :document_name where learning_material_id = :learning_material_id';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":section_id", $section_id);
            $stmt->bindParam(":class_id", $class_id);
            $stmt->bindParam(":course_id", $course_id);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":type", $type);
            $stmt->bindParam(":document_name", $document_name);
            $stmt->bindParam(":learning_material_id", $learning_material_id);

            $stmt->execute();
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

            if(file_exists($target_file)){
                chmod($target_file, 0755);
                unlink($target_file);
            }

            move_uploaded_file($_FILES["customFile"]["tmp_name"], $target_file);

            $updateStatus= update($_POST['section'], $class_id, $course_id, $_POST['description'], $_POST['type'], $_POST['document_name'], $learning_material_id);
?>
            <script type="text/javascript">
                alert('Learning Materials has been edited successfully!');
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
                                        <div class="page-header-subtitle">Edit materials</div>
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
                        <form action= 'learning_materials_edit_page.php' method='POST' enctype = "multipart/form-data" id = 'edit_learning_material'>
                            <?php   
                                $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                $pdo = new PDO($dsn,"root",'');
                                $sql = "select * from learning_material where learning_material_id= :learning_material_id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindParam(':learning_material_id', $learning_material_id, PDO::PARAM_STR);
                                $stmt->execute();
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                while ($row = $stmt->fetch())
                                {   
                                    ?>
                                    <div class="form-group"><br>
                                    <label for="documentName">Document Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Document Name" id="document_name" name="document_name" value="<?php echo $row['document_name']?>">
                                </div>
                            
                                <div class="form-group"><br>
                                    <label for="documentName">Description</label>
                                    <input type="text" class="form-control" placeholder="Enter Description" id="description" name="description" value="<?php echo $row['description']?>">
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col"><br>
                                        <label for="section">Section</label>
                                        <input type="text" class="form-control" placeholder="Section" id="section" name="section" value="<?php echo $row['section_id']?>">
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
                                
                                <?php 
                                    };
                                ?>
                        
                            
                                <label class="form-label" for="customFile">Insert File</label>
                                <input type="file" class="form-control" id="customFile" name="customFile"/>
                            <br>
                            <button type="submit" class="btn btn-primary" id="submit" name="submit" >Submit</button>
                            
                        </form>
                        
                    </div>
                </body>
<?php include 'footer.html';?>
