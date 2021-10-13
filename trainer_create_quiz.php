<?php 
 spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

include 'header.html';?>

            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Create Quiz
                                        </h1>
                                        <div class="page-header-subtitle">Creation of Quizzes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class = 'container'>
                        <form action = "trainer_create_question.php" method = "POST" enctype = "multipart/form-data" id = 'newSectionForm'>
                            <div class="form-group row" style = 'margin-top: 20px;'>
                                <label for="PassingMark" class="col-sm-2 col-form-label">Passing Mark</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name = 'passing_mark' id="passing_mark" placeholder="Passing Mark">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    Time Limit
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name = 'time_limit' id="time_limit" placeholder="Time Limit of Quiz in Minutes"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" style = "margin-top: 10px; float:right;">Next</button>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                    </div>
                </main>
<?php include 'footer.html';?>