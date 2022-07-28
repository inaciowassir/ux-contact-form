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
	<link href="{{ asset('vendors/bootstrap/css/cheatsheet.css') }}" rel="stylesheet">
	<link href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendors/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">

	<script src="{{ asset('vendors/jquery/jquery.min.js') }}"></script>
</head>

<body class="bg-light h-100">
	<div class="container-fluid">
		<div class="row">
			<main class="col-md-10 col-lg-10 px-md-4" style="min-height: 100vh;margin-left: auto; margin-right: auto">
				{% yield content %}
			</main>
		</div>
	</div>
	<script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<style>
		body:not(.modal-open)
		{
		  padding-right: 0px !important;
		}
	</style>
</body>

</html>