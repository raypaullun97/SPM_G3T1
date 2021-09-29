<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../ConnectionManager.php';
include_once 'database.php';
include_once '../LearningMaterial.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// get keywords
$section_id = isset($_GET["s_id"]) ? $_GET["s_id"] : "";
$class_id= isset($_GET["c_id"]) ? $_GET["c_id"] : "";
$description = isset($_GET["d"]) ? $_GET["d"] : "";
$type = isset($_GET["type"]) ? $_GET["type"] : "";
$document_name = isset($_GET["name"]) ? $_GET["name"] : "";
// initialize object
$learning_material = new LearningMaterial($db);
  
// query products
$stmt = $learning_material->insert($section_id, $description, $type, $document_name);

// check if more than 0 record found
if($stmt == 1) {
  
    // set response code - 200 OK
    http_response_code(200);
    echo json_encode(
        array("message" => "Created.")
    );
}
else {
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no items found
    echo json_encode(
        array("message" => "No items found.")
    );
}
?>