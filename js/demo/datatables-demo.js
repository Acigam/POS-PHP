// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
  $('#dataTableKategori').DataTable(  {
    "columns": [
      { "width": "10%" },
      { "width": "75%" },
      { "width": "15%" }
    ]
  } );
});
