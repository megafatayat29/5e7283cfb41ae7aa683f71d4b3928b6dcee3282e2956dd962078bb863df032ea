<?php
$conn = mysqli_connect("localhost","root","","tes_mkm");
// $resultjson = array();

function get_parents($name) { 
	global $conn, $resultjson;
	$kondisi = 0;
	$sql = "SELECT id,name, parent_id FROM member where name = '$name'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $kondisi = $row['id'];
            $kondisiwhere = $row['parent_id'];
            while ($kondisi != 0) {
                $sql_parent = "SELECT id,name, parent_id FROM member where id = '$kondisiwhere'";
                $result_parent = $conn->query($sql_parent);
                while($rowparent = $result_parent->fetch_assoc()) {
                    $resultjson[] = $rowparent['name'];
                    $kondisi = $rowparent['id'];
                    $kondisiwhere = $rowparent['parent_id'];
                }
            }
        }
	    return $resultjson;
	} else {
	  echo "0 results";
	}
}

// $parents = get_parents('Marge');
// echo json_encode($parents);
echo '<br>';
$parents2 = get_parents('Derpina');
echo json_encode($parents2);
echo '<br>';
echo hex2bin('74686520616e7377657220697320372c2062757420686f773f');
$conn->close();
?>