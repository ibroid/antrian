<div class="card" id="card-statistic-kunjungan">
  <div class="card-header card-no-border d-flex">
    <div>
      <h6>Statistik Pengunjung Berdasarkan Tujuan</h6>
      <span class="f-light f-w-500 f-14">Tahun <?= date('Y') ?></span>
    </div>
    <div class="ms-4 text-end">
      <select name="select_tahun" id="select-tahun-t8wy" class="form-select">
        <?php for ($i = date('Y'); $i >= 2022; $i--) { ?>
          <option><?= $i ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="card-body pt-0">
    <div class="row m-0 overall-card overview-card">
      <div class="col-xl-12 col-md-12 col-sm-12 p-0 box-col-12">
        <div class="chart-right">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-body p-0">
                <div class="current-sale-container order-container">
                  <div class="overview-wrapper" id="chart-t8wy"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    "use script"
    var chartoverview, chartorder, chart;

    window.addEventListener('load', function() {
      $("#select-tahun-t8wy").change((e) => {

        requestData($(e.target).val(), (res) => {

          const {
            dataPihakBaru,
            dataPihakLama
          } = mappingData(res)
          appendData(dataPihakBaru, dataPihakLama)

          $("#card-statistic-kunjungan").find("span.f-light").text("Tahun " + tanggal($(e.target).val()))
        })
      })

      requestData(<?= date('Y') ?>, (res) => {
        const {
          dataPihakBaru,
          dataPihakLama
        } = mappingData(res)
        appendData(dataPihakBaru, dataPihakLama)
      })

    })

    /**
     * @param {{month:number, total:number}[]} dataBaru 
     * @param {{month:number, total:number}[]} dataLama 
     */
    function appendData(dataBaru, dataLama) {
      if (chart) {
        chart.destroy()
      }

      var options = {
        series: [{
          name: 'Pihak Baru',
          data: [...dataBaru.map(v => v.total)]
        }, {
          name: 'Pihak Lama',
          data: [...dataLama.map(v => v.total)]
        }],
        chart: {
          type: 'bar',
          height: 400,
          stacked: true,
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 10,
            borderRadiusApplication: 'end', // 'around', 'end'
            borderRadiusWhenStacked: 'last', // 'all', 'last'
            dataLabels: {
              position: 'bottom',
              total: {
                enabled: true,
                style: {
                  fontSize: '13px',
                  fontWeight: 900
                }
              }
            }
          },
        },
        xaxis: {
          type: 'month',
          categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agusuts', 'September', 'Oktober', 'November', 'Desember'],
        },
        legend: {
          position: 'right',
          offsetY: 40
        },
        fill: {
          opacity: 1
        }
      };

      chart = new ApexCharts(document.querySelector("#chart-t8wy"), options);
      chart.render();
    }

    function mappingData(res) {
      const date = new Date(Date.now())

      /** @type {{month:number, total:number}[]} */
      const dataPihakBaru = res.data.pihakBaru;
      const dataPihakLama = res.data.pihakLama;

      if ($("#select-tahun-t8wy").val() == 2022) {
        for (let i = 12 - dataPihakBaru.length; i >= 1; i--) {
          dataPihakBaru.push({
            month: i,
            total: 0
          })
          dataPihakLama.push({
            month: i,
            total: 0
          })
        }
      } else {
        for (let i = dataPihakBaru.length + 1; i < 13; i++) {
          dataPihakBaru.push({
            month: i,
            total: 0
          })
          dataPihakLama.push({
            month: i,
            total: 0
          })
        }
      }

      dataPihakBaru.sort((a, b) => {
        if (a.month < b.month) {
          return -1
        } else {
          return 1
        }
      })
      dataPihakLama.sort((a, b) => {
        if (a.month < b.month) {
          return -1
        } else {
          return 1
        }
      })

      return {
        dataPihakBaru,
        dataPihakLama
      }
    }

    function requestData(tahun, callback) {
      $.ajax({
        url: "<?= base_url('api/statistic_kunjungan/tahun') ?>",
        method: "POST",
        beforeSend(xhr) {
          xhr.setRequestHeader("Authorization", "Bearer " + "<?= $_ENV["API_KEY"] ?>")
        },
        data: {
          tahun
        },
        success: callback,
        error(err) {
          console.log("Terjadi kesalahan dalam statistic kunjungan pertahun",
            err)
        }
      })
    }


  })()
</script>