<div class="card" id="card-static-pengambilan-sidang">
  <div class="card-header card-no-border d-flex">
    <div>
      <h6>Statistik Pengambilan Antrian Per Jam</h6>
      <span class="f-light f-w-500 f-14">Tanggal <?= tanggal_indo(date("Y-m-d")) ?></span>
    </div>
    <?= $this->load->component("admin/button_chart_toolbar") ?>
  </div>
  <div class="card-body pt-0">
    <div class="row m-0 overall-card overview-card">
      <div class="col-xl-9 col-md-12 col-sm-12 p-0 box-col-9">
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
                  <div class="overview-wrapper" id="chart-779"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-12 col-sm-12 p-0 box-col-3">
        <div class="row g-sm-3 g-2">
          <div class="col-md-12">
            <div class="light-card balance-card widget-hover">
              <div class="svg-box">
                <svg class="svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#clock"></use>
                </svg>
              </div>
              <div>
                <span class="f-light">Pertama</span>
                <h6 class="mt-1 mb-0">00.00</h6>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="light-card balance-card widget-hover">
              <div class="svg-box">
                <svg class="svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#clock"></use>
                </svg>
              </div>
              <div> <span class="f-light">Kedua</span>
                <h6 class="mt-1 mb-0">00.00</h6>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="light-card balance-card widget-hover">
              <div class="svg-box">
                <svg class="svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#clock"></use>
                </svg>
              </div>
              <div> <span class="f-light">Ketiga</span>
                <h6 class="mt-1 mb-0">00.00</h6>
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

        $("#card-static-pengambilan-sidang")
          .find("span.f-light.f-w-500.f-14")
          .text("Tanggal " + tanggal(theInput.val()))

        requestData((res) => {
          chartoverview.destroy()
          appendData(res.data)
          updateRank(res.data)
        }, theInput.val());

        optionButton.click()
      })

      $("#card-static-pengambilan-sidang").find("a:nth-child(1)").click(() => {
        console.log('ok')
        fetchToday()
        $("#card-static-pengambilan-sidang")
          .find("span.f-light.f-w-500.f-14")
          .text("Tanggal " + tanggal("<?= date("Y-m-d") ?>"))
      })

      fetchToday()
    })

    function fetchToday() {
      if (chartoverview) {
        chartoverview.destroy();
      }

      requestData((res) => {
        appendData(res.data)
        updateRank(res.data)
      })
    }

    function updateRank(data) {

      let rank1, rank2, rank3;

      data.forEach((v, i) => {
        const totalPanggilan = v.result_1 + v.result_2 + v.result_3;
        if (i > 0) {
          if (totalPanggilan >= rank1[1]) {
            rank3[1] = rank2[1];
            rank3[0] = rank3[0];

            rank2[1] = rank1[1];
            rank2[0] = rank1[0];

            rank1[1] = totalPanggilan;
            rank1[0] = v.hour;
          }

          if (totalPanggilan < rank1[1] && totalPanggilan >= rank2[1]) {
            rank3[1] = rank2[1];
            rank3[0] = rank2[0];

            rank2[1] = totalPanggilan;
            rank2[0] = v.hour;
          }

          if (totalPanggilan < rank1[1] && totalPanggilan < rank2[1] && totalPanggilan >= rank3[1]) {
            rank3[1] = totalPanggilan;
            rank3[0] = v.hour;
          }

        } else {
          rank1 = [v.hour, parseFloat(totalPanggilan)];
          rank2 = [v.hour, parseFloat(totalPanggilan)];
          rank3 = [v.hour, parseFloat(totalPanggilan)];
        }
      });

      // $('#card-static-pengambilan-sidang .card-body .col-xl-3 .box-col-3 > div:nth-child(2) > div:nth-child(2) > h6.mt-1.mb-1')
      $('#card-static-pengambilan-sidang').find('h6:nth-child(2)').each((i, e) => {
        i++;
        const total = eval('rank' + i)
        $(e).text(total[1] + " Antrian di jam " + total[0])
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

    /**@param {array[]} data  */
    function appendData(data) {

      var optionsoverview = {
        series: [{
            name: "Umar",
            type: "area",
            data: data.map((v, i) => {
              return v.result_1
            }),
          },
          {
            name: "Syuraih",
            type: "area",
            data: data.map((v, i) => {
              return v.result_2
            }),
          },
          {
            name: "Musa",
            type: "area",
            data: data.map((v, i) => {
              return v.result_3
            }),
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
          max: 12,
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

      for (let i = 0; i < 3; i++) {
        data.forEach((v, y, a) => {
          marker.push({
            seriesIndex: i,
            dataPointIndex: y,
            fillColor: optionsoverview.colors[i],
            strokeColor: "var(--white)",
            size: 5,
            sizeOffset: i == 0 ? 3 : 0,
          })
        })
      }


      optionsoverview.markers.discrete = marker

      chartoverview = new ApexCharts(
        document.querySelector("#chart-779"),
        optionsoverview
      );
      chartoverview.render();
      // bar overview chart
    }
  })()
</script>