<?php
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);
    if (isset($_POST['submit']))
    {
        if (empty($_POST['Class_ID'])  || empty($_POST['Course_Name']) || empty($_POST['Capacity'])
            || empty($_POST['Day']) || empty($_POST['start_register_date']) || empty($_POST['end_register_date'])
            || empty($_POST['start_date']) || empty($_POST['end__date']) || empty($_POST['start_time'])
            || empty($_POST['end_time']) || empty($_POST['engineer_id']))
        {
            echo $_POST['Class_ID'] ; echo $_POST['Course_Name'] ; echo $_POST['Capacity'];echo $_POST['Day'];
            echo $_POST['start_register_date'];echo $_POST['end_register_date'];echo $_POST['start_date'];echo $_POST['end__date'];
            echo $_POST['start_time'];echo $_POST['end_time'];echo $_POST['engineer_id'];
?>
            
            <script type="text/javascript">
            alert('Please enter all fields in the form!');
            </script>
<?php 
        }
        else
        {
            $dao = new ClassDAO();
            $status = $dao->add($_POST['Class_ID'], $_POST['Course_Name'],$_POST['Capacity']
                                ,$_POST['Day'],$_POST['start_register_date'],$_POST['end_register_date'],$_POST['start_date']
                                ,$_POST['end__date'],$_POST['start_time'],$_POST['end_time'],$_POST['engineer_id']);
?>
            <script type="text/javascript">
            alert('Class has been added successfully!');
            location.href = 'admin_view_class.php?course_id=<?php echo $_GET['course_id']?>';
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
                                            Add Class
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="admin_view_class.php?course_id=<?php echo $_GET['course_id']?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Class List
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
                                        <div class="card-header">Class Details</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Class_ID">Class Name</label>
                                                        <input class="form-control" required name = 'Class_ID' id="Class_ID"  type="text" placeholder="Enter your Class Name" value="" />
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Course_Name">Course Name</label>
                                                        <input class="form-control" required name = 'Course_Name' id="Course_Name" type="text" placeholder="Enter your Course Name" value="<?php echo $_GET['course_id']?>"  />
                                                    </div>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Capacity">Capacity</label>
                                                        <input class="form-control" required name = 'Capacity' id="Capacity"  type="number" placeholder="Enter capacity of the class" value="" />
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Day">Day</label>
                                                        <input class="form-control" required name = 'Day' id="Day" type="number" placeholder="Enter number of days of the class" value="" />
                                                    </div>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="start_register_date">Start Registration Date</label>
                                                        <input class="form-control" required name = 'start_register_date' id="start_register_date"  type="date" placeholder="Enter Start Registration Date" value="" />
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="end_register_date">End Registration Date</label>
                                                        <input class="form-control" required name = 'end_register_date' id="end_register_date" type="date" placeholder="Enter End Registration Date" value="" />
                                                    </div>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="start_date">Start Date</label>
                                                        <input class="form-control" required name = 'start_date' id="start_date"  type="date" placeholder="Enter Start Date" value="" />
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="end__date">End Date</label>
                                                        <input class="form-control" required name = 'end__date' id="end__date" type="date" placeholder="Enter End Date" value="" />
                                                    </div>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Course ID)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="start_time">Start Time</label>
                                                        <input class="form-control" required name = 'start_time' id="start_time"  type="time" placeholder="Enter Start Time" value="" />
                                                    </div>
                                                    <!-- Form Group (Course Name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="end_time">End Time</label>
                                                        <input class="form-control" required name = 'end_time' id="end_time" type="time" placeholder="Enter End Time" value="" />
                                                    </div>
                                                </div>
                                                
                                                <!-- Form Group (description)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1">Trainer</label>
                                                    <select required class="form-select" aria-label="Default select example" id="engineer_id" name="engineer_id">
                                                        <option selected disabled>Select a trainer:</option>
                                                        <?php
                                                            $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                                            $pdo = new PDO($dsn,"root",'');
                                                            $sql = 'select * from engineer e inner join qualified_courses q on e.engineer_id = q.engineer_id where course_id = :course_id';
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->bindParam(':course_id', $_GET['course_id'] , PDO::PARAM_STR);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row = $stmt->fetch())
                                                        {?>
                                                        <option value="<?php echo $row['engineer_id'];?>"><?php echo $row['engineer_name'];?></option>
                                                        <?php 
                                                            } 
                                                            $stmt = null;
                                                            $pdo = null;
                                                        ?> 
                                                </select>
                                                </div>
                                                <!-- Submit button-->
                                                <button class="btn btn-primary" type="submit" id = "submit" name = "submit">Add Class</button>
                                               
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
<?php include 'footer.html';?>