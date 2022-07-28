<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Contact form task for vancancy evaluation">
	<meta name="author" content="Inacio Agostinho Uassire">
	<meta name="generator" content="">
	<title>UX Contact Form</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo asset('vendors/bootstrap/css/cheatsheet.css') ?>" rel="stylesheet">
	<link href="<?php echo asset('vendors/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo asset('vendors/fontawesome/css/font-awesome.min.css') ?>" rel="stylesheet">

	<script src="<?php echo asset('vendors/jquery/jquery.min.js') ?>"></script>
</head>

<body class="bg-light h-100">
	<div class="container-fluid">
		<div class="row">
			<main class="col-md-10 col-lg-10 px-md-4" style="min-height: 100vh;margin-left: auto; margin-right: auto">
				
<nav aria-label="breadcrumb" class="mt-4">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo route('/') ?>">Messages</a></li>
		<li class="breadcrumb-item active" aria-current="page">New</li>
	</ol>
</nav>
<form name="contactForm" class="mb-4">
	<div class="card mb-4">
		<div class="card-body">
			<div class="row g-3">
				<div class="col-sm-4 form-floating">
					<label for="name" class="text-muted pt-1">Name</label>
					<input type="text" class="form-control" id="name" name="name" value="<?php if(!empty($response['name'])): ?><?php echo $response['name'] ?><?php endif; ?>" 
					required>
				</div>
				
				<div class="col-sm-4 form-floating">
					<label for="email" class="text-muted pt-1">Email</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php if(!empty($response['email'])): ?><?php echo $response['email'] ?><?php endif; ?>" required>
				</div>
				
				<div class="col-12 form-floating">
					<label for="message" class="text-muted pt-1">Message</label>
					<textarea class="form-control" id="message" name="message" style="height:150px;" required><?php if(!empty($response['message'])): ?><?php echo $response['message'] ?><?php endif; ?></textarea>
				</div>	
			</div>
		</div>
	</div>	
	<button class="btn btn-success btn-lg mt-1 j_save_record" 
	data-form="contactForm" 
	data-saveurl="<?php echo route('/contacts-form/save/'.$id) ?>" 
	data-responseurl="<?php echo route('/') ?>"
	data-waitmessage="Please wait" 
	data-titlemsg="Message" 
	data-successmsg="Message saved successfully" 
	data-failedmsg="Failed to save message"
	id="" type="submit">Save</button>
</form>

<script src="<?php echo asset('scripts/db.handler.js') ?>"></script>
<script src="<?php echo asset('vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>

			</main>
		</div>
	</div>
	<script src="<?php echo asset('vendors/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<style>
		body:not(.modal-open)
		{
		  padding-right: 0px !important;
		}
	</style>
</body>

</html>

