<?php
	$servername = "localhost";
	$Dusername = "root";
	$Dpassword = "root";
	$dbname = "footsal";
	$action=$_POST['action'];
	if($action=='getCourts')
	{
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql='SELECT courts.username, courts.Name, courts.state, courts.Address, subcourts.ID, subcourts.pprice, subcourts.npprice,subcourts.sprice, subcourts.type FROM subcourts INNER JOIN courts ON subcourts.cid=courts.ID';
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	if($action=='ctbooking')
	{
		$username=$_POST['username'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql='SELECT subcourts.ID,subcourts.cid, booking.date, booking.time, booking.price, booking.pm, booking.userId, courts.Name, courts.image, courts.cno FROM booking INNER JOIN subcourts ON subcourts.ID=booking.cid INNER JOIN courts ON  subcourts.cid=courts.ID';
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	if($action=='adgetbook')
	{
		
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql='SELECT booking.cid, booking.date, booking.time, booking.price, booking.pm, courts.Name, courts.ID,courts.username FROM booking INNER JOIN subcourts ON subcourts.ID=booking.cid INNER JOIN courts ON  subcourts.cid=courts.ID';
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	if($action=='getdet')
	{
		$id=$_POST['id'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql='SELECT courts.Name, courts.state, courts.Address,courts.cno, courts.username ,subcourts.cId, subcourts.ID, subcourts.open, subcourts.close, subcourts.pprice, subcourts.npprice,subcourts.sprice, subcourts.type FROM subcourts INNER JOIN courts ON subcourts.cid=courts.ID ';
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	if($action=='getDetails')
	{
		$cid=$_POST['cid'];
		$date=$_POST['date'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql="SELECT time FROM booking WHERE cid=$cid AND date='$date'";
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	if($action=='book')
	{
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$cid=$_POST['cid'];
		$date=$_POST['date'];
		$sid=$_POST['sid'];
		$time=$_POST['time'];
		$price=$_POST['price'];
		$pm=$_POST['pm'];
		$sql="INSERT INTO booking (userId,cid,date,time,price,pm) VALUES ('$sid',$cid,'$date',$time,$price,'$pm')";
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		if($pm!='Points')
		{
			$sql="INSERT INTO points (date,username) VALUES ('$date','$sid')";
			$conn->query($sql);
		}
		$conn->close();
	}
	if($action=='getpoints')
	{
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql="SELECT * FROM points";
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
?>