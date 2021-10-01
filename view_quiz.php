<?php 
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );

?>
<?php include 'header.html';?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user"></i></div>
                                            Quiz List
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="#">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Course
                                        </a>
                                        <a class="btn btn-sm btn-light text-primary" href="create_quiz">
                                            <i class="me-1" data-feather="user-plus"></i>
                                            Add New Quiz
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
                                            <th>Quiz ID</th> 
                                            <th>Course ID</th>
                                            <th>Section ID</th>
                                            <th>Engineer ID</th>
                                            <th>Passing Mark</th>
                                            <th>Time Limit (Minute)</th>                                            
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select * from quiz';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['quiz_id'];?></td> 
                                            <td><?php echo $row['course_id'];?></td> 
                                            <td><?php echo $row['section_id'];?></td>
                                            <td><?php echo $row['engineer_id'];?></td>
                                            <td><?php echo $row['passing_mark'];?></td>
                                            <td><?php echo $row['time_limit'];?></td>  
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2 mx-2" href=""  title="Edit Quiz"><i data-feather="edit"></i></a>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="#!" title="View Quiz"><i data-feather="eye"></i></a>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href = 'delete_quiz.php?quiz_id=<?php echo $row['quiz_id'];?>' onclick = "return confirm('Are you sure you want to delete?')" title="Delete Quiz"><i data-feather="trash-2"></i></a>
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

<script type = "text/javascript">
    function confirmDelete(){
        const answer = confirm('Are you sure you want to delete quiz?');

        if (answer)
        {
            <?php 
                
            ?>

            alert('Quiz has been deleted');
        }
    }
</script>