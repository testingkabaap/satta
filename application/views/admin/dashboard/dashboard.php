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
							<h1 class="m-0">Dashboard</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
								<li class="breadcrumb-item active">Dashboard v1</li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
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