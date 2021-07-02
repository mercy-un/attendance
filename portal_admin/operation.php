<?php session_start();
include("../connect.php");


if(isset($_POST['admin_login'])){
$pass=trim($_POST['password']);
$pes=mysqli_query($con,"select * from admin where email='".$_POST['email']."' AND password='$pass'");
 if(mysqli_num_rows($pes)>0){
$row=mysqli_fetch_array($pes);
$_SESSION['attendanceadmin_id']=$row['id'];					
	echo '<script>
	location.href="dashboard.php"
	</script>';
}else{
	echo '<div class="alert alert-danger alert-dismissable" >
					<p class="pull-left"><i class="fa fa-ban" style="font-size:17px;"></i> OPPS! Incorrect login details.</p>
					<div class="clearfix"></div>
										</div>';
}
}

if(isset($_SESSION['attendanceadmin_id'])){
$ddd=mysqli_query($con,"select * from admin where id='".$_SESSION['attendanceadmin_id']."'");
$adm=mysqli_fetch_assoc($ddd);

}

if(isset($_POST['delete_student'])){
mysqli_query($con,"delete from student where id='".$_POST['delete_student']."'");
}

if(isset($_POST['add_student'])){
	
	
    $S_target_file = "temp_excel/".basename($_FILES["attachment"]["name"]);
	$S_Type = strtolower(pathinfo($S_target_file,PATHINFO_EXTENSION));
	
	if($S_Type !='xlsx' && $S_Type !='xls'){
		echo '<div class="alert alert-danger alert-dismissible" role="alert" style="display:block; padding:10px;">
                               <b><i class="fa fa-exclamation" style="margin-top:;"></i> OOPS</b>&nbsp; File type not allowed.
                            </div>';
	}else{
		
	$fn=time();
	move_uploaded_file($_FILES["attachment"]["tmp_name"],$fn.'.'.$S_Type);			
	$f=$fn.'.'.$S_Type;
	//////////////////////////
	include 'simplexlsx.class.php';
    $xlsx = new SimpleXLSX( $f );
    $fp = fopen( $fn.'.csv', 'w');
    foreach( $xlsx->rows() as $fields ) {
        fputcsv( $fp, $fields);
    }
    fclose($fp);
	///////////////////
	
		$file = fopen($fn.'.csv', "r");
	$no=0;
    while ($row = fgetcsv($file)) { 
	
	if($row[0]!='' && $row[4]!='' && strtolower($row[1])!='lastname' && strtolower($row[0])!='matric no'){
    $x=mysqli_query($con,"select * from student where matric_no='".$row[0]."'");
	
	if(mysqli_num_rows($x)==0){
		
	$qry=mysqli_query($con,"insert into `student`(surname,othernames,matric_no,department,level) 
	values('".$row[1]."','".$row[2]."','".$row[0]."','".$row[3]."','".$row[4]."')");	
	}else{
		
	$sol=mysqli_fetch_assoc($x);
	$smatric=$sol['matric_no'];
	
	$qry=mysqli_query($con,"update `student` set surname='".$row[1]."',othernames='".$row[2]."',department='".$row[3]."',level='".$row[4]."' where matric_no='$smatric'");	
	}
	$no=$no+1;
	
    }
    }
    fclose($file);
	unlink($f);
	unlink($fn.'.csv');
	
if($no>0){
		echo '<script>
		alert("Student Registered!")
		location.href="dashboard.php"
		</script>';
	}else{
	echo '<div class="alert alert-dismissible alert-danger">
				<strong>Oh Sorry!</strong> Nothing to upload, check file and try again.
              </div>';	
	}
	
	}
	
}

if(isset($_POST['add_course'])){
$ddt=mysqli_query($con,"select * from course where course_code='".$_POST['course_code']."'");
if(mysqli_num_rows($ddt)==0){
	
	$qry=mysqli_query($con,"insert into course(pin,course_code,description,left_co,right_co,top_co,bottom_co,start,end,str_start,str_end,date) values('','".trim($_POST['course_code'])."','".trim($_POST['course_description'])."','','','','','','',0,0,'')");
	if($qry){	
		echo '<script>
		alert("Course Added!")
		location.href="course_bank.php"
		</script>';
	}else{
		echo '<div class="alert alert-dismissible alert-danger">
				<strong>Oh Sorry!</strong> Unable to complete operation, please try again later.
              </div>';
	}
	
}else{
	echo '<div class="alert alert-danger alert-dismissable" >
					<p class="pull-left"><i class="fa fa-ban" style="font-size:17px;"></i> OPPS! Course already added.</p>
					<div class="clearfix"></div>
										</div>';
}
}


if(isset($_POST['delete_course'])){
mysqli_query($con,"delete from course where id='".$_POST['delete_course']."'");
}


if(isset($_POST['schedule_attendance'])){
	//pin,course_code,description,left_co,right_co,top_co,bottom_co,start,end,str_start,str_end,date
	$pin=substr(str_shuffle("0123456789ADCDEFGHIJKLMONPQRST"),0,6);
	
	$start=DateTime::createFromFormat('H:i', $_POST['start'])->format('d M Y, h:ia');
	$end=DateTime::createFromFormat('H:i', $_POST['end'])->format('d M Y, h:ia');
	
	$qry=mysqli_query($con,"update course set pin='$pin',left_co='".$_POST['left']."',right_co='".$_POST['right']."',top_co='".$_POST['top']."',bottom_co='".$_POST['bottom']."',start='$start',end='$end',str_start='".strtotime($start)."',str_end='".strtotime($end)."',date='$date' where course_code='".$_POST['course_code']."'");
	
	if($qry){	
		echo '<script>
		alert("Attendance Scheduled!") 
		location.href="attendance.php"
		</script>';
	}else{
		echo '<div class="alert alert-dismissible alert-danger">
				<strong>Oh Sorry!</strong> Unable to complete operation, please try again later.
              </div>';
	}
}

if(isset($_POST['see_attendance'])){
	$bat=mysqli_query($con,"select * from course where course_code='".$_POST['see_attendance']."'");
	if(mysqli_num_rows($bat)>0){
	$_SESSION['see_attendance']=$_POST['see_attendance'];
	echo '<script> 
		location.href="attendance_record.php"
		</script>';
	
	}else{
		echo '<div class="alert alert-dismissible alert-danger">
				<strong>Oh Sorry!</strong> Unknown request, please refresh page and try again.
              </div>';
	}
}



?>