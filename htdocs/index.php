<?php
	// Set timezone and get current time
	date_default_timezone_set('Europe/Berlin');
	$currentTime = array(
		'hours' => date(g),
		'minutes' => date(i),
		'seconds' => date(s)
	);

	// set degrees for timevalues to position handles
	$degreeHours = 360/12;
	$degreeMinutes = 360/60;
	$degreeSeconds = 360/60;

	// set handles to display current time
	$handHours = $degreeHours * $currentTime[hours] + $currentTime[minutes]/2;			// 1 hour = 30degrees / hour-hand advances 0.5 degress with every passing minute
	$handMinutes = $degreeMinutes * $currentTime[minutes] + $currentTime[seconds]/10;	// 1 min = 6degrees / minute-hand advances 0.1 degress with every passing second
	$handSeconds = $degreeSeconds * $currentTime[seconds];
?>

<!DOCTYPE html>
<html dir="ltr" lang="de">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Fragments / Clock</title>
	<meta name="description" content="Clock - an analog clock built with PHP/CSS" />
	<meta name="keywords" content="clock, php, css" />
	<?php require_once 'modules/framework/head-meta.php'; ?>

	<style media="screen">
		body { text-align: center; }

		@keyframes rotate {
			100% { transform: rotateZ(360deg); }
		}

		.hand {
			position: absolute;
			transform-origin: 0 0;
			top: 50%;
			left: 50%;
			height: 50%;	/* scale hand-svg */
		}
		.hand img {
			display: block;	/* remove whitespace */
			height: 100%;	/* scale hand-svg */
			width: auto;	/* scale hand-svg */
		}
		.hand-container {
			height: 100%;
			width: 100%;
			position: absolute;
		}

		.hand-container.seconds { animation: rotate 60s		infinite steps(60); }
		.hand-container.minutes { animation: rotate 3600s 	infinite linear; }
		.hand-container.hours   { animation: rotate 43200s	infinite linear; }

		#hand-hours { <?php echo 'transform: rotate('.$handHours.'deg) translate(-50%,-100%)'; ?> }
		#hand-minutes {	<?php echo 'transform: rotate('.$handMinutes.'deg) translate(-50%,-100%)'; ?> }
		#hand-seconds {
			background-color: #000;
			height: 45%;
			min-width: 1px;
			width: .4%;
			<?php echo 'transform: rotate('.$handSeconds.'deg) translate(-50%,-100%)'; ?>
		}

		#clockface {
			background-color: #f7f4f4;
			background-image: url("assets/images/clockface.svg");
			border-radius: 99em;
			margin: auto;
			position: relative;
			height: 400px;
			width: 400px;
		}
	</style>
</head>

<body id="index">
	<div class="wrapper">
		<?php require_once 'modules/framework/header.php'; ?>

		<div class="inner">

			<main role="content">
				<h1>Clock</h1>


				<div id="clock-analog">
					<div id="clockface">
						<div class="hand-container hours">
							<div class="hand" id="hand-hours"><img src="assets/images/hand-hours.svg" alt="hand hours" width="40" height="150"/></div>
						</div>
						<div class="hand-container minutes">
							<div class="hand" id="hand-minutes"><img src="assets/images/hand-minutes.svg" alt="hand hours" width="40" height="150"/></div>
						</div>
						<div class="hand-container seconds">
							<div class="hand" id="hand-seconds"></div>
						</div>
					</div>
				</div>

				<div id="clock-digital">
					<h2>current time</h2>
					<?php
						echo $currentTime[hours].':'.$currentTime[minutes].':'.$currentTime[seconds];
					?>
				</div>
			</main>
		</div>

		<?php require_once 'modules/framework/footer.php'; ?>
	</div><!-- /.wrapper -->

	<?php require_once 'modules/framework/javascript.php'; ?>
</body>
</html>
