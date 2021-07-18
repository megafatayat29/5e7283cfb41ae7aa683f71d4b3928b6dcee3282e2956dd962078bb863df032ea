<?php
$conn = mysqli_connect("localhost","root","","tes_mkm");
function get_children($name) {
	global $conn;
	
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

// $children = get_children('Samantha');
// echo json_encode($children);
/* akan menulis : ["James", "April", "Charles"] */
$children = get_children('John');
echo json_encode($children);
/* akan menulis : [] */