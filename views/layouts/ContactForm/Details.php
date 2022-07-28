{% extends views/layouts/Default.php %}

{% block content %}
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
	<a class="btn btn-success btn-lg java_last_exception_clear" href="{{ route('/contacts-form/save/'.$response['id']) }}" id=""><i class="fa fa-pencil"></i> Edit Message</a>
</div>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('/') }}">Messages</a></li>
		<li class="breadcrumb-item active" aria-current="page">Details</li>
	</ol>
</nav>
<div class="">
	<i class="fa fa-history"></i> <em>Last updated at {{ date("d/m/Y H:i:s", strtotime($response["updated_at"])); }}</em>
	
</div>
<div class="card">
	<div class="card-body">
		<div class="table-responsive table-responsive-lg px-2 py-2">		
			<table id="" class="table table-striped table-condensed table-sm" style="width: 100%;">
				<tbody>
					{% if(!empty($response["name"])): %}
						<tr>
							<td><strong><i class="fa fa-sitemap"></i> Nome</strong></td>
							<td class="text-muted">{{ $response["name"]; }}</td>
						</tr>
					{% endif; %}
					
					{% if(!empty($response["email"])): %}
						<tr>
							<td><strong><i class="fa fa-envelope"></i> email</strong></td>
							<td class="text-muted">{{ $response["email"]; }}</td>
						</tr>
					{% endif; %}
					
					{% if(!empty($response["message"])): %}
						<tr>
							<td><strong><i class="fa fa-comment"></i> Message</strong></td>
							<td class="text-muted">{{ $response["message"]; }}</td>
						</tr>
					{% endif; %}
					
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="{{ asset('scripts/stock.handler.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
{% endblock %}