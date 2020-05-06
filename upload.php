<!DOCTYPE html>
<html>
<head>
	<title>Success!</title>
</head>
<body>
	<a href="index.php">HOME</a>
	<br>
</body>
</html>
<?php
	if(isset($_POST['save_audio']) && $_POST['save_audio'] == "Upload Audio") {
		$name = $_FILES['audioFile']['name'];
		$file = $_FILES['audioFile']['size'];
		$type = $_FILES['audioFile']['type'];

		$tmp_name = $_FILES['audioFile']['tmp_name'];

		$dir = 'uploads/';
		$path_name = $dir.basename($name);

		if (move_uploaded_file($tmp_name, $path_name)){
			echo "Upload to folder Successful!";

			saveAudio($path_name, $file);
		}
	else{
		echo "Please select an audio file";
	}
	}
	
	
	function saveAudio($fileName, $fileSize){
		$conn = mysqli_connect('localhost', 'root', 'Freefix', 'audiolibdb');
		if(!$conn){
			die('server not connected');
		}		

		$query = "insert into audios(filename, filesize)values('{$fileName}', $fileSize)";

		mysqli_query($conn,$query);

		if(mysqli_affected_rows($conn) > 0){
			echo " Audio file path saved in database";
		}

		mysqli_close($conn);
	}

?>