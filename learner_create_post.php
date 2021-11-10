<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
    $thread_id = $_GET['thread_id'];
    $engineer_id = 1;
    if (isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];
        $class_id = $_GET['class_id'];
    }
    if (isset($_POST['submit']))
    {
        echo $_POST['p_description'];
        date_default_timezone_set('Singapore');
        $time = date('h:i:s', time());
        $date = date('Y/m/d', time());

        $dao = new PostDAO();
        $status = $dao->add($thread_id, $_POST['p_description'],$engineer_id,$time,$date);
        if (!isset($_GET['course_id'])){
?>
            <script type="text/javascript">
            alert('Post has been added successfully!');
            location.href = 'learner_view_open_thread.php?thread_id=<?php echo $_GET['thread_id']?>';
            </script>
<?php
        }
        else{
?>
            <script type="text/javascript">
            alert('Post has been added successfully!');
            location.href = 'learner_my_class_post.php?course_id=<?php echo $_GET['course_id']?>&class_id=<?php echo $_GET['class_id']?>&thread_id=<?php echo $_GET['thread_id']?>';
            </script>
<?php            
        }
    
    }
?>
<?php include 'learner_header.html';?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                            Add Post
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <?php 
                                            if(isset($_GET['course_id'])){
                                                $new_href = "learner_my_class_post.php?course_id=$course_id&class_id=$class_id&thread_id=$thread_id";
                                            }

                                            else{
                                                $new_href= "learner_view_open_thread.php?thread_id=$thread_id";
                                            }
                                        ?>
                                        <a class="btn btn-sm btn-light text-primary" href=<?php echo $new_href?>>
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Post List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <form method="post" id="course_form" class="checkout__form">
                                <div class="col-xl-12">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Post Details</div>
                                        <div class="card-body">                     
                                            <!-- Form Group (description)-->                    
                                            <div class="mb-3">
                                                <label class="small mb-1" for="p_description">Description</label>
                                                <input class="form-control" required name="p_description" id="p_description" type="text" placeholder="Enter your description" value="" />
                                            </div>
                                            <!-- Submit button-->
                                            <button class="btn btn-primary" type="submit" id = "submit" name = "submit">Add Post</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
<?php include 'footer.html';?>