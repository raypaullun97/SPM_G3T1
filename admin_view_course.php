<?php 
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
?>
<?php include 'admin_header.html';?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user"></i></div>
                                            Course List
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="admin_create_course">
                                            <i class="me-1" data-feather="user-plus"></i>
                                            Add New Course
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-bordered" id="datatablesSimple"> 
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Course ID</th> 
                                            <th>Course Name</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select * from course';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['course_id'];?></td> 
                                            <td><?php echo $row['course_name'];?></td> 
                                            <td><?php echo $row['description'];?></td> 
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="admin_edit_course.php?course_id=<?php echo $row['course_id']?>"  title="Edit Course"><i data-feather="edit"></i></a>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!" title="Delete Course"><i data-feather="trash-2"></i></a>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark" href="admin_view_class.php?course_id=<?php echo $row['course_id']?>" title="View Class"><i data-feather="arrow-right"></i></a>
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