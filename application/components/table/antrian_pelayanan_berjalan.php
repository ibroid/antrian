<table class="table table-hover table-striped" id="table-antrian-pelayanan">
  <thead>
    <tr>
      <th>No.</th>
      <th>Antrian</th>
      <th>Tujuan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>

<script>
  window.addEventListener("load", function() {
    const datatable = $("#table-antrian-pelayanan").DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
      },
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        //panggil method ajax list dengan ajax
        "url": '<?= base_url('pelayanan/datatable_antrian_pelayanan'); ?>',
        "type": "POST"
      }
    })

    var pusher = new Pusher('a360f9f6cfefca4c383b', {
      cluster: 'ap1'
    });

    const antrianChannel = pusher.subscribe('antrian-channel');

    antrianChannel.bind('new-antrian-ptsp', function(data) {
      datatable.ajax.reload()
    })

    antrianChannel.bind('update-antrian-ptsp', function(data) {
      datatable.ajax.reload()
    })

  })
</script>