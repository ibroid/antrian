<div class="card" id="card-static-pengambilan-sidang">
  <div class="card-header card-no-border d-flex">
    <div>
      <h6>Statistik Pengambilan Antrian Per Jam</h6>
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
    <div class="row m-0 overall-card overview-card">
      <div class="col-xl-9 col-md-9 col-sm-9 p-0 box-col-9">
        <div class="chart-right">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-body p-0">
                <ul class="balance-data">
                  <li><span class="circle bg-secondary"></span><span class="f-light ms-1">Musa</span></li>
                  <li><span class="circle bg-primary"> </span><span class="f-light ms-1">Umar</span></li>
                  <li><span class="circle bg-success"> </span><span class="f-light ms-1">Syuraih</span></li>
                </ul>
                <div class="current-sale-container order-container">
                  <div class="overview-wrapper" id="orderoverview"></div>
                  <div class="back-bar-container">
                    <div id="order-bar"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-3 col-sm-3 p-0 box-col-3">
        <div class="row g-sm-3 g-2">
          <div class="col-md-12">
            <div class="light-card balance-card widget-hover">
              <div class="svg-box">
                <svg class="svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#orders"></use>
                </svg>
              </div>
              <div>
                <span class="f-light">Di Putus</span>
                <h6 class="mt-1 mb-0">77 </h6>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="light-card balance-card widget-hover">
              <div class="svg-box">
                <svg class="svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#expense"></use>
                </svg>
              </div>
              <div> <span class="f-light">Total Siang Sipp</span>
                <h6 class="mt-1 mb-0">178</h6>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="light-card balance-card widget-hover">
              <div class="svg-box">
                <svg class="svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#doller-return"></use>
                </svg>
              </div>
              <div> <span class="f-light">Tidak hadir Sidang</span>
                <h6 class="mt-1 mb-0">3</h6>
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

    var chartoverview, chartorder;

    window.addEventListener("load", function() {
      $("#card-static-pengambilan-sidang").find("input").change((e) => {
        const theInput = $(e.target)
        const optionButton = $(e.target).closest("a").closest("div").prev();

        requestData((res) => {
          chartoverview.destroy()
          appendData(res.data)
        }, theInput.val());

        requestDataBar((res) => {
          chartoverview.destroy()
          appendBar(res.data)
        }, theInput.val())

        optionButton.click()
      })

      $("#card-static-pengambilan-sidang").find("a:nth-child(0)").click(() => {
        fetchToday()
      })

      fetchToday()
    })

    function fetchToday() {
      if (chartoverview) {
        chartoverview.destroy();
      }

      if (chartorder) {
        chartorder.destroy();
      }

      requestData((res) => {
        appendData(res.data)
      })

      requestDataBar((res) => {
        appendBar(res.data)
      })
    }

    function requestData(callback, date = "<?= date("Y-m-d") ?>") {
      $.ajax({
        url: "<?= base_url('api/statistic_pemanggilan_sidang') ?>",
        method: "POST",
        data: {
          date
        },
        beforeSend(xhr) {
          xhr.setRequestHeader("Authorization", "Bearer <?= $_ENV["API_KEY"] ?>")
          xhr.setRequestHeader("Accept", "application/json")
        },
        success: callback,
        error(err) {
          console.log(err)
        }
      })
    }

    function requestDataBar(callback, date = "<?= date("Y-m-d") ?>") {
      $.ajax({
        url: "<?= base_url('api/statistic_penambahan_sidang') ?>",
        method: "POST",
        data: {
          date
        },
        beforeSend(xhr) {
          xhr.setRequestHeader("Authorization", "Bearer <?= $_ENV["API_KEY"] ?>")
          xhr.setRequestHeader("Accept", "application/json")
        },
        success: callback,
        error(err) {
          console.log(err)
        }
      })
    }

    /**@param {array[]} data  */
    function appendData(data) {

      var optionsoverview = {
        series: [{
            name: "Umar",
            type: "area",
            data: data[0],
          },
          {
            name: "Syuraih",
            type: "area",
            data: data[1],
          },
          {
            name: "Musa",
            type: "area",
            data: data[2],
          },
        ],
        chart: {
          height: 300,
          type: "line",
          stacked: false,
          toolbar: {
            show: false,
          },
          dropShadow: {
            enabled: true,
            top: 2,
            left: 0,
            blur: 4,
            color: "#000",
            opacity: 0.08,
          },
        },
        stroke: {
          width: [2, 2, 2],
          curve: "smooth",
        },
        grid: {
          show: true,
          borderColor: "var(--chart-border)",
          strokeDashArray: 0,
          position: "back",
          xaxis: {
            lines: {
              show: true,
            },
          },
          padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0,
          },
        },
        plotOptions: {
          bar: {
            columnWidth: "50%",
          },
        },
        colors: ["#7064F5", "#54BA4A", "#FF3364"],
        fill: {
          type: "gradient",
          gradient: {
            shade: "light",
            type: "vertical",
            opacityFrom: 0.4,
            opacityTo: 0,
            stops: [0, 100],
          },
        },
        labels: [
          "06:00",
          "07:00",
          "08:00",
          "09:00",
          "10:00",
          "11:00",
          "12:00",
          "13:00",
          "14:00",
          "15:00",
        ],
        markers: {
          discrete: null,
          hover: {
            size: 5,
            sizeOffset: 0,
          },
        },
        xaxis: {
          type: "hour",
          tickPlacement: "between",
          tooltip: {
            enabled: false,
          },
          axisBorder: {
            color: "var(--chart-border)",
          },
          axisTicks: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        yaxis: {
          min: 0,
          tickAmount: 6,
          tickPlacement: "between",
        },
        tooltip: {
          shared: false,
          intersect: false,
        },
        responsive: [{
          breakpoint: 1200,
          options: {
            chart: {
              height: 250,
            },
          },
        }, ],
      };

      const marker = [];

      data.forEach((v, i, a) => {
        v.forEach((x, y) => {
          if (x == 0) {
            return;
          }

          marker.push({
            seriesIndex: i,
            dataPointIndex: y,
            fillColor: optionsoverview.colors[i],
            strokeColor: "var(--white)",
            size: 5,
            sizeOffset: i == 0 ? 3 : 0,
          })
        })
      })

      optionsoverview.markers.discrete = marker

      chartoverview = new ApexCharts(
        document.querySelector("#orderoverview"),
        optionsoverview
      );
      chartoverview.render();
      // bar overview chart
    }

    function appendBar(data) {
      console.log(data.map((v, n, a) => {
        return v.count
      }))
      var optionsorder = {
        series: [{
          name: "Revenue",
          data: data.map((v, n, a) => {
            return v.count;
          }),
        }, ],
        chart: {
          type: "bar",
          height: 180,
          toolbar: {
            show: false,
          },
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "55%",
          },
        },
        colors: ["var(--light-bg)"],
        grid: {
          show: false,
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"],
        },
        xaxis: {
          categories: data.map((v, n, a) => {
            return v.hour;
          }),
          labels: {
            show: false,
          },
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
        },
        yaxis: {
          labels: {
            show: false,
          },
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
        },
        fill: {
          opacity: 0.7,
        },
        tooltip: {
          enabled: false,
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
        responsive: [{
          breakpoint: 405,
          options: {
            chart: {
              height: 150,
            },
          },
        }, ],
      };

      chartorder = new ApexCharts(
        document.querySelector("#order-bar"),
        optionsorder
      );
      chartorder.render();
    }
  })()
</script>