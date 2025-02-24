<script>
  window.addEventListener("load", function() {
    window.open(`<?= base_url('ambil/cetak_antrian') ?>?type=sidang&id=<?= $data->id ?>`, '_blank', 'location=yes,height=320,width=520,scrollbars=yes,status=yes')
  })
</script>