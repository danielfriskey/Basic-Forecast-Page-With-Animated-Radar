<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Joplin, MO Weather Forecast & Animated Radar</title>
		<link rel="stylesheet" href="css/style.css">
		<!-- Leaflet CSS (v1.5.1) -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.5.1/dist/leaflet.css" />
		<!-- Leaflet.TimeDimension CSS (v1.1.1) -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-timedimension@1.1.1/dist/leaflet.timedimension.control.min.css" />
	</head>
	<body>
		<header>
			<h1>Joplin, MO Weather Forecast & Animated Radar</h1>
		</header>
		<div class="container">
			<!-- Current Conditions Section -->
			<section id="current-conditions" class="section">
				<h2>Current Conditions</h2>
				<div class="current-weather">
					<img id="current-icon" src="" alt="Weather Icon">
					<div>
						<p id="current-desc">Loading...</p>
						<p id="current-temp"></p>
					</div>
				</div>
			</section>
			<!-- 10-Day Forecast Section -->
			<section id="forecast" class="section">
				<h2>10-Day Forecast</h2>
				<div id="forecast-container">
					<!-- Forecast cards injected by js/main.js -->
				</div>
			</section>
			<!-- Animated Live Radar Map Section -->
			<section id="radar" class="section">
				<h2>Live Animated Radar Map</h2>
				<div id="radar-map"></div>
			</section>
		</div>
		<!-- Load JavaScript files in proper order -->
		<!-- 1. Leaflet JS (v1.5.1) -->
		<script src="https://cdn.jsdelivr.net/npm/leaflet@1.5.1/dist/leaflet.js"></script>
		<!-- 2. iso8601-js-period (v0.2.1) -->
		<script src="https://cdn.jsdelivr.net/npm/iso8601-js-period@0.2.1/iso8601.min.js"></script>
		<!-- 3. Leaflet.TimeDimension JS (v1.1.1) -->
		<script src="https://cdn.jsdelivr.net/npm/leaflet-timedimension@1.1.1/dist/leaflet.timedimension.min.js"></script>
		<!-- 4. Your forecast JS -->
		<script src="js/main.js"></script>
		<!-- 5. Local radar JS -->
		<script src="js/radar.js"></script>
		<footer>
			<p>Based off the <a target="_blank" href="https://radar.weather.gov/?settings=v1_eyJhZ2VuZGEiOnsiaWQiOiJsb2NhbCIsImNlbnRlciI6Wy04Ni44MzMsMzYuODYyXSwibG9jYXRpb24iOm51bGwsInpvb20iOjYuNzkwNzIxNjcxMDc5NTQ5LCJmaWx0ZXIiOiJXU1ItODhEIiwibGF5ZXIiOiJzcl9icmVmIiwic3RhdGlvbiI6IktMVlgifSwiYW5pbWF0aW5nIjpmYWxzZSwiYmFzZSI6InN0YW5kYXJkIiwiYXJ0Y2MiOmZhbHNlLCJjb3VudHkiOmZhbHNlLCJjd2EiOmZhbHNlLCJyZmMiOmZhbHNlLCJzdGF0ZSI6ZmFsc2UsIm1lbnUiOnRydWUsInNob3J0RnVzZWRPbmx5Ijp0cnVlLCJvcGFjaXR5Ijp7ImFsZXJ0cyI6MC44LCJsb2NhbCI6MC42LCJsb2NhbFN0YXRpb25zIjowLjgsIm5hdGlvbmFsIjowLjZ9fQ%3D%3D">NWS Radar</a>
			</p>
			<p>Using <a target="_blank" href="https://www.jsdelivr.com/package/npm/leaflet-timedimension">Leaflet TimeDimension</a> for radar animations. </p>
		</footer>
	</body>
</html>