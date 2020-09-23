<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style>
		body {
			background-image: url('<?= base_url(); ?>assets/images/bg.png');
			background-size: cover;
		}

		.card {
			box-shadow: 0 5px 5px 1px gray;
		}

		input:focus {
			border: 1px solid gray !important;
			box-shadow: none !important;
		}
	</style>

	<title>Glam Potions</title>
</head>

<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="logo text-center">
					<img src="<?= base_url(); ?>assets/images/brand_logo.png" alt="">
				</div>
				<div class="card border-0 rounded-0 bg-light mt-5">
					<div class="card-body p-0">
						<div class="row">
							<div class="col p-4">
								<p class="text-muted">Create your account</p>
								<?php if ($this->session->flashdata('email-used')) : ?>
									<?= '<p class="alert alert-danger">' . $this->session->flashdata('email-used') . '</p>'; ?>
								<?php endif; ?>
								<form method="POST" action="<?= base_url('tour/join'); ?>" class="form-group w-100">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-envelope"></i></span>
										</div>
										<input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" placeholder="Email Address">

										<button type="submit" class="btn btn-danger mx-2">
											Join now
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>
