<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php
spl_autoload_register(
    function ($class) {
        require_once "model/$class.php";
    }
);
?>
<?php include 'header.html'; ?>
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
                                <th>Amount of days</th>
                                <th>Trainer</th>
                                <th>Capacity</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                            $pdo = new PDO($dsn, "root", '');
                            $sql = 'select * from class where course_id= :course_id';
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':course_id', $_GET['course_id'], PDO::PARAM_STR);
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $stmt->fetch()) { ?>
                                <tr>
                                    <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN-->
                                    <td><?php echo $row['class_id']; ?></td>
                                    <td><?php echo $row['start_date']; ?></td>
                                    <td><?php echo $row['end_date']; ?></td>
                                    <td><?php echo $row['day']; ?></td>
                                    <td><?php echo $row['engineer_id']; ?></td>
                                    <td><?php echo $row['capacity']; ?></td>
                                    <td>
                                        <?php $class_id = $row['class_id']; ?>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2 mx-2" href="" title="Edit Class"><i data-feather="edit"></i></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="#!" title="Delete Class"><i data-feather="trash-2"></i></a>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark" href="" title="Assign Engineer" data-toggle="modal" data-target="#exampleModalLong"><i data-feather="user-plus"></i></button>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mx-2" href="admin_self_enrollment.php?course_id=<?php echo $row['course_id'] ?>&class_id=<?php echo $row['class_id'] ?>" title="View Enrollment"><i data-feather="user-check"></i></a>
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
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content" width='45'>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Assign learners to <?php echo $_GET['course_id'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <div class="container-fluid px-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-hover table-bordered" id="datatablesSimple">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>Engineer ID</th>
                                                                <th>Engineer Name</th>
                                                                <th>Engineer username</th>
                                                                <th>Assign</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                            $pdo = new PDO($dsn, "root", '');
                                                            $sql = 'select course_status.course_id,course_status.engineer_id
                                                                            from course_status
                                                                            inner join course_prerequisite on course_prerequisite.course_id = :course_id and course_prerequisite.prerequisite = course_status.course_id where not course_status.course_id = :course_id
                                                                        ';
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->bindParam(':course_id', $_GET['course_id']);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row = $stmt->fetch()) {
                                                                $pdo = new PDO($dsn, "root", '');
                                                                $sql = 'select DISTINCT engineer.engineer_id,engineer.username,engineer.engineer_name
                                                                            from engineer  
                                                                            inner join course_status on course_status.course_id = :course_id and engineer.engineer_id = course_Status.engineer_id and course_status.course_id != :course';
                                                                $stmt = $pdo->prepare($sql);
                                                                $stmt->bindParam(':course', $_GET['course_id']);
                                                                $stmt->bindParam(':course_id', $row['course_id']);
                                                                $stmt->execute();
                                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                                                while ($row = $stmt->fetch()) {
                                                            ?>
                                                                    <tr>
                                                                        <!--FETCHING DATA FROM EACH  
                                                                                ROW OF EVERY COLUMN-->

                                                                        <td><?php echo $row['engineer_id']; ?></td>
                                                                        <td><?php echo $row['engineer_name']; ?></td>
                                                                        <td><?php echo $row['username']; ?></td>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name='assign[]' value="<?php echo $row['engineer_id'] ?>" id="flexCheckDefault">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            $stmt = null;
                                                            $pdo = null;
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                    <!--Submit Assign engineers-->
                                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Assign</button>
                                                    <?php
                                                    if (isset($_POST['submit'])) {
                                                        if (empty($_POST['assign'])) {

                                                    ?>
                                                            <script type="text/javascript">
                                                                alert('Please select engineers for this class.');
                                                            </script>
                                                            <?php
                                                        } else {
                                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                            $pdo = new PDO($dsn, "root", '');
                                                            $sql = 'select * from class where course_id= :course_id';
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->bindParam(':course_id', $_GET['course_id']);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row = $stmt->fetch()) {
                                                                $pdo = new PDO($dsn, "root", '');
                                                                $sql = 'select count(engineer_id) from learner_enrollment where class_id= :class_id';
                                                                $stmt = $pdo->prepare($sql);
                                                                $stmt->bindParam(':class_id', $row['class_id']);
                                                                $stmt->execute();
                                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                                while ($row = $stmt->fetch()) {
                                                                    if (count($_POST['assign']) > $row['capacity']) {
                                                            ?>
                                                                        <script type="text/javascript">
                                                                            alert('Exceeded capacity of engineer for this class. Please check again.');
                                                                            location.href = 'admin_view_class.php?course_id=<?php echo $row['course_id'] ?>';
                                                                        </script>
                                                                    <?php
                                                                    } else {
                                                                        for ($i = 0; $i < count($_POST['assign']); $i++) {
                                                                            $status_enrol = 'enrolled';
                                                                            $dao = new Assign_EngineerDAO();
                                                                            $status = $dao->addEngineer($_POST['assign'][$i], $_GET['course_id'], $row['class_id'], $status_enrol);
                                                                        } ?>
                                                                        <script type="text/javascript">
                                                                            alert('Class has been added successfully!');
                                                                            location.href = 'admin_view_enrollment.php?course_id=<?php echo $row['course_id'] ?>';
                                                                        </script>
                                                    <?php
                                                                    }
                                                                }}
                                                                $stmt = null;
                                                                $pdo = null;
                                                            }
                                                        }
                                                    }


                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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