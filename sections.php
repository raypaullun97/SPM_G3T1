

<?php 
    include 'header.html';
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
?>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/main.js"></script>




            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Sections
                                        </h1>
                                        <div class="page-header-subtitle">View and creation of sections</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class = 'container'>
                    <div class="row" style = 'margin-top: 20px;'>

                    <!-- Main page content-->
                    <?php
                        $class_id = '2'; #to be changed according to which class
                        $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                        $pdo = new PDO($dsn,"root",'');
                        $sql = 'select * from section where class_id = :class_id';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);

                        while ($row = $stmt->fetch())
                        {
                    ?>
                            <div class="col-4 mb-4">
                            <div class="card h-100" style="width: 20rem;" >
                                <div class="card-header"><?php echo $row['section_name'];?> 
                                </div>
                                <div class="card-body flex-column d-flex">
                                    <p class="card-text"><?php echo $row['description']?></p>
                                    <a href="#" class="btn btn-primary">View Details</a>
                                    <a href ='delete_section.php?section_id=<?php echo $row['section_id'];?>' class = "btn btn-danger mt-2"">Delete Section</a>
                                </div>
                            </div>
                            </div>
                                    
                    <?php    
                        };
                    ?>
                        </div>

                    </div>
                </main>
<?php include 'footer.html';?>

<script type = "text/javascript">
    function delSection(section_id)
    {
        $conn_manager = new ConnectionManager();
        $pdo = $conn_manager->getConnection();

        $sql = 'delete from section where section_id = :section_id';
        $stmt1 = $pdo->prepare($sql);
        $stmt1->bindParam(":section_id",$section_id);

        $delStatus = $stmt1->execute();
        $stmt1 = null;
        $pdo = null;

        return $delStatus;
    }

    function test_button()
    {
    }
</script>