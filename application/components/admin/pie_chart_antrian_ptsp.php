<div class="card" id="card-pie-chart-ptsp">
  <div class="card-header card-no-border d-flex">
    <div>
      <h6>Jumlah PTSP</h6>
      <span class="f-light f-w-500 f-14">Tanggal <?= tanggal_indo(date("Y-m-d")) ?></span>
    </div>
    <div class="ms-auto text-end">
      <div class="dropdown icon-dropdown">
        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" href="javascript:void(0)">Hari Ini</a>
          <a class="dropdown-item" href="javascript:void(0)">
            <input class="date-picker form-control border-0 p-0 form-control-sm" placeholder="Pilih Tanggal" type="text">
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body pt-0">
    <div class="monthly-profit">
      <div id="chart-852"></div>
    </div>
  </div>
</div>

<script>
  (function() {
    "use strict"

    var chart

    window.addEventListener("load", function() {
      fetchToday()

      $("#card-pie-chart-ptsp").find('a:nth-child(1)').on("click", fetchToday)

      $("#card-pie-chart-ptsp").find(".date-picker").change((e) => {
        chart.destroy()

        requestData($(e.target).val(), (res) => {
          const label = [];
          const data = [];
          let total = 0;

          for (const k in res.data) {
            if (Object.hasOwnProperty.call(res.data, k)) {
              label.push(k.toLocaleUpperCase())
              data.push(res.data[k])
              total += parseFloat(res.data[k])
            }
          }

          appendData(label, data, total)

          $("#card-pie-chart-ptsp").find("span.f-light").text("Tanggal " + tanggal($(e.target).val()))

          $("#card-pie-chart-ptsp").find('button.dropdown-toggle').attr("aria-expanded", "false").click()
        })
      })
    })

    function fetchToday() {
      if (chart) {
        chart.destroy()
      }
      requestData("<?= date("Y-m-d") ?>", (res) => {
        const label = [];
        const data = [];
        let total = 0;

        for (const k in res.data) {
          if (Object.hasOwnProperty.call(res.data, k)) {
            label.push(k.toLocaleUpperCase())
            data.push(res.data[k])
            total += parseFloat(res.data[k])
          }
        }

        appendData(label, data, total)
      })
    }



    function requestData(date, callback) {
      $.ajax({
        url: "<?= base_url('api/pie_chart_ptsp') ?>",
        method: "POST",
        data: {
          date
        },
        beforeSend(xhr) {
          xhr.setRequestHeader("Authorization", "Bearer " + "<?= $_ENV["API_KEY"] ?>")
        },
        success(res) {
          callback(res)
        },
        error(err) {
          console.log(err)
        }
      })
    }

    function appendData(label, data, total) {
      console.log(data)
      var optionsprofit = {
        labels: label,
        series: data.map(r => parseFloat(r)),
        chart: {
          type: "donut",
          height: 300,
        },
        dataLabels: {
          enabled: false,
        },
        legend: {
          position: "bottom",
          fontSize: "14px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 500,
          labels: {
            colors: ["var(--chart-text-color)"],
          },
          markers: {
            width: 6,
            height: 6,
          },
          itemMargin: {
            horizontal: 7,
            vertical: 0,
          },
        },
        stroke: {
          width: 10,
          colors: ["var(--light2)"],
        },
        plotOptions: {
          pie: {
            expandOnClick: false,
            donut: {
              size: "83%",
              labels: {
                show: true,
                name: {
                  offsetY: 4,
                },
                total: {
                  show: true,
                  fontSize: "20px",
                  fontFamily: "Rubik, sans-serif",
                  fontWeight: 500,
                  label: total,
                  formatter: () => "Antrian",
                },
              },
            },
          },
        },
        states: {
          normal: {
            filter: {
              type: "none",
            },
          },
          hover: {
            filter: {
              type: "none",
            },
          },
          active: {
            allowMultipleDataPointsSelection: false,
            filter: {
              type: "none",
            },
          },
        },
        colors: ["#24BA4A", "#FA1F4A", "#FFA941", "#84CB46", "#F4DD1A", "#A5BA42"],
        responsive: [{
            breakpoint: 1630,
            options: {
              chart: {
                height: 360,
              },
            },
          },
          {
            breakpoint: 1584,
            options: {
              chart: {
                height: 400,
              },
            },
          },
          {
            breakpoint: 1473,
            options: {
              chart: {
                height: 250,
              },
            },
          },
          {
            breakpoint: 1425,
            options: {
              chart: {
                height: 270,
              },
            },
          },
          {
            breakpoint: 1400,
            options: {
              chart: {
                height: 320,
              },
            },
          },
          {
            breakpoint: 480,
            options: {
              chart: {
                height: 250,
              },
            },
          },
        ],
      };

      chart = new ApexCharts(
        document.querySelector("#chart-852"),
        optionsprofit
      );
      chart.render();
    }
  })()
</script>