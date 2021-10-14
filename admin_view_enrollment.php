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
                                            Class List of <?php echo $_GET["course_id"] ?>
                                        </h1>
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
                                            <th>Course ID</th>              
                                            <th>Class ID</th>


                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                            $pdo = new PDO($dsn,"root",'');
                                            $sql = 'select engineer.engineer_id, engineer.engineer_name, engineer.username,learner_enrollment.course_id,learner_enrollment.class_id
                                            from ((learner_enrollment
                                            inner join engineer on engineer.engineer_id = learner_enrollment.engineer_id and learner_enrollment.course_id = :course_id)
                                            inner join class on class.class_id = learner_enrollment.class_id)';
                                            
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':course_id', $_GET['course_id'] , PDO::PARAM_STR);
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
                                            <td><?php echo $row['course_id'];?></td> 
                                            <td><?php echo $row['class_id'];?></td> 
                                            
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