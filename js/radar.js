// js/radar.js

window.addEventListener('load', function() {
	if (!L.timeDimension) {
		console.error("L.timeDimension is not defined. Check that the plugin is loading correctly.");
		return;
	}

	// Initialize the Leaflet map with TimeDimension support.
	var radarMap = L.map('radar-map', {
		center: [37.0842, -94.5133],
		zoom: 8,
		timeDimension: true,
		timeDimensionControl: true,
		timeDimensionControlOptions: {
			autoPlay: true,
			loopButton: true,
			timeSliderDragUpdate: true,
			playReverseButton: true,
			position: 'bottomleft'
		},
		timeDimensionOptions: {
			// Set time interval: one hour ago until now.
			timeInterval: (function() {
				var end = new Date().toISOString();
				var start = new Date(Date.now() - 60 * 60 * 1000).toISOString();
				return start + "/" + end;
			})(),
			period: "PT5M" // 5-minute intervals
		}
	});

	// Add a base layer (OpenStreetMap)
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '© OpenStreetMap contributors'
	}).addTo(radarMap);

	// Create a WMS layer for radar data.
	// Update the URL and parameters as needed for your radar data source.
	var radarWmsLayer = L.tileLayer.wms('https://opengeo.ncep.noaa.gov/geoserver/klvx/klvx_sr_bref/ows?', {
		layers: 'klvx_sr_bref',
		format: 'image/png',
		transparent: true,
		version: '1.1.1',
		tiled: true,
		time: new Date().toISOString() // Initial time; will be updated by the plugin.
	});

	// Wrap the radar WMS layer in a TimeDimension layer.
	var tdRadarLayer = L.timeDimension.layer.wms(radarWmsLayer, {
		updateTimeDimension: true,
		updateTimeDimensionMode: 'replace',
		cache: 48
	});

	// Add the TimeDimension radar layer to the map.
	tdRadarLayer.addTo(radarMap);
});