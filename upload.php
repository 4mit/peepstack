
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="well">
		<form class="form-inline" action="uploadFile.php" method="POST" enctype="multipart/form-data">
		  <div class="form-group">
			<input type="file"  name="file" class="form-control">
		  </div>
		  <input type= "submit" class="btn btn-info" value ="Upload"/>
		</form>      
	</div>
	<div class="well">
		<a href="upload.php?view=data">Click here see all data</a>
		<?php
		if(isset($_GET['view']) && $_GET['view']=='data'){
			$conn = mysqli_connect("localhost", "root", "", "excelupload");
			$result = $conn->query('SELECT * FROM `data`');
			echo '<table class="table"><tr><th>Name</th><th>E-Mail</th></tr>';
			while($r = mysqli_fetch_assoc($result)){
				echo "<tr><td>".$r['name']."</td><td>".$r['email']."</td></tr>";
			}
			echo '</table>';
		}
		?>
	</div>
</body>
</html>
