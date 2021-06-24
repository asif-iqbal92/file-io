<!DOCTYPE html>
<html>
<head>
	<title>REGISTRATION FORM</title>
</head>
<body>

	<h1>REGISTRATION FORM</h1>

 <?php

//initialize the variables
 $firstName = $lastName = $gender = $birthday = $religion = $presentAddress = $permanentAddress = $phone = $email = $url = $userName = $password = "";
$firstNameErr = $lastNameErr = $emailerr = $userNameerr = $passworderr = "";
$flag = false;
$successfulMessage = "";
$errorMessage = "";

//assigning values given in the form
 if($_SERVER['REQUEST_METHOD'] === "POST") {
$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
$religion = $_POST['religion'];
$presentAddress = $_POST['presentAddress'];
$permanentAddress = $_POST['permanentAddress'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$url = $_POST['url'];
$userName = $_POST['userName'];
$password = $_POST['password'];

//error massage for empty essential data
 if(empty($firstName)) {
$firstNameErr = "First name can not be empty!";
$flag = true;
}
if(empty($lastName)) {
$lastNameErr = "Last name can not be empty!";
$flag = true;
}
if(empty($email)) {
$emailerr = "Email Addresss can not be empty!";
$flag = true;
}
if(empty($userName)) {
$userNameerr = "User Name can not be empty!";
$flag = true;
}
if(empty($password)) {
$passworderr = "Password can not be empty!";
$flag = true;
}

//creating json array
if(!$flag) {
$existing_data = read();
if(empty($existing_data)) {
$arr1[] = array("first name" => $firstName, "last name" => $lastName, "gender" => $gender, "date of birth" => $birthday, "religion" => $religion, "present address" => $presentAddress, "permanent address" => $permanentAddress, "phone" => $phone, "email" => $email, "url" => $url, "User Name" => $userName, "password" => $password);
$result = write(json_encode($arr1));
}

//updating existing json array
else {
$existing_data_decode[] = json_decode($existing_data);
array_push($existing_data_decode, array("first name" => $firstName, "last name" => $lastName, "gender" => $gender, "date of birth" => $birthday, "religion" => $religion, "present address" => $presentAddress, "permanent address" => $permanentAddress, "phone" => $phone, "email" => $email, "url" => $url, "User Name" => $userName, "password" => $password));

//creating text document
write("");
$result = write(json_encode($existing_data_decode));
}
if($result) {
$successfulMessage = "Successfully Saved!";
}
else {
$errorMessage = "Error while saving!";
}
}
}

 function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
}

 function write($content) {
$fileName = "data.txt";
$resource = fopen($fileName, "w");
$fw = fwrite($resource, $content);
fclose($resource);
return $fw;
}

 ?>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
		<fieldset>
			<legend><b>Basic Information</b></legend>

			<label for="fname">First Name:<span style="color: red;">*</span></label>
			<input type="text" id="fname" name="fname">
			<span style="color: red;"><?php echo $firstNameErr; ?></span>
			<br><br>

			<label for="lname">Last Name:<span style="color: red;">*</span></label>
			<input type="text" id="lname" name="lname">
			<span style="color: red;"><?php echo $lastNameErr; ?></span>

			<br><br>
			<label for="gender">Gender:</label><br>

			<input type="radio" id="male" name="gender">
			<label for="male">Male</label>
			<br>
			<input type="radio" id="female" name="gender">
			<label for="female">Female</label>

			<br><br>

			<label for="birthday">Date of Birth</label>
			<input type="date" id="birthday" name="birthday">

			<br><br>

			<label for="religion">Religion</label>
			<select name="religion" id="religion">
  			<option value="muslim">Muslim</option>
    		<option value="hindu">Hindu</option>
    		<option value="buddhist">Buddhist</option>
    		<option value="christian">Christian</option>
    		<option value="other">Other</option>
</select>


		</fieldset>

			<br><br>

		<fieldset>
			<legend><b>Contact Information</b></legend>

			<label for="presentAddress">Present Address</label>
			<textarea id="presentAddress" name="presentAddress" rows="4" cols="50"></textarea>

			<br><br>

			<label for="permanentAddress">Permanent Address</label>
			<textarea id="permanentAddress" name="permanentAddress" rows="4" cols="50"></textarea>

			<br><br>

			<label for="phone">Phone Number</label>
			<input type="tel"  id="phone" name="phone">

			<br><br>

			<label for="email">Email<span style="color: red;">*</span></label>
			<input type="email"  id="email" name="email">

			<br><br>

			<label for="url">Personal Website Link</label>
			<input type="url"  id="url" name="url">


		</fieldset>

			<br><br>

		<fieldset>
			<legend><b>Account Information</b></legend>

			<label for="userName">Username:<span style="color: red;">*</span></label>
			<input type="text" id="userName" name="userName">
			<br><br>

			<label for="password">Password:<span style="color: red;">*</span></label>
			<input type="text" id="password" name="password">
			<br><br>
		</fieldset>

			<br><br>

			<input type="submit" name="submit" value="Submit">

	</form>

 <br>

 <?php
$readData = read();
$arr1 = explode("\n", $readData);

 echo "<ol>";
for($i = 0; $i < count($arr1) - 1; $i++) {
$decode = json_decode($arr1[$i]);
echo "<li>" . $decode->firstname . " - " . $decode->lastname . "</li>";
}
echo "</ol>";

 function read() {
$fileName = "data.txt";
$fileSize = filesize($fileName);
$fr = "";
if($fileSize > 0) {
$resource = fopen($fileName, "r");
$fr = fread($resource, $fileSize);
fclose($resource);
return $fr;
}
}
?>
</body>
</html>