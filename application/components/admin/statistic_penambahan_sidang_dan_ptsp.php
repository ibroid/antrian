<div class="card visitor-card">
  <div class="card-header card-no-border">
    <div class="header-top">
      <h6 class="m-0">Pengunjung Pelayanan dan Persidangan<span class="f-14 font-primary f-w-500 ms-1">
          <svg class="svg-fill me-1">
            <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
          </svg>(Campuran)</span></h6>
      <div class="card-header-right-icon">
        <div class="dropdown icon-dropdown">
          <button class="btn dropdown-toggle" id="visitorButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="visitorButton"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday</a></div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body pt-0">
    <div class="visitors-container">
      <div id="chart-7725"></div>
    </div>
  </div>
</div>

<script>
  (function() {
    "use strict"

    var chartvisitor;

    window.addEventListener("load", function() {
      fetchToday()
    })

    async function fetchToday() {
      if (chartvisitor) {
        chartvisitor.destroy()
      }

      const data = await requestData()

      const container = [];
      data.forEach((r, i) => {
        if (r.status == "fulfilled") {
          container[i] = r.value.data;
        } else {
          console.error("Terjadi kesalahan saat fetching : " + r.reason)
          container[i] = [];
        }
      })

      appendData(container)
    }

    /**
     * @param {string} date 
     * @return {{status:string, value:any}[]}
     */
    function requestData(date = "<?= date("Y-m-d") ?>") {
      const formBody = new FormData()
      formBody.append('date', date);

      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'User-Agent': 'insomnia/2023.5.8',
          Authorization: 'Bearer 8aImjXIeOiLRpdIdfZYJRsvMZUj87WmL'
        },
        body: date
      };

      return Promise.allSettled([
        fetch('https://antrian.test/api/statistic_penambahan_ptsp', options)
        .then(response => response.json()),
        fetch('https://antrian.test/api/statistic_penambahan_sidang', options)
        .then(response => response.json())
      ])
    }

    function appendData(data) {
      const optionsvisitor = {
        series: [{
            name: "Pelayanan",
            data: data[0],
          },
          {
            name: "Persidangan",
            data: data[1],
          },
        ],
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
            columnWidth: "50%",
          },
        },
        dataLabels: {
          enabled: false,
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
        colors: ["#FFA941", "var(--theme-deafult)"],
        xaxis: {
          categories: [
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
          // tickAmount: 4,
          // tickPlacement: "between",
          labels: {
            style: {
              fontFamily: "Rubik, sans-serif",
            },
          },
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
        },
        yaxis: {
          min: 0,
          max: 100,
          tickAmount: 5,
          tickPlacement: "between",
          labels: {
            style: {
              fontFamily: "Rubik, sans-serif",
            },
          },
        },
        fill: {
          opacity: 1,
        },
        legend: {
          position: "top",
          horizontalAlign: "left",
          fontFamily: "Rubik, sans-serif",
          fontSize: "14px",
          fontWeight: 500,
          labels: {
            colors: "var(--chart-text-color)",
          },
          markers: {
            width: 6,
            height: 6,
            radius: 12,
          },
          itemMargin: {
            horizontal: 10,
          },
        },
        responsive: [{
            breakpoint: 1366,
            options: {
              plotOptions: {
                bar: {
                  columnWidth: "80%",
                },
              },
              grid: {
                padding: {
                  right: 0,
                },
              },
            },
          },
          {
            breakpoint: 992,
            options: {
              plotOptions: {
                bar: {
                  columnWidth: "70%",
                },
              },
            },
          },
          {
            breakpoint: 576,
            options: {
              plotOptions: {
                bar: {
                  columnWidth: "60%",
                },
              },
              grid: {
                padding: {
                  right: 5,
                },
              },
            },
          },
        ],
      };

      chartvisitor = new ApexCharts(
        document.querySelector("#chart-7725"),
        optionsvisitor
      );
      chartvisitor.render();
    }
  })()
</script>