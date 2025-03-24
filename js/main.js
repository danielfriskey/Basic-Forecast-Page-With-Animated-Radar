// js/main.js (unchanged)

document.addEventListener('DOMContentLoaded', () => {
	fetch('api/forecast.php')
		.then(response => response.json())
		.then(data => {
			if (data.error) {
				console.error(data.error);
				return;
			}

			// Display current conditions using the first hourly forecast period.
			const hourlyPeriods = data.hourly.properties?.periods || [];
			if (hourlyPeriods.length > 0) {
				const current = hourlyPeriods[0];
				document.getElementById('current-temp').textContent =
					current.temperature + ' ' + current.temperatureUnit;
				document.getElementById('current-desc').textContent = current.shortForecast;
				document.getElementById('current-icon').src = current.icon;
			} else {
				document.getElementById('current-desc').textContent = 'No current data available.';
			}

			// Display 10-day forecast.
			const forecastContainer = document.getElementById('forecast-container');
			const forecastPeriods = data.forecast.properties?.periods || [];
			let count = 0;
			forecastPeriods.forEach(period => {
				if (count >= 10) return;
				const card = document.createElement('div');
				card.className = 'forecast-card';
				card.innerHTML = `
          <h3>${period.name}</h3>
          <img src="${period.icon}" alt="${period.shortForecast}">
          <p>${period.shortForecast}</p>
          <p>${period.temperature}&deg; ${period.temperatureUnit}</p>
        `;
				forecastContainer.appendChild(card);
				count++;
			});
		})
		.catch(error => {
			console.error('Error fetching forecast:', error);
		});
});