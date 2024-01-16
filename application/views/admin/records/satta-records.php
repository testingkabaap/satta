<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/template/head") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">


  <!-- BEGIN:: MODALS -->
  <div class="modal fade" id="addDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDataModalLabel">Add Satta Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo current_url() ?>" method="POST" class="form-needs-validation reload-page-form" novalidate>
            <div class="error-box"></div>
            <div class="row">
              <div class="col-12 form-group">
                <label for="">Satta Date</label>
                <input type="date" name="record_date" class="form-control" required placeholder="Satta Date">
                <div class="invalid-feedback">Select Satta Date</div>
              </div>

              <div class="col-12 form-group">
                <label for="">Time Slot</label>
                <select name="time_slot" required class="form-control">
                  <option value="" selected>Select Time Slot</option>
                  <?php
                  $begin = new DateTime(date('Y-m-d 09:00:00'));
                  $end = new DateTime(date('Y-m-d 22:00:00'));
                  for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
                    echo '<option value="' . $i->format("H:i:s") . '">' . $i->format("h:i A") . '</option>';
                  } ?>
                </select>
                <div class="invalid-feedback">Select Time Slot</div>
              </div>

              <div class="col-12 form-group">
                <label for="">Number</label>
                <input type="number" name="satta_number" class="form-control" required placeholder="Satta Number">
                <div class="invalid-feedback">Select Satta Number</div>
              </div>

              <div class="col-12 text-right">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDataModalLabel">Edit Animal Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo current_url() ?>" method="POST" class="form-needs-validation reload-page-form" novalidate>
            <div class="error-box"></div>
            <input type="hidden" name="edit_data" value="edit_data">
            <input type="hidden" name="id" value="">
            <div class="row">
              <div class="col-12 form-group">
                <label for="">Satta Date</label>
                <input type="date" name="record_date" class="form-control" required placeholder="Satta Date">
                <div class="invalid-feedback">Select Satta Date</div>
              </div>

              <div class="col-12 form-group">
                <label for="">Time Slot</label>
                <select name="time_slot" required class="form-control">
                  <option value="" selected>Select Time Slot</option>
                  <?php
                  $begin = new DateTime(date('Y-m-d 09:00:00'));
                  $end = new DateTime(date('Y-m-d 22:00:00'));
                  for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
                    echo '<option value="' . $i->format("H:i:s") . '">' . $i->format("h:i A") . '</option>';
                  } ?>
                </select>
                <div class="invalid-feedback">Select Time Slot</div>
              </div>

              <div class="col-12 form-group">
                <label for="">Number</label>
                <input type="number" name="satta_number" class="form-control" required placeholder="Satta Number">
                <div class="invalid-feedback">Select Satta Number</div>
              </div>

              <div class="col-12 text-right">
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END:: MODALS -->

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
              <h1 class="m-0">All Satta Record</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo site_url(ADMIN_SLUG) ?>">Home</a></li>
                <li class="breadcrumb-item active">All Satta Record</li>
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
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col-6">
                      <h3 class="card-title">All Satta Record</h3>
                    </div>
                    <div class="col-6 text-right">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#addDataModal">Add Satta Record</button>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3">
                  <table id="pro_datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Time Slot</th>
                        <th>Number</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (isset($TABLE_DATA) && !empty($TABLE_DATA)) {
                        foreach ($TABLE_DATA as $k => $v) {
                          echo '<tr>';
                          echo '<td>' . $v["id"] . '</td>';
                          echo '<td>' . $v["record_date"] . '</td>';
                          echo '<td>' . date('h:i A', strtotime($v["time_slot"])) . '</td>';
                          echo '<td>' . $v["satta_number"] . '</td>';
                          echo '<td>' . $v["created_at"] . '</td>';
                          echo '<td>
																	<div class="btn-group">
																		<button type="button" class="btn btn-sm btn-info dynamicViewBtn" data-id="' . $v["id"] . '"  data-table-name="' . $TABLE_NAME . '"><i class="fas fa-eye"></i></button>
																		<button type="button" class="btn btn-sm btn-warning dynamicEditBtn" data-id="' . $v["id"] . '"  data-table-name="' . $TABLE_NAME . '"><i class="fas fa-pencil-alt"></i></button>
																		<button type="button" class="btn btn-sm btn-danger dynamicDeleteBtn" data-id="' . $v["id"] . '"  data-table-name="' . $TABLE_NAME . '"><i class="fas fa-trash-alt"></i></button>
																	</div>
																</td>';
                          echo '</tr>';
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
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
  <?php $this->load->view("admin/template/datatable") ?>
  <script>
    $(document).ready(function() {

      $(document).on("click", "button.dynamicEditBtn", function() {
        var thisE = $(this);
        var id = thisE.attr("data-id");
        var table_name = thisE.attr("data-table-name");

        var formData = new FormData();
        formData.append("id", id);
        formData.append("table_name", table_name);

        submit_form_data_ajax(GET_ROW_DATA_URL, formData, function(output) {
          try {
            var res = JSON.parse(output);
            if (res.status) {
              $("#editDataModal").find('[name="id"]').val(res.data.record.id);
              $("#editDataModal").find('[name="record_date"]').val(res.data.record.record_date);
              $("#editDataModal").find('[name="time_slot"]').val(res.data.record.time_slot);
              $("#editDataModal").find('[name="satta_number"]').val(res.data.record.satta_number);
              $("#editDataModal").modal("show");
            } else {
              setErrorToast(res.status_code, res.message);
            }
          } catch (e) {
            setErrorToast(400, e);
          }
        });

      });
    });
  </script>
</body>

</html>