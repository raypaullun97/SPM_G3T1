
<?php 
    include 'header.html';
    $section_id=''

?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Learning Materials
                                        </h1>
                                        <div class="page-header-subtitle">Example dashboard overview and content summary</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                     <!-- Sidebar -->
                <body>
                    <div class='container'>
                    <div class="col">
                    <nav id="sidebarMenu" class="d-lg-block sidebar bg-white">
                        <div class="position-sticky">
                        <div class="list-group list-group-flush mx-3 mt-4">
                            <?php 
                                $class_id= 'IS212G2'; //identify using this
                                    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                    $pdo = new PDO($dsn,"root",'');
                                    $sql = "select * from section where class_id=:class_id";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindParam(':class_id', $class_id , PDO::PARAM_STR);

                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                    while ($row = $stmt->fetch())
                                    {   
                                        ?>
                                         <a href="#" class="list-group-item list-group-item-action py-2 ripple" onclick="select_materials(<?php echo $row['section_id']?>)">
                                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Section <?php echo $row['section_id']?></span>
                                        </a>
                                
                                <?php    
                                    };
                                ?>
                           
                        </div>
                        </div>
                        </div>
                    </nav>
                    <!-- Sidebar -->
                    <div class="col" id= 'learning_materials'>
                        <table class="table">
                            <thead>
                                <tr>
                                <th>Section</th>
                                <th>Document Name</th>
                                <th>Description</th>
                                </tr>
                            </thead>
                                <?php
                                    $dsn = "mysql:host=localhost;dbname=lms;port=3306";
                                    $pdo = new PDO($dsn,"root",'');
                                    $sql = "select * from learning_material";
                                    $stmt = $pdo->prepare($sql);

                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
                                   

                                    while ($row = $stmt->fetch())
                                    {   
                                        $file_location= "learningmaterials/". $row["document_name"];
                                        $file_location .= $row['type'];
                                        ?>
                                        <tr>
                                        <td><?php echo $row['section_id']?></td>
                                        <td ><a href="<?php echo $file_location?>"><?php echo $row['document_name']?></a></td>
                                        <td><?php echo $row['description']?></td>
                                        </tr>                                
                                    <?php    
                                        };
                                    ?>
                        </table>
                    </div>
                </div>
                </body>
<?php include 'footer.html';?>

<script>
    function select_materials(section_id){
        
        var request = new XMLHttpRequest(); // Prep to make an HTTP request
        request.onreadystatechange = function() {

            if( this.readyState == 4 && this.status == 200 ) {
                var response_json= JSON.parse(this.responseText);
                var array= response_json.records;
                var content=`<table class="table">
                                <thead>
                                    <tr>
                                    <th>Section</th>
                                    <th>Document Name</th>
                                    <th>Description</th>
                                    </tr>
                                </thead>`;
            
            for (material of array){
                var section_id= material.section_id;
                var document_name= material.document_name;
                var description= material.description;
                var type= material.type;
                var document_full= "learningmaterials/" + document_name+type;

                content += `
                    <tr>
                        <td>${section_id}</td>
                        <td><a href="${document_full}">${document_name}</a></td>
                        <td>${description}</td>
                    </tr>
                `;
            }
            content += '</table>'
            document.getElementById('learning_materials').innerHTML= content;
            }
        }

        var url = 'http://localhost/SPM_G3T1/SPM_G3T1/model/config/learning_materials.php?s_id='+ section_id;
            
        request.open("GET", url, false);

        request.send();

    }
</script>