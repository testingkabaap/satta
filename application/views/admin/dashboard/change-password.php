<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/template/head") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<?php $this->load->view("admin/template/header") ?>
		<?php $this->load->view("admin/template/sidebar") ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Change Password</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
								<li class="breadcrumb-item active">Change Password</li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-6 offset-lg-3">
							<div class="card">
								<div class="card-header">Change Password</div>
								<div class="card-body">
									<form action="<?php echo current_url() ?>" method="POST" class="form-needs-validation reload-page-form" novalidate>
										<div class="error-box"></div>
										<div class="row">

											<div class="col-12 form-group">
												<label for="">Old Password</label>
												<input type="password" name="o_password" class="form-control" required placeholder="Old Password">
												<div class="invalid-feedback">Enter Old Password</div>
											</div>

											<div class="col-12 form-group">
												<label for="">New Password</label>
												<input type="password" name="password" class="form-control" required placeholder="New Password">
												<div class="invalid-feedback">Enter New Password</div>
											</div>

											<div class="col-12 form-group">
												<label for="">Confirm Password</label>
												<input type="password" name="c_password" class="form-control" required placeholder="Confirm Password">
												<div class="invalid-feedback">Enter Confirm Password</div>
											</div>

											<div class="col-12 text-center">
												<button type="submit" class="btn btn-success">Change Password</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<?php $this->load->view("admin/template/footer") ?>
	</div>
	<!-- ./wrapper -->

	<?php $this->load->view("admin/template/foot") ?>
</body>

</html>