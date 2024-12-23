<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>LSCM-HC Grad '23</title>
	<link rel="stylesheet" type="text/css" href="styleM.css?v=41" />
	<link rel="icon" href="favicon.png">
	<meta http-equiv=Content-Type content=text/html; charset=utf-8 />
</head>

<body>
	<div id="wrapper">
		<div id="pictures">
			<table id="bgtable">
				<tbody>
					<?php
					include('random_mobile.php');
					?>
				</tbody>
			</table>
		</div>
		<div id="maintable">
			<table class="center">
				<tr id="upload-section">
					<td>
						<h1>HC Grad<br>2023</h1>
						<p id="info">Upload your graduation photos here</p>
						<table>
							<form class="form" id="uploadForm">
								<tr id="select-tr">
									<td>
										<br>
										<label class="custom-file-upload">
											<input type="file" accept="image/*" id="inpFile" multiple>
											<a id="select-photos">Browse</a>
										</label>
										<div class="filler"></div>
									</td>
								</tr>
								<tr id="submit-tr">
									<td>
										<button id="submit-button" type="submit">Upload Photos</button>
									</td>
								</tr>
							</form>
							<br>
							<br>
							<tr id="download-section">
								<td>
									<br>
									<br>
									<br>
									<br>
									<br>
								    <a id="download-page" href="photoviewer.php">Download Photos</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr id="scroll-tr">
					<td>
						<div id="scrollbody"></div>
						<div id="scrollthumb"></div>
					</td>
				</tr>
			</table>

		</div>
	</div>
	<script src="lazysizes.min.js" async=""></script>
	<script src="scriptM.js?v=6"></script>
</body>

</html>