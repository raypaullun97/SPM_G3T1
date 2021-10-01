
<?php 

    include 'header.html';
    $section_id='';
    $class_id= 'IS212G2'; 
    $engineer_id='1';
    $all_sections=array();
    $sections=array();
    $completed= TRUE;
    $last_saved[] ='1';

    function updateStatus($learning_material_id, $engineer_id){
        $dsn = "mysql:host=localhost;dbname=lms;port=3306";
        $pdo = new PDO($dsn,"root",'');
        $query = 'insert into learning_material_complete (`learning_material_id`, `engineer_id`) values (:learning_material_id, :engineer_id)';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":learning_material_id", $learning_material_id);
        $stmt->bindParam(":engineer_id", $engineer_id);
        $updateStatus = $stmt->execute();
        $stmt = null;
        $pdo = null;
    
        return $updateStatus;

    }

    function updateSectionStatus($current_section, $engineer_id, $class_id){
        $status="Completed";
        $mark = 0;
        $dsn = "mysql:host=localhost;dbname=lms;port=3306";
        $pdo = new PDO($dsn,"root",'');
        $query = 'insert ignore into section_status values (:section_id, :engineer_id, :class_id, :status, :mark)';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":section_id", $current_section);
        $stmt->bindParam(":engineer_id", $engineer_id);
        $stmt->bindParam(":class_id", $class_id);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":mark", $mark);
        $updateSectionStatus = $stmt->execute();
        $stmt = null;
        $pdo = null;
    
        return $updateSectionStatus;
    }

    if (isset($_POST['update']))
    {   
        $updateStatus= updateStatus($_POST['update'], $engineer_id);
        ?>
        <script type="text/javascript">
            location.href = 'learning_materials_learner_page.php';
       </script>
   <?php
       }

    if (isset($_POST['select_section'])){
        $section_id = $_POST['select_section'];
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
                                        <div class="page-header-subtitle"><?php echo $class_id?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                     <!-- Sidebar -->
                <body>
                    <div class='container'>
                    <div class="col">
                    <nav id="sidebarMenu" class="d-lg-block sidebar bg-white">
                        <div class="position-sticky">
                        <div class="list-group list-group-flush mx-3 mt-4">
                        <form action= 'learning_materials_learner_page.php' method='POST' enctype = "multipart/form-data" id = 'select_section'>
                            <button href="#" class="list-group-item list-group-item-action py-2 ripple" type="submit" value="" name='select_section' id="select_section">All Sections</button>
                            <?php 
                                //display all available sections
                             
                                    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                    $pdo = new PDO($dsn,"root",'');
                                    $sql = "select * from section where class_id=:class_id";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);

                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                    while ($row = $stmt->fetch())
                                    {   
                                        //count what learning material in each section

                                        array_push($sections, $row['section_id']);
                                        $dsn2 = "mysql:host=localhost;dbname=lms;port=3306";
                                        $pdo2 = new PDO($dsn2,"root",'');
                                        $sql2 = "select * from learning_material where class_id = :class_id and section_id = :section_id";
                                        $stmt2 = $pdo->prepare($sql2);
                                        $stmt2->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                        $stmt2->bindParam(':section_id', $row['section_id'] , PDO::PARAM_STR);
                                        $stmt2->execute();
                                        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                        $total= $stmt2->rowCount();
                                        $all_sections[$row['section_id']]= $total;
                                        ?>
                                         <button href="#" class="list-group-item list-group-item-action py-2 ripple" type="submit" value="<?php echo $row['section_id']?>" name='select_section' id="select_section">Section <?php echo $row['section_id']?></button>
                                
                                <?php    
                                    }
                                ?>
                        </div>
                        </div>
                        </div>
                    </nav>
                    <!-- Sidebar -->
                    <form action= 'learning_materials_learner_page.php' method='POST' enctype = "multipart/form-data" id = 'update_status'>
                    <div class="col" id= 'learning_materials'>
                        <table class="table">
                            <thead>
                                <tr>
                                <th>Section</th>
                                <th>Document Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                                <?php
                                $last_saved=array();
                                if($section_id == ''){
                                    for($x=0; $x<count($sections); $x++){
                                        $current_section= $sections[$x];
                                        $total_material= $all_sections[$current_section];
                                        
                                        if($current_section == '1' && $completed == TRUE){
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = "select * from learning_material where class_id = :class_id and section_id = :section_id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                            $stmt->bindParam(':section_id', $current_section , PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                            $count_material = 0;
                                            while ($row = $stmt->fetch())
                                            {   
                                                $learning_material_id= $row['learning_material_id'];
                                                $file_location= "learningmaterials/". $row["document_name"];
                                                $file_location .= $row['type'];
                                                
                                                $dsn2 = "mysql:host=localhost;dbname=lms;port=3306";
                                                $pdo2 = new PDO($dsn,"root",'');
                                                $sql2 = "select * from learning_material_complete where learning_material_id = :learning_material_id and engineer_id =:engineer_id";
                                                $stmt2 = $pdo2->prepare($sql2);
                                                $stmt2->bindParam(':learning_material_id', $learning_material_id);
                                                $stmt2->bindParam(':engineer_id', $engineer_id);
                                                $stmt2->execute();
                                                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                                
                                                if($stmt2->rowCount() > 0){
                                                    $count_material++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['section_id']?></td>
                                                        <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                                        <td><?php echo $row['description']?></td>
                                                        <td><button class="btn btn-light" disabled>Completed</button></td>
                                                    </tr>  
                                                <?php
                                                }
                                                else{
                                                ?>
                                                <tr>
                                                        <td><?php echo $row['section_id']?></td>
                                                        <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                                        <td><?php echo $row['description']?></td>
                                                        <td><button class="btn btn-dark" type="submit" name='update' id='update' value="<?php echo $row['learning_material_id']?>" >Mark as complete</button></td> 
                                                    </tr>  
                                                <?php
                                                }
                                                ?> 
                                                                            
                                            <?php    
                                            };
                                                
                                                if($total_material != $count_material){
                                                    $completed = FALSE;              
                                                }
                                                else{
                                                    $updateSectionStatus= updateSectionStatus($current_section, $engineer_id, $class_id);
                                                }

                                            }//end of inner if
                                            elseif ($completed == TRUE) {
                                                $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                $pdo = new PDO($dsn,"root",'');
                                                $sql = "select * from learning_material where class_id = :class_id and section_id = :section_id";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                                $stmt->bindParam(':section_id', $current_section , PDO::PARAM_STR);
                                                $stmt->execute();
                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                                $count_material = 0;
                                                while ($row = $stmt->fetch())
                                                {   
                                                    $learning_material_id= $row['learning_material_id'];
                                                    $file_location= "learningmaterials/". $row["document_name"];
                                                    $file_location .= $row['type'];
                                                    
                                                    $dsn2 = "mysql:host=localhost;dbname=lms;port=3306";
                                                    $pdo2 = new PDO($dsn,"root",'');
                                                    $sql2 = "select * from learning_material_complete where learning_material_id = :learning_material_id and engineer_id =:engineer_id";
                                                    $stmt2 = $pdo2->prepare($sql2);
                                                    $stmt2->bindParam(':learning_material_id', $learning_material_id);
                                                    $stmt2->bindParam(':engineer_id', $engineer_id);
                                                    $stmt2->execute();
                                                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                                    
                                                    if($stmt2->rowCount() > 0){
                                                        $count_material++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row['section_id']?></td>
                                                            <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                                            <td><?php echo $row['description']?></td>
                                                            <td><button class="btn btn-light" disabled>Completed</button></td>
                                                        </tr>  
                                                    <?php
                                                    }
                                                    else{
                                                    ?>
                                                    <tr>
                                                            <td><?php echo $row['section_id']?></td>
                                                            <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                                            <td><?php echo $row['description']?></td>
                                                            <td><button class="btn btn-dark" type="submit" name='update' id='update' value="<?php echo $row['learning_material_id']?>" >Mark as complete</button></td>
                                                        </tr>  
                                                    <?php
                                                    }
                                                    ?> 
                                                                                
                                                <?php    
                                                };
                                                if($total_material != $count_material){
                                                    $completed = FALSE;                                          
                                                }
                                                else{
                                                    $updateSectionStatus= updateSectionStatus($current_section, $engineer_id, $class_id);
                                                }
                                            }
                                            
                                            
                                        }//end of for loop
                                    }//end of if statement
                                    else{
                                        $dsn2 = "mysql:host=localhost;dbname=lms;port=3306";
                                        $pdo2 = new PDO($dsn2,"root",'');
                                        $query2 = 'select * from section_status where class_id=:class_id and engineer_id= :engineer_id';
                                        $stmt2 = $pdo2->prepare($query2);
                                        $stmt2->bindParam(":class_id", $class_id);
                                        $stmt2->bindParam(":engineer_id", $engineer_id);
                                        $stmt2->execute();
                                        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                        $last_saved=array();

                                        while ($row = $stmt2->fetch()){
                                            $value= $row['section_id']+1;
                                            $last_saved[]= strval($value);
                                        }
                                        
                                        var_dump($last_saved);
                                        
                                        if(in_array($section_id, $last_saved) == TRUE || $section_id =='1'){
                                            
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = "select * from learning_material where class_id=:class_id and section_id = :section_id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                            $stmt->bindParam(':section_id', $section_id , PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                            while ($row = $stmt->fetch())
                                            {   
                                                $learning_material_id= $row['learning_material_id'];
                                                $file_location= "learningmaterials/". $row["document_name"];
                                                $file_location .= $row['type'];
                                                
                                                $dsn2 = "mysql:host=localhost;dbname=lms;port=3306";
                                                $pdo2 = new PDO($dsn,"root",'');
                                                $sql2 = "select * from learning_material_complete where learning_material_id = :learning_material_id and engineer_id =:engineer_id";
                                                $stmt2 = $pdo2->prepare($sql2);
                                                $stmt2->bindParam(':learning_material_id', $learning_material_id);
                                                $stmt2->bindParam(':engineer_id', $engineer_id);
                                                $stmt2->execute();
                                                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                                
                                                if($stmt2->rowCount() > 0){
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['section_id']?></td>
                                                        <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                                        <td><?php echo $row['description']?></td>
                                                        <td><button class="btn btn-light" disabled>Completed</button></td>
                                                    </tr>  
                                                <?php
                                                }
                                                else{
                                                ?>
                                                <tr>
                                                        <td><?php echo $row['section_id']?></td>
                                                        <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                                        <td><?php echo $row['description']?></td>
                                                        <td><button class="btn btn-dark" type="submit" name='update' id='update' value="<?php echo $row['learning_material_id']?>" >Mark as complete</button></td>
                                                    </tr>  
                                                <?php
                                                }
                                                ?> 
                                                                            
                                            <?php 
                                            }
                                        }
                                        else{
                                            ?>
                                            <br>
                                            <div class='text-center'>
                                                <h1>You have not completed previous sections</h1>
                                            </div>
                                            
                                            <?php
                                        }
                                    }
                                    ?>      
                                </table>
                            </div>
                    </form>
                </div>
                </body>
<?php include 'footer.html';?>

</script>