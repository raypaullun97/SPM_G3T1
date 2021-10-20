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
                                            Confirmed Class List of <?php echo $_GET["course_id"] ?> <?php echo $_GET["class_id"] ?>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="admin_view_class.php?course_id=<?php echo $_GET['course_id'] ?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Class
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
                                            <th>Engineer ID</th> 
                                            <th>Engineer Name</th>
                                            <th>Engineer Email</th>
                                            


                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select * from class c inner join learner_enrollment le on c.class_id = le.class_id and c.course_id = le.course_id
                                                    inner join engineer e on e.engineer_id = le.engineer_id
                                                    where c.class_id = :class_id and c.course_id = :course_id and le.status = "Enrolled" ';
                                            
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':course_id', $_GET['course_id'] , PDO::PARAM_STR);
                                            $stmt->bindParam(':class_id', $_GET['class_id'] , PDO::PARAM_STR);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch())
                                        {?>
                                        <tr> 
                                            <!--FETCHING DATA FROM EACH  
                                                ROW OF EVERY COLUMN--> 
                                            <td><?php echo $row['engineer_id'];?></td> 
                                            <td><?php echo $row['engineer_name'];?></td> 
                                            <td><?php echo $row['username'];?></td>
                                            <td>
                                            <form method="post"  action ="withdraw_enrollment.php">
                                                <input type="hidden" name="enrollment_id" value="<?php echo $row['enrollment_id']?>">
                                                <input type="hidden" name="course_id" value="<?php echo $row['course_id']?>">
                                                <input type="hidden" name="engineer_id" value="<?php echo $row['engineer_id']?>">
                                                <input type="hidden" name="status" value="Withdrawn">
                                                <button  name= "withdraw" value="withdraw" class="btn btn-primary mt-auto" type="submit">Withdraw</button>
                                            </form> 
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