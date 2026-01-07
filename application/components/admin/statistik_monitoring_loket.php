<div class="card visitor-card">
  <div class="card-header card-no-border">
    <div class="header-top">
      <h5 class="m-0">Monitoring Loket</h5>
    </div>
  </div>
  <div class="card-body pt-0">
    <div class="row">
      <div class="col-8">
        <div class="visitors-container" id="loket-chart-container">
          <div id="loket-chart"></div>
        </div>
      </div>
      <div class="col-4">
        <form action="">
          <div class="form-group">
            <label for="daterange">Tampilkan Berdasarkan Tanggal</label>
            <input type="text" id="daterange" class="form-control" name="daterange" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    window.addEventListener("load", () => {
      var chart;
      var start = moment().subtract(1, 'days');
      var end = moment();

      function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }

      $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, cb);

      cb(start, end);

      $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        reajax(picker.startDate.format('YYYY-MM-DD'), picker.endDate ? picker.endDate.format('YYYY-MM-DD') : null);
      });

      var options = {
        series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }],
        chart: {
          type: "bar",
          height: 270,
          toolbar: {
            show: false,
          },
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '40%',
            borderRadius: 6,
            borderRadiusApplication: 'end'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 6,
          colors: ["transparent"],
        },
        grid: {
          show: true,
          borderColor: "var(--chart-border)",
          xaxis: {
            lines: {
              show: true,
            },
          },
        },
        xaxis: {
          categories: [],
        },
        yaxis: {
          title: {
            text: 'Jumlah Antrian'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function(val) {
              return val + " antrian";
            }
          }
        }
      };

      function reajax(datestart, dateend = null) {
        $.ajax({
          url: "<?= base_url('/admin/statistik_monitoring_loket') ?>",
          method: "POST",
          data: {
            datestart,
            dateend
          },
          dataType: "json",
          beforeSend: function() {
            if (chart) {
              chart.destroy();
            }
            // $("#loket-chart-container").html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');
          },
          success: function(data) {
            console.log(data);
            options.xaxis.categories = data.map(item => item.nama_loket);
            options.series[0].data = data.map(item => item.total_antrian);
            options.series[0].name = "Total Antrian";
          },
          error: function(error) {
            $("#loket-chart-container").html('<div class="alert alert-danger">Error loading data: ' + error.responseText + '</div>');
          },
          complete: function() {
            chart = new ApexCharts(document.querySelector("#loket-chart"), options);
            chart.render();
          }
        });
      }

      reajax('<?= date('Y-m-d') ?>');
    })
  </script>
</div>