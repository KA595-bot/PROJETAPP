$(function () {
	$('table').DataTable();
	responsive: true

	$('#insert').on('click', function(e) {
		let formCreate = $('#fromCreate')
		if(formCreate[0].checkValidity()){
			e.preventDefault();
			$.ajax
		}
	})
});

