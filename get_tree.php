<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tes_mkm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function get_tree($name = "root") {
	global $conn;
	
	$sql = "SELECT * FROM member";
	$result = $conn->query($sql);

	$resultjson = array();
	$data = array();
	if ($result->num_rows > 0) {

	  while($row = $result->fetch_assoc()) {  
	    $data[] = $row;
	  }

	  $tree = buildtree($data);

	  return $tree;
	} else {
	  echo "0 results";
	}
}

function buildtree($src_arr, $parent_id = 0, $tree = array())
{
    foreach($src_arr as $idx => $row)
    {
        if($row['parent_id'] == $parent_id)
        {
            foreach($row as $k => $v)
                $tree[$row['id']][$k] = $v;
            unset($src_arr[$idx]);
            $tree[$row['id']]['children'] = buildtree($src_arr, $row['id']);
        }
    }
    ksort($tree);
    return $tree;
}

$tree = get_tree();
echo json_encode($tree);
$conn->close();
?>