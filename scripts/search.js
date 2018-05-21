function getInfo(observation) {
	return `<p class="observation"><strong>${observation.spotter}</strong> saw <strong>${observation.amount}</strong> Heffalump(s) in <strong>${observation.place}</strong> on <strong>${observation.date}</strong>.</p>`;
}

function search(event) {
	const query = event.value;

	const requestUrl = window.location.href + `?q=${query}`; 

	fetch(requestUrl, {
		headers: new Headers({
			'Content-Type': 'application/json'
		})
	}).then(data => data.json())
	.then(data => {
		console.log(data);
		console.log(renderInfo(data[0]));
	});
}