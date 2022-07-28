{% extends views/layouts/Default.php %}

{% block content %}
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
	<a class="btn btn-success btn-lg j_create_record" 
	data-createurl="{{ route('/contacts-form/create') }}" 
	data-responseurl="{{ route('/contacts-form/save') }}" 
	data-waitmessage="Please wait" 
	href="#" id="">Add New Message</a>
</div>
<div class="table-responsive table-responsive-lg px-2 py-2">
	<table id="contactsForm" class="table table-striped table-condensed table-sm" style="width: 100%;">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Message</th>
				<th>Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<script>
$(document).ready(function()
{
	$('#contactsForm').DataTable({
		'language': {
			"sSearch": '<i class="icon-search"></i>',
		},
		"lengthMenu": [
			[10, 25, 50, 100],
			[10, 25, 50, 100]
		],
		"processing"	: true,
		"serverSide"	: true,
		"sSearchPlaceholder": "Search...",
		"ajax": 
		{
			type: "POST",
			url: "{{ route('contacts-form/datatable') }}",
		},
		"deferRender": true,
		"dom": "<'row mb-1'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
	});
});
</script>
<script src="{{ asset('scripts/db.handler.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!--Datatables js/css-->
<link rel="stylesheet" href="{{ asset('vendors/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/datatables-buttons/css/buttons.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<script src="{{ asset('vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/datatables-buttons/js/dataTables.buttons.js') }}"></script>
<script src="{{ asset('vendors/datatables-buttons/js/buttons.bootstrap4.js') }}"></script>
<script src="{{ asset('vendors/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/datatables-buttons/js/buttons.print.js') }}"></script>
<script src="{{ asset('vendors/datatables-buttons/js/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/datatables-buttons/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/datatables-buttons/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendors/datatables-buttons/js/buttons.html5.js') }}"></script>
<script src="{{ asset('vendors/datatables-buttons/js/dataTables.colReorder.min.js') }}"></script>
<script src="{{ asset('vendors/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
{% endblock %}