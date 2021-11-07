<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php
spl_autoload_register(
    function ($class) {
        require_once "model/$class.php";
    }
);
$course_id =  $_GET['course_id'] ;
?>
<?php include 'admin_header.html'; ?>
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                Class List of <?php echo $_GET['course_id'] ?>
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="admin_view_course">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to Course
                            </a>
                            <a class="btn btn-sm btn-light text-primary" href="admin_create_class?course_id=<?php echo $_GET['course_id'] ?>">
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
                    <table class="table table-hover table-bordered" id="datatablesSimple">
                        <thead class="thead-dark">
                            <tr>
                                <th>Class ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Amount</th>
                                <th>Trainer</th>
                                <th>No Of Students Enrolled/Capacity</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                            $pdo = new PDO($dsn, "root", '');
                            $sql = 'select * from class c inner join engineer e on c.engineer_id = e.engineer_id where course_id= :course_id';
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':course_id', $_GET['course_id'], PDO::PARAM_STR);
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $stmt->fetch()) { ?>
                                <tr>
                                    <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN-->
                                    <td><?php echo $row['class_id']; ?></td>
                                    <td><?php $start_date = strtotime($row['start_date']); echo  date('d-M', $start_date); ?> - <?php $end_date = strtotime($row['end_date']); echo  date('d-M', $end_date); ?></td> 
                                            <td><?php $start_time = strtotime($row['start_time']); echo  date('g.iA', $start_time);?> - <?php $end_time = strtotime($row['end_time']); echo  date('g.iA', $end_time);?></td> 
                                    <td><?php echo $row['day']; ?> Days</td>
                                    <td><?php echo $row['engineer_name']; ?></td>
                                    <td><?php 
                                            $class_id = $row['class_id'];
                                            $con = mysqli_connect('localhost', 'root', '');
                                            mysqli_select_db($con, 'lms');
                                            $sql = "select * from learner_enrollment where class_id ='$class_id' and course_id = '$course_id' and status = 'Enrolled'";
                                            $result = mysqli_query($con, $sql);
                                            $number_of_results = mysqli_num_rows($result);
                                            $remaining_slot = (int)$row['capacity'] - $number_of_results  ;
                                            echo $number_of_results . '/'. $row['capacity']; 
                                            ?></td>
                                    <td>
                                        <?php $class_id = $row['class_id']; ?>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2 mx-2" href="admin_edit_class.php?course_id=<?php echo $row['course_id']?>&class_id=<?php echo $row['class_id']?>" title="Edit Class"><i data-feather="edit"></i></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="#!" title="Delete Class"><i data-feather="trash-2"></i></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="admin_enrollment.php?course_id=<?php echo $row['course_id'] ?>&class_id=<?php echo $row['class_id'] ?>&remaining_slot=<?php echo $remaining_slot ?>" title="Manual Enrollment"><i data-feather="user-plus"></i></a>
                                        <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark" href=""  title="Assign Engineer" data-toggle="modal" data-target="#exampleModalLong"><i data-feather="user-plus"></i></button> -->
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="admin_view_enrollment.php?course_id=<?php echo $row['course_id'] ?>&class_id=<?php echo $row['class_id'] ?>" title="View Enrollment List"><i data-feather="users"></i></a>
                                        <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark mx-2" onclick="runPop(this);" href=""  title="Self-Enrollment"   value="<?php $class_id; ?>"><i data-feather="user-check"></i></button> -->
                                        <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark mx-2" onclick="runPop(this);" href=""  title="Self-Enrollment"  data-toggle="modal" data-target="#self_enrollment" value="<?php $class_id; ?>"><i data-feather="user-check"></i></button> -->
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
<script>
    function runPop(el) {
        var report = el.parentNode.parentNode.cells[0].innerHTML;
        //console.log(report);
        document.getElementById("label_class_id").innerText = report;
    }

</script>

<?php include 'footer.html'; ?>