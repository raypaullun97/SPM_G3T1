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


<?php include 'admin_header.html'; ?>

<script>
    function approveuser(id) {

        trid = id.split('-')[1];
        //alert(id);

        $.ajax({

            url: "update_enrollment.php",
            type: "post",
            data: {
                val: id
            },

            beforeSend: function() {
                console.log("Processing...");
            },
            success: function(result) {
                //alert(result);
                // $('table#sHold tr#'+trid).remove();
                //alert('Updated');
                if (result == "Enrolled") {
                    alert("Successfully enrolled");
                } else {
                    alert("Successfully rejected");
                }
                location.reload(true);


            }
        });

    }
</script>
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                Enrollment in <?php echo $_GET['course_id'] ?> <?php echo $_GET['class_id'] ?>
                            </h1>
                            <h1 class="page-header-title mt-2">
                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                Number of slots left: <?php echo $_GET['remaining_slot'] ?>
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="admin_view_class.php?course_id=<?php echo $_GET['course_id'] ?>">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to Class
                            </a>
                            <a class="btn btn-sm btn-light text-primary" href="admin_self_enrollment.php?course_id=<?php echo $_GET['course_id'] ?>&class_id=<?php echo $_GET['class_id'] ?>">
                                <i class="me-1" data-feather="arrow-right"></i>
                                Go to Self Enrollment
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
                    <form method="POST">


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
                                $prerequisite = "";
                                $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                $pdo = new PDO($dsn, "root", '');
                                $sql = 'select * from course_prerequisite where course_id =:course_id';
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindParam(':course_id', $_GET['course_id']);
                                $stmt->execute();
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                if ($row = $stmt->fetch()) {
                                    $prerequisite = $row['prerequisite'];
                                }
                                $engineer_id_trainer = "";
                                $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                $pdo = new PDO($dsn, "root", '');
                                $sql = 'select * from class where course_id =:course_id and class_id =:class_id';
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindParam(':class_id', $_GET['class_id']);
                                $stmt->bindParam(':course_id', $_GET['course_id']);
                                $stmt->execute();
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                if ($row = $stmt->fetch()) {
                                    $engineer_id_trainer = $row['engineer_id'];
                                }
                                
                                $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                $pdo = new PDO($dsn, "root", '');
                                if ($prerequisite == "") {
                                    $sql = 'select distinct e.engineer_id, e.engineer_name, username
                                    from engineer e
                                    where e.engineer_id not in (select distinct(engineer_id)
                                    from course_status 
                                    where course_id = :course_id and status = "Completed") 
                                    and e.engineer_id not in (select distinct(engineer_id)
                                    from learner_enrollment 
                                    where course_id = :course_id and status = "Enrolled")
                                    and e.engineer_id not in (select engineer_id
                                    from class 
                                    where course_id = :course_id and class_id = :class_id)
                                                                ';
                                    $stmt = $pdo->prepare($sql);
                                } else {
                                    $sql = 'select distinct e.engineer_id, e.engineer_name, username
                                    from engineer e
                                     
                                    where e.engineer_id not in (select distinct(engineer_id)
                                    from course_status 
                                    where course_id = :course_id and status = "Completed") 
                                    and e.engineer_id not in (select distinct(engineer_id)
                                    from learner_enrollment 
                                    where course_id = :course_id and status = "Enrolled")
                                    and e.engineer_id not in (select engineer_id
                                    from class 
                                    where course_id = :course_id and class_id = :class_id)
                                    and e.engineer_id  in (select engineer_id
                                    from course_status 
                                    where course_id = :prerequisite and status = "Completed")
                                                                ';
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindParam(':prerequisite', $prerequisite);
                                }


                                
                                $stmt->bindParam(':course_id', $_GET['course_id']);
                                $stmt->bindParam(':class_id', $_GET['class_id']);
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

                                $stmt = null;
                                $pdo = null;
                                ?>
                            </tbody>
                        </table>

                        <!--Submit Assign engineers-->
                        <div class="text-center">
                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Assign</button>


                        </div>
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        if (empty($_POST['assign'])) {

                    ?>
                            <script type="text/javascript">
                                alert('Please select engineers for this class.');
                            </script>
                            <?php
                        } else {

                            if (count($_POST['assign']) > $_GET['remaining_slot']) {
                            ?>
                                <script type="text/javascript">
                                    alert('Exceeded capacity of engineer for this class. Please check again.');
                                    location.href = 'admin_enrollment.php?course_id=<?php echo $_GET['course_id'] ?>&class_id=<?php echo $_GET['class_id'] ?>&remaining_slot=<?php echo $_GET['remaining_slot'] ?>';
                                </script>
                            <?php
                            } else {
                                for ($i = 0; $i < count($_POST['assign']); $i++) {
                                    $status_enrol = 'Enrolled';
                                    $dao = new Assign_EngineerDAO();
                                    $status = $dao->addEngineer($_POST['assign'][$i], $_GET['course_id'], $_GET['class_id'], $status_enrol);
                                    $status = $dao->addEngineer_course_status($_POST['assign'][$i], $_GET['course_id'], "Pending");
                                } ?>
                                <script type="text/javascript">
                                alert('Enrollment has been added successfully');
                                location.href = 'admin_view_class.php?course_id=<?php echo $_GET['course_id'] ?>&class_id=<?php echo $_GET['class_id'] ?>';
                                </script>
                                
                                
                    <?php
                            }
                        }
                    }
                    $stmt = null;
                    $pdo = null;



                    ?>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.html'; ?>