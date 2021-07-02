<!DOCTYPE html>
<html>
    <head>
  <body>
      
	<form method="post" action="forview.php">
	<h1>Student Registration </h1>
	
		Surname:<br>
		<input type="text" name="surname">
		<br>
		Othernames:<br>
		<input type="text" name="othernames">
		<br>
		Matric No:<br>
		<input type="varchar" name="matric_no">
		<br>
        Department:<br>
		<input type="text" name="department">
		<br>
        Level:<br>
		<input type="text" name="level">
		<br><br>
		<input type="submit" name="save" value="submit"> </centre>
		<style>
		h2{
 font-family: Sans-serif; 
 font-size: 24px;     
 font-style: normal; 
 font-weight: bold; 
 color: blue;
 background color: #f1f11f;
 text-align: center; 
 text-decoration: underline
}

input[type=text], input[type=email], input[type=number]{
 width: 50%;
 padding: 6px 12px;
 margin: 5px 0;
 box-sizing: border-box;
}
input[type=submit], input[type=reset]{
 width: 15%;
 padding: 8px 12px;
 margin: 5px 0;
 box-sizing: border-box;
}
</style>
	</form>
  </body>
</html>