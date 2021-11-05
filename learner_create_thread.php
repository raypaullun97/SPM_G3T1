<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
    $engineer_id = 1;
    $forum_id = $_GET['forum_id'];
    if (isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];
        $class_id = $_GET['class_id'];
    }
    if (isset($_POST['submit']))
    {    
            $dao = new ThreadDAO();
            $status = $dao->add( $forum_id ,$_POST['t_description'],$engineer_id);
        if (!isset($_GET['course_id'])){
?>
            <script type="text/javascript">
            alert('Thread has been added successfully!');
            location.href = 'learner_view_open_forum.php';
            </script>
<?php
        }
        else{
?>
            <script type="text/javascript">
            alert('Thread has been added successfully!');
            location.href = 'learner_my_class_thread.php?course_id=<?php echo $_GET['course_id']?>&class_id=<?php echo $_GET['class_id']?>';
            </script>
<?php            
        }
    }
?>

<?php include 'header.html';?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                            Add Thread
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <?php 
                                            if($forum_id != 1){
                                                $new_href = "learner_my_class_thread.php?course_id=$course_id&class_id=$class_id";
                                            }

                                            else{
                                                $new_href="learner_view_open_forum.php";
                                            }
                                        ?>
                                        <a class="btn btn-sm btn-light text-primary" href= <?php echo $new_href?>>
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Thread List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <form method="post" id="thread_form" class="checkout__form">
                                <div class="col-xl-12">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Thread Details</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Group (description)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="t_description">Description</label>
                                                    <input class="form-control" required name = 't_description' id="t_description" type="text" placeholder="Enter your description" value="" />
                                                </div>
                                                <!-- Submit button-->
                                                <button class="btn btn-primary" type="submit" id = "submit" name = "submit">Add Thread</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
<?php include 'footer.html';?>