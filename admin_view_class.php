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
                                            Class List of <?php echo $_GET['course_id']?>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="admin_view_course">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Course
                                        </a>
                                        <a class="btn btn-sm btn-light text-primary" href="admin_create_class?course_id=<?php echo $_GET['course_id']?>">
                                            <i class="me-1" data-feather="user-plus"></i>
                                            Add New Class
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
                                
                                <table class="table table-hover table-bordered" id="datatablesSimple" > 
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Class ID</th> 
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Amount of days</th>
                                            <th>Trainer</th>
                                            <th>Capacity</th>
                                            <th>Actions</th>
                                            
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select * from class where course_id= :course_id';
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':course_id', $_GET['course_id'] , PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['class_id'];?></td> 
                                            <td><?php echo $row['start_date'];?></td> 
                                            <td><?php echo $row['end_date'];?></td>
                                            <td><?php echo $row['day'];?></td>
                                            <td><?php echo $row['engineer_id'];?></td>
                                            <td><?php echo $row['capacity'];?></td>  
                                            <td>
                                                <?php $class_id = $row['class_id'];?>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2 mx-2" href=""  title="Edit Class"><i data-feather="edit"></i></a>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="#!" title="Delete Class"><i data-feather="trash-2"></i></a>
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark mx-2 " href="" title="Assign Engineer"  data-toggle="modal" data-target="#exampleModal"><i data-feather="user"></i></button>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="admin_self_enrollment.php?course_id=<?php echo $row['course_id']?>&class_id=<?php echo $row['class_id']?>" title="View Class"><i data-feather="user-check"></i></a>
                                                <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark mx-2" onclick="runPop(this);" href=""  title="Self-Enrollment"   value="<?php $class_id;?>"><i data-feather="user-check"></i></button> -->
                                                <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark mx-2" onclick="runPop(this);" href=""  title="Self-Enrollment"  data-toggle="modal" data-target="#self_enrollment" value="<?php $class_id;?>"><i data-feather="user-check"></i></button> -->
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
                </main>
<script>

function runPop(el) {
    var report = el.parentNode.parentNode.cells[0].innerHTML;
    //console.log(report);
    document.getElementById("label_class_id").innerText = report;
}

</script>
<?php include 'footer.html';?>