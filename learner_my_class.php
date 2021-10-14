<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
session_start();
$engineer_id = 1;
$section_id='';
$class_id = $_GET['class_id'];
$course_id = $_GET['course_id'];
$all_sections=array();
$completed_section=0;
$sections=array();
$completed= TRUE;
$last_saved[] ='1';
$section_name = '';

if (isset($_POST['select_section'])){
    $section_id = $_POST['select_section'];
}
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

function updateSectionStatus($current_section, $engineer_id, $class_id, $course_id){
    $status="Completed";
    $mark = 0;
    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
    $pdo = new PDO($dsn,"root",'');
    $query = 'insert ignore into section_status values (:section_id, :engineer_id, :class_id, :course_id, :mark)';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":section_id", $current_section);
    $stmt->bindParam(":engineer_id", $engineer_id);
    $stmt->bindParam(":class_id", $class_id);
    $stmt->bindParam(":course_id", $course_id);
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
        location.href = 'learner_my_class.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>';
   </script> 
<?php 
}
?>
<!-- header hereee jc -->
<div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary ">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="book"></i></div>
                                            My enrolled class
                                        </h1>
                                        <div class="page-header-subtitle"></div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4 ">
                                        <a class="btn btn-sm btn-light text-primary" href="learner_my_course.php">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Course List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <div class="col-md-3">
                            <form action= 'learner_my_class.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>' method='POST' enctype = "multipart/form-data" id = 'select_section'>
                            <button href="#" class="list-group-item list-group-item-action py-2 ripple" type="submit" value="" name='select_section' id="select_section"><b>All Sections</b></button>
                            <?php 
                                //display all available sections
                             
                                    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                    $pdo = new PDO($dsn,"root",'');
                                    $sql = "select * from section where class_id=:class_id and course_id = :course_id";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                    $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);

                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                    while ($row = $stmt->fetch())
                                    { 
                                        array_push($sections, $row['section_id']);
                                        $dsn2 = "mysql:host=localhost;dbname=lms;port=3306";
                                        $pdo2 = new PDO($dsn2,"root",'');
                                        $sql2 = "SELECT * FROM learning_material LEFT JOIN learning_material_complete ON learning_material.learning_material_id = learning_material_complete.learning_material_id WHERE class_id= :class_id and section_id= :section_id and course_id= :course_id";
                                        $stmt2 = $pdo->prepare($sql2);
                                        $stmt2->bindParam(':class_id', $class_id);
                                        $stmt2->bindParam(':section_id', $row['section_id']);
                                        $stmt2->bindParam(':course_id', $row['course_id']);
                                        $stmt2->execute();
                                        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                        $total= $stmt2->rowCount();
                                        $all_sections[$row['section_id']]= $total;
                                            while ($row2 = $stmt2->fetch()){
                                                if($row2['engineer_id'] != NULL){
                                                    $completed_section++;
                                                }
                                            }
                                        $percent_complete= round(($completed_section/$total)*100);

                                        ?>
                                         <button href="#" class="list-group-item list-group-item-action py-2 ripple" type="submit" value="<?php echo $row['section_id']?>" name='select_section' id="select_section">
                                            <b><?php echo $row['section_name']?></b>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: calc(<?php echo $percent_complete?>%)">
                                                        <?php echo $percent_complete?> %
                                                </div>
                                            </div>
                                        </button>
                                        
                                <?php    
                                        $completed_section=0;
                                }
                                ?>
                            </div>
                            <div class="col-md-9">
                                <form action= 'learner_my_class.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>' method='POST' enctype = "multipart/form-data" id = 'update_status'>
                                    <div class="col" id= 'learning_materials'>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th>Section Name</th>
                                                <th>Document Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                </tr>
                                            </thead>
                                                <?php
                                                $last_saved=array();
                                                #this is for all session
                                                if($section_id == ''){
                                                    for($x=0; $x<count($sections); $x++){
                                                        $current_section= $sections[$x];
                                                        $total_material= $all_sections[$current_section];
                                                        if($current_section == 'Session 1' && $completed == TRUE){
                                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                            $pdo = new PDO($dsn,"root",'');
                                                            $sql = "select * from learning_material where class_id = :class_id and section_id = :section_id and course_id= :course_id";
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                                                            $stmt->bindParam(':section_id', $current_section , PDO::PARAM_STR);
                                                            $stmt->bindParam(':course_id', $course_id , PDO::PARAM_STR);
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
                                                                    $section_name = $row['section_name'];
                                                                    $count_material++;
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $row['section_name']?></td>
                                                                        
                                                                        <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                                                        <td><?php echo $row['description']?></td>
                                                                        <td><button class="btn btn-light" disabled>Completed</button></td>
                                                                    </tr>  
                                                                <?php
                                                                }
                                                                else{
                                                                ?>
                                                                <tr>
                                                                        <td><?php echo $row['section_name']?></td>
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
                                                                    $updateSectionStatus= updateSectionStatus($current_section, $engineer_id, $class_id, $course_id);
                                                                }

                                                            }//end of inner if
                                                            elseif ($completed == TRUE) {
                                                                $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                                $pdo = new PDO($dsn,"root",'');
                                                                $sql = "select * from learning_material lm inner join section s on lm.class_id = s.class_id and lm.section_id = s.section_id and lm.course_id = s.course_id where  class_id = :class_id and section_id = :section_id";
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
                                                                            <td><?php echo $row['section_name']?></td>
                                                                            <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                                                            <td><?php echo $row['description']?></td>
                                                                            <td><button class="btn btn-light" disabled>Completed</button></td>
                                                                        </tr>  
                                                                    <?php
                                                                    }
                                                                    else{
                                                                    ?>
                                                                    <tr>
                                                                            <td><?php echo $row['section_name']?></td>

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
                                                                    $updateSectionStatus= updateSectionStatus($current_section, $engineer_id, $class_id, $course_id);
                                                                }
                                                            }
                                                            var_dump($sections);
                                                            var_dump($all_sections);
                                                            
                                                        }//end of for loop
                                                    }//end of if statement
                                                    else{
                                                        $dsn2 = "mysql:host=localhost;dbname=lms;port=3306";
                                                        $pdo2 = new PDO($dsn2,"root",'');
                                                        $query2 = 'select * from section_status ss inner join section s on s.section_id = ss.section_id and s.class_id = ss.class_id where s.class_id=:class_id and engineer_id= :engineer_id';
                                                        $stmt2 = $pdo2->prepare($query2);
                                                        $stmt2->bindParam(":class_id", $class_id);
                                                        $stmt2->bindParam(":engineer_id", $engineer_id);
                                                        $stmt2->execute();
                                                        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                                        $last_saved=array();

                                                        while ($row = $stmt2->fetch()){
                                                            $value= $row['section_name'];
                                                            $last_saved[]= strval($value);
                                                        }
                                                        
                                                        if(in_array($section_id, $last_saved) == TRUE || $row['section_name'] =='Session 1'){
                                                            
                                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                            $pdo = new PDO($dsn,"root",'');
                                                            $sql = "select * from learning_material lm inner join section s on lm.class_id = s.class_id and lm.section_id = s.section_id and lm.course_id = s.course_id where lm.class_id=:class_id and s.section_id = :section_id";
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
                                                                        <td><?php echo $row['section_name']?></td>
                                                                        <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                                                        <td><?php echo $row['description']?></td>
                                                                        <td><button class="btn btn-light" disabled>Completed</button></td>
                                                                    </tr>  
                                                                <?php
                                                                }
                                                                else{
                                                                ?>
                                                                <tr>
                                                                        <td><?php echo $row['section_name']?></td>
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
                                                            <tr>
                                                                <td colspan='4' class='text-center'><h1>You have not completed previous sections</h1></td>
                                                            </tr> 
                                                            
                                                            <?php
                                                        }
                                                    }
                                                    ?>      
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </main>
<?php include 'footer.html';?>