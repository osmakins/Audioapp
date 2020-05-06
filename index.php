<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
  <title>Audio mp3</title>
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Audio app</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Favorites
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Artists
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Albums
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Genre
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Usage reports</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          </ul>
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
      <h1>Upload and play music</h1>
      <div style="padding-left: 50px">
	<form class="form-inline" action="upload.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<input type="file" name="audioFile" />
		</div>
		<div class="form-group">
			<input type="submit" value="Upload Audio" name="save_audio">
		</div>
	</form>
	</div>
	<br>
	<div class="col-md-10">
	<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="20">Track(s)</th>
			<th>file Name</th>
			<th>File Size (MB)</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$conn = mysqli_connect('localhost', 'root', 'Freefix', 'audiolibdb');
		if(!$conn){
			die('server not connected');
		}

		$query="select * from audios";

		$r=mysqli_query($conn,$query);

		$sum = 0;
		$tracks = 0;

    while($row=mysqli_fetch_array($r))
		{
		?>	
		<tr>
			<td><?php echo $row['id']; ++$tracks; ?></td>
			<td><?php echo '<a href="play.php?name='.$row['filename'].'">'.$row['filename'].'</a>'?></td>
			<td>
				<?php 
					$mb_size = round($row['filesize']/pow(1024, 2),2); 
					echo $mb_size."MB"; 
					$sum += $row['filesize'];
					$mb_sum = round($sum/pow(1024, 2),2)
				?>
			</td>
		</tr>
		<?php
    }
		mysqli_close($conn);
		
		$available = 70 - $tracks;
    $check_mb = isset($mb_sum) ? $mb_sum : "0";
    echo $check_mb. "MB"." Used of 8000MB. " . " Approximately space for " . $available . " tracks available.";
    
		
		?>				
		</tbody>
	</table>
	</div>
</main>
</body>
</html>