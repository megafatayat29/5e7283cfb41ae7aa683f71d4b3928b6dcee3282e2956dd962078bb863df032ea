<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tes_mkm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function get_children($name) {
	global $conn;
	$resultjson = array();

	$sql = "SELECT id, name, parent_id FROM member where name = '$name'";
	$result = $conn->query($sql);

	$resultjson = array();

	if ($result->num_rows > 0) {

	  while($row = $result->fetch_assoc()) {
	  	$sql_parent = "SELECT id,name, parent_id FROM member where parent_id = ".$row['id']."";
		$result_parent = $conn->query($sql_parent);
		while($rowparent = $result_parent->fetch_assoc()) {
		  	$resultjson[] = $rowparent['name'];
		}
	  }

	  return $resultjson;
	} else {
	  echo "0 results";
	}
}

$children = get_children('Samantha');
echo json_encode($children);
echo '<br>';
/* akan menulis : ["James", "April", "Charles"] */
$children = get_children('John');
echo json_encode($children);
/* akan menulis : [] */