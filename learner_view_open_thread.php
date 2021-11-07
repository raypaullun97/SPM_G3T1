<?php include 'learner_header.html';?>
<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

$thread_id = $_GET['thread_id'];

$engineer_id = "1";
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
                                            View Open Forum of Thread <?php echo $thread_id ?>
                                        </h1>
                                        <div class="page-header-subtitle">You can post and chat with other learners</div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        <a class="btn btn-sm btn-light text-primary "  href="learner_view_open_forum.php?">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back
                                        </a>
                                        <a class="btn btn-sm btn-light text-primary "  href="learner_create_post.php?forum_id=1&thread_id=<?php echo $thread_id?>">
                                            <i class="me-1" data-feather="user-plus"></i>
                                            Add New Post
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
                                
                                <table class="table table-hover table-bordered" id="datatablesSimple"> 
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Post ID</th> 
                                            <th>Description</th> 
                                            <th>Post By</th>
                                            <th>Date created and Time</th>
                                            
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select * from post p
                                            inner join thread t on t.thread_id = p.thread_id
                                            inner join engineer e on e.engineer_id = p.engineer_id
                                            inner join forum f on f.forum_id = t.forum_id 
                                            where  type = "open"
                                            and f.forum_id = 1 
                                            and t.thread_id = :thread_id';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(":thread_id",$thread_id,PDO::PARAM_INT);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {
                                            
                                        ?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['post_id'];?></td>
                                            <td><?php echo $row['p_description'];?></td>
                                            <td><?php echo $row['engineer_name'];?></td>
                                            <td><?php echo $row['post_date'];?> <?php echo $row['post_time'];?> </td>
                                            
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
