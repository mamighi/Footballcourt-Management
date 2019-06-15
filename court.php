<?php
	$servername = "localhost";
	$Dusername = "root";
	$Dpassword = "root";
	$dbname = "footsal";
	$action=$_POST['action'];
	if($action=='add')
	{
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$Name=$_POST['name'];
		$Address=$_POST['add'];
		$cno=$_POST['cno'];
		$username=$_POST['username'];
		$stat=$_POST['state'];
		$img=$_POST['img'];
		$sql = "INSERT INTO courts (Name, Address, cno,image,username,state)
				VALUES ('$Name', '$Address', '$cno','$img','$username','$stat')";
				if ($conn->query($sql) === TRUE) {
				echo json_encode("success");
			} else {
				echo("Error description: " . mysqli_error($conn));
				echo json_encode("failed");
			}
			$conn->close();
	}
	if($action=='get')
	{
		$username=$_POST['username'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM courts WHERE username='$username'";
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	if($action=='update')
	{
		$id=$_POST['id'];
		$add=$_POST['add'];
		$cno=$_POST['cno'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "UPDATE courts SET Address='$add', cno='$cno' WHERE ID='$id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}
	if($action=='addcourt')
	{
		$cid=$_POST['cid'];
		$open=$_POST['open'];
		$close=$_POST['close'];
		$pprice=$_POST['pprice'];
		$nprice=$_POST['nprice'];
		$sprice=$_POST['sprice'];
		$type=$_POST['type'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "INSERT INTO subcourts (cId, open, close,pprice,npprice,sprice,type)
				VALUES ($cid, $open, $close,$pprice,$nprice,$sprice,'$type')";
				if ($conn->query($sql) === TRUE) {
				echo json_encode("success");
			} else {
				echo("Error description: " . mysqli_error($conn));
				echo json_encode("failed");
			}
			$conn->close();
	}
	if($action=='getcourts')
	{
		$cid=$_POST['cid'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM subcourts WHERE cId='$cid'";
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	if($action=='deleteCourt')
	{
		$id=$_POST['id'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "DELETE FROM subcourts WHERE ID=$id";

		if ($conn->query($sql) === TRUE) {
			echo "Record deleted successfully";
		} else {
			echo "Error deleting record: " . $conn->error;
		}

		$conn->close();
	}
	if($action=='getallcourts')
	{
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
	// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM courts";
		$result = $conn->query($sql);
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($outp);
		$conn->close();
	}
	if($action=='updateCourt')
	{
		$id=$_POST['id'];
		$open=$_POST['open'];
		$close=$_POST['close'];
		$pprice=$_POST['pprice'];
		$nprice=$_POST['nprice'];
		$sprice=$_POST['sprice'];
		$type=$_POST['type'];
		$conn = new mysqli($servername, $Dusername, $Dpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			echo json_encode("Connection failed: " . $conn->connect_error);
		}
		$sql = "UPDATE subcourts SET open='$open', close='$close',pprice='$pprice', npprice='$nprice',sprice='$sprice', type='$type' WHERE ID='$id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
		
	}
?>