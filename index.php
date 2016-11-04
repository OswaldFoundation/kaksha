<!doctype html>
<html>

	<head>

		<title>Kaksha</title>
		<link href="https://cdn.oswald.foundation/34c62-bootstrap.css" rel="stylesheet">

	</head>

	<body>

		<div class="container-fluid">

			<div class="col-md-3">
				<h3>Study Material</h3>
				<ul>
					<?php
						$type = "echo";
						$root_dir = "content/";
						if (isset($_GET["content"])) {
							$dir = $root_dir . $_GET["content"] . "/";
							$curr = $_GET["content"] . "/";
						} else {
							$dir = $root_dir;
							$curr = "";
						}
						if (is_dir($dir)) {
							$dh = opendir($dir);
							while (($file = readdir($dh)) !== false) {
								if ($file != "." && $file != "..") {
									echo "<li><a href='?content=$curr$file'>" . str_replace("-", " ", ucfirst(pathinfo($file, PATHINFO_FILENAME))) . "</a></li>";
								}
							}
							closedir($dh);
						} else {
							$dh = opendir(dirname(($dir)));
							while (($file = readdir($dh)) !== false) {
								if ($file != "." && $file != "..") {
									echo "<li><a href='?content=$curr$file'>" . str_replace("-", " ", ucfirst(pathinfo($file, PATHINFO_FILENAME))) . "</a></li>";
								}
							}
							closedir($dh);
							$file = 1;
							$ext = pathinfo($dir, PATHINFO_EXTENSION);
							if ($ext == "pdf") {
								$type = "iframe";
							}
							$url = "content/" . $_GET["content"];
						}
					?>

				</ul>
			</div>

			<div class="col-md-9">
				<?php
					if ($file == 1) {
						if ($type == "iframe") {
							//echo "<iframe src='$url'></iframe>";
							echo '<object style="width:100%;height:100vh;box-sizing:border-box;margin-bottom:-10px" type="application/pdf" data="'.$url.'?#zoom=100&scrollbar=1&toolbar=0&navpanes=0">
	<p>Insert your error message here, if the PDF cannot be displayed.</p>
</object>';
						}
					}
				?>
			</div>

		</div>

	</body>

</html>