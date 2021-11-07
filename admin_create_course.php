<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
    if (isset($_POST['submit']))
    {
        if (empty($_POST['Course_ID'])  || empty($_POST['Course_Name']) || empty($_POST['description']))
        {
?>
            <script type="text/javascript">
            alert('Please enter all fields in the form!');
            </script>
<?php 
        }
        else
        {
            $dao = new CourseDAO();
            $status = $dao->add($_POST['Course_ID'], $_POST['Course_Name'],$_POST['description']);
?>
            <script type="text/javascript">
            alert('Course has been added successfully!');
            location.href = 'admin_view_course.php';
            </script>
<?php            
        }
    }

?>
<?php include 'admin_header.html';?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                            Add Course
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="admin_view_course.php">
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
                            <form method="post" id="course_form" class="checkout__form">
                                <div class="col-xl-12">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Course Details</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Course_ID">Course ID</label>
                                                        <input class="form-control" name = 'Course_ID' id="Course_ID"  type="text" placeholder="Enter your Course ID" value="" />
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Course_Name">Course Name</label>
                                                        <input class="form-control" name = 'Course_Name' id="Course_Name" type="text" placeholder="Enter your Course Name" value="" />
                                                    </div>
                                                </div>
                                                <!-- Form Group (description)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="description">Description</label>
                                                    <input class="form-control" name = 'description' id="description" type="text" placeholder="Enter your description" value="" />
                                                </div>
                                                <!-- Submit button-->
                                                <button class="btn btn-primary" type="submit" id = "submit" name = "submit">Add Course</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
<?php include 'footer.html';?>