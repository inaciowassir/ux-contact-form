{% extends views/layouts/Default.php %}

{% block content %}
<nav aria-label="breadcrumb" class="mt-4">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('/') }}">Messages</a></li>
		<li class="breadcrumb-item active" aria-current="page">New</li>
	</ol>
</nav>
<form name="contactForm" class="mb-4">
	<div class="card mb-4">
		<div class="card-body">
			<div class="row g-3">
				<div class="col-sm-4 form-floating">
					<label for="name" class="text-muted pt-1">Name</label>
					<input type="text" class="form-control" id="name" name="name" value="{% if(!empty($response['name'])): %}{{$response['name']}}{% endif; %}" 
					required>
				</div>
				
				<div class="col-sm-4 form-floating">
					<label for="email" class="text-muted pt-1">Email</label>
					<input type="text" class="form-control" id="email" name="email" value="{% if(!empty($response['email'])): %}{{$response['email']}}{% endif; %}" required>
				</div>
				
				<div class="col-12 form-floating">
					<label for="message" class="text-muted pt-1">Message</label>
					<textarea class="form-control" id="message" name="message" style="height:150px;" required>{% if(!empty($response['message'])): %}{{$response['message']}}{% endif; %}</textarea>
				</div>	
			</div>
		</div>
	</div>	
	<button class="btn btn-success btn-lg mt-1 j_save_record" 
	data-form="contactForm" 
	data-saveurl="{{ route('/contacts-form/save/'.$id) }}" 
	data-responseurl="{{ route('/') }}"
	data-waitmessage="Please wait" 
	data-titlemsg="Message" 
	data-successmsg="Message saved successfully" 
	data-failedmsg="Failed to save message"
	id="" type="submit">Save</button>
</form>

<script src="{{ asset('scripts/db.handler.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
{% endblock %}