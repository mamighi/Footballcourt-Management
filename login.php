<?php
	$servername = "localhost";
	$Dusername = "root";
	$Dpassword = "root";
	$dbname = "footsal";
	$action=$_POST['action'];
	if($action=='login')
	{
		$userName=$_POST['username'];
		$password=$_POST['pass'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT ut,st FROM users WHERE userName='$userName' AND password='$password'";
	
		$result = $conn->query($sql);
		if ($result){
			$value = $result->fetch_assoc()	;
			if($value["ut"]=="bo")
			{
				echo json_encode($value["st"]);	
			}
			else
			{
				echo json_encode($value["ut"]);	
			}
		}
		else
		{
			echo json_encode("wrong");
		}
		$conn->close();
	}
	else if($action=='signup')
	{
		if($_POST['ut']=='bo')
		{
			$userName=$userName=$_POST['username'];
			$pass=$_POST['pass'];
			$name=$_POST['name'];
			$state=$_POST['state'];
			$fcname=$_POST['fcname'];
			$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
			if ($conn->connect_error) {
				echo json_encode("Connection failed: " . $conn->connect_error);
			}
			$sql = "INSERT INTO users (userName, password, email,fcName,state,ut,st,fname)
				VALUES ('$userName', '$pass', '$userName','$fcname','$state','bo','pending','$name')";
				if ($conn->query($sql) === TRUE) {
				echo json_encode("success");
			} else {
				echo json_encode("failed");
			}
			$conn->close();
		}
		else if($_POST['ut']=='fu')
		{
			$userName=$userName=$_POST['username'];
			$pass=$_POST['pass'];
			$name=$_POST['name'];
			$con=$_POST['con'];
			$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
			if ($conn->connect_error) {
				echo json_encode("Connection failed: " . $conn->connect_error);
			}
			$sql = "INSERT INTO users (userName, password, email,contactNo,ut,fname)
				VALUES ('$userName', '$pass', '$userName','$con','fu','$name')";
			if ($conn->query($sql) === TRUE) {
				echo json_encode("success");
			} else {
				echo json_encode("failed");
			}
			$conn->close();
		}
		else
		{
			$userName=$_POST['username'];
			$pass=$_POST['pass'];
			$name=$_POST['name'];
			$con=$_POST['con'];
			$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
			if ($conn->connect_error) {
				echo json_encode("Connection failed: " . $conn->connect_error);
			}
			$sql = "INSERT INTO users (userName, password, email,contactNo,ut,fname)
				VALUES ('$userName', '$pass', '$userName','$con','admin','$name')";
			if ($conn->query($sql) === TRUE) {
				echo json_encode("success");
			} else {
				echo json_encode("failed");
			}
			$conn->close();
		}
	}
	else if($action=='getpendingAccount')
	{
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM users WHERE ut='bo' AND st='pending'";
	
		$result = $conn->query($sql);
		if ($result){
			  while($row = $result->fetch_assoc())
			  {
				  
					echo "<tr><td><input type='radio' id='".$row["userName"]."' name='priority'/></td><td>".$row["userName"]."</td><td>".$row["fcName"]."</td><td> ".$row["state"]."</td></tr>";
			  }
		}
		else
		{
			echo json_encode("wrong");
		}
		$conn->close();
	}
	else if($action=='getUsers')
	{
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM users WHERE ut='bo' OR ut='fu'";
	
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	else if($action=='getadmin')
	{
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM users WHERE ut='admin'";
	
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	else if($action=='Accept')
	{
		$username=$_POST['username'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "UPDATE users SET st='accept' WHERE userName='$username'";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}
	else if($action=='Reject')
	{
		$username=$_POST['username'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "UPDATE users SET st='reject' WHERE userName='$username'";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}
	else if($action=='update')
	{
		$ut=$_POST['ut'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$fname=$_POST['fname'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		if($ut=='bo')
		{
			$state=$_POST['state'];
			$fcName=$_POST['fcName'];
			$sql = "UPDATE users SET password='$password', state='$state', fcName='$fcName',fname='$fname' WHERE userName='$username'";
			if ($conn->query($sql) === TRUE) {
				echo "Record updated successfully";
			} 
			else {
				echo "Error updating record: " . $conn->error;
			}
			$conn->close();
		}
		else
		{
			$cno=$_POST['cno'];
			$sql = "UPDATE users SET password='$password', contactNo='$cno', fname='$fname' WHERE userName='$username'";
			if ($conn->query($sql) === TRUE) {
				echo "Record updated successfully";
			} 
			else {
				echo "Error updating record: " . $conn->error;
			}
			$conn->close();
		}
	}


?>