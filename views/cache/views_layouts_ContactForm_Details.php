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
				
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
	<a class="btn btn-success btn-lg java_last_exception_clear" href="<?php echo route('/contacts-form/save/'.$response['id']) ?>" id=""><i class="fa fa-pencil"></i> Edit Message</a>
</div>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo route('/') ?>">Messages</a></li>
		<li class="breadcrumb-item active" aria-current="page">Details</li>
	</ol>
</nav>
<div class="">
	<i class="fa fa-history"></i> <em>Last updated at <?php echo date("d/m/Y H:i:s", strtotime($response["updated_at"])); ?></em>
	
</div>
<div class="card">
	<div class="card-body">
		<div class="table-responsive table-responsive-lg px-2 py-2">		
			<table id="" class="table table-striped table-condensed table-sm" style="width: 100%;">
				<tbody>
					<?php if(!empty($response["name"])): ?>
						<tr>
							<td><strong><i class="fa fa-sitemap"></i> Nome</strong></td>
							<td class="text-muted"><?php echo $response["name"]; ?></td>
						</tr>
					<?php endif; ?>
					
					<?php if(!empty($response["email"])): ?>
						<tr>
							<td><strong><i class="fa fa-envelope"></i> email</strong></td>
							<td class="text-muted"><?php echo $response["email"]; ?></td>
						</tr>
					<?php endif; ?>
					
					<?php if(!empty($response["message"])): ?>
						<tr>
							<td><strong><i class="fa fa-comment"></i> Message</strong></td>
							<td class="text-muted"><?php echo $response["message"]; ?></td>
						</tr>
					<?php endif; ?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="<?php echo asset('scripts/stock.handler.js') ?>"></script>
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

