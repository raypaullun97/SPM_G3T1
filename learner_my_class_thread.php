<?php include 'learner_header.html';?>
<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
//session_start();
$course_id = $_GET['course_id'];
$class_id = $_GET['class_id'];
$engineer_id = "1";
$dsn = "mysql:host=localhost;dbname=lms;port=3306";
$pdo = new PDO($dsn,"root",'');
$sql = 'select * from forum 
        where  course_id = :course_id
        and class_id = :class_id ';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":course_id",$course_id,PDO::PARAM_STR);
$stmt->bindParam(":class_id",$class_id,PDO::PARAM_STR);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
if ($row = $stmt->fetch()){
    $forum_id = $row['forum_id'];
}
$stmt = null;
$pdo = null;
?>
<div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary ">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="book"></i></div>
                                            View <?php echo $course_id?> <?php echo $class_id?> Forum
                                        </h1>
                                        <div class="page-header-subtitle">You can chat with other learners</div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        <a class="btn btn-sm btn-light text-primary " style="float:right; " href="learner_create_thread.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>&forum_id=<?php echo $forum_id ?>">
                                            <i class="me-1" data-feather="user-plus"></i>
                                            Add New Thread
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-bordered"  id="datatablesSimple"> 
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Thread ID</th> 
                                            <th>Description</th> 
                                            <th>Post By</th>
                                            <th>Actions</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select * from thread t
                                                    inner join engineer e on e.engineer_id = t.engineer_id
                                                    inner join forum f on f.forum_id = t.forum_id 
                                                    where  course_id = :course_id
                                                    and class_id = :class_id ';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(":course_id",$course_id,PDO::PARAM_STR);
                                            $stmt->bindParam(":class_id",$class_id,PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {
                                            
                                        ?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['thread_id'];?></td>
                                            <td><?php echo $row['t_description'];?></td>
                                            <td><?php echo $row['engineer_name'];?></td>
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="learner_my_class_post.php?course_id=<?php echo $course_id?>&class_id=<?php echo $class_id?>&thread_id=<?php echo $row['thread_id']?>" title="View Post"><i data-feather="users"></i></a>
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
                    </div>
                </main>

<?php include 'footer.html';?>
