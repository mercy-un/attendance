<?php
include_once 'data1.php';
if(isset($_POST['save']))
{	 
	 $surname = $_POST['surname'];
	 $othernames = $_POST['othernames'];
	 $matric_no = $_POST['matric_no'];
	 $department = $_POST['department'];
     $level = $_POST['level'];

	 $sql = "INSERT INTO student (surname,othernames,matric_no,department,level)
	 VALUES ('$surname','$othernames','$matric_no','$department', '$level')";
	 if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>