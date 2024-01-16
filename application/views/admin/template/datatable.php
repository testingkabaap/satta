<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url("assets-admin/") ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url("assets-admin/") ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url("assets-admin/") ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- DataTables  & Plugins -->
<script src="<?php echo base_url("assets-admin/") ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url("assets-admin/") ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function() {
    $("#pro_datatable").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#pro_datatable_wrapper .col-md-6:eq(0)');
    $('#basic_databable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>