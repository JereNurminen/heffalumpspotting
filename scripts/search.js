function renderInfo(observation) {
	const text = `<strong>${observation.spotter}</strong> saw <strong>${observation.amount}</strong> Heffalump(s) in <strong>${observation.place}</strong> on <strong>${observation.spot_time}</strong>.`;
	const span = document.createElement('span');
	span.innerHTML = text;
	return span;
}

function search(event) {
	const result_box = document.querySelector('#search-results');	
	const query = event.value;

	if (query.trim() === '') {
		result_box.innerHTML = '';
		return;		
	}

	const requestUrl = window.location.href + `?q=${query}`;

	fetch(requestUrl, {
		headers: new Headers({
			'Content-Type': 'application/json'
		})
	}).then(data => data.json()
	) .then(data => {
		if (data.length) {
			result_box.innerHTML = '';
			const results = data.map(renderInfo);
			results.forEach(element => {
				result_box.appendChild(element);
			})
		} else {
			result_box.innerHTML = '<span>No spottings found with search terms!</span>';
		}
	})
};
