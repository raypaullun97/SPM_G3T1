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
$class_id = isset($_GET["c_id"]) ? $_GET["c_id"] : "";
  
// initialize object
$learning_material = new LearningMaterial($db);
  
// query products
$stmt = $learning_material->search($section_id, $class_id);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num > 0) {
  
    // products array
    $result_arr = array();
    $result_arr["records"] = array();
  
    while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $item = array(
            "learning_material_id" => $learning_material_id,
            "section_id" => $section_id,
            "class_id" => $class_id,
            "description" => $description,
            "type" => $type,
            "document_name" => $document_name,
        );
  
        array_push($result_arr["records"], $item);
    }

    // Add info node (1 per response)
    $date = new DateTime(null, new DateTimeZone('Asia/Singapore'));
    $result_arr["info"] = array(
        "author" => "JC",
        "response_datetime_singapore" => $date->format('Y-m-d H:i:sP')
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($result_arr);
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