<div class="card">
  <div class="card-header card-no-border">
    <h6>Jumlah Sidang Hari Ini</h6>
    <span class="f-light f-w-500 f-14"><?= tanggal_indo(date("Y-m-d")) ?></span>
  </div>
  <div class="card-body pt-0">
    <div class="monthly-profit">
      <div id="profitmonthly"></div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    $.ajax({

    })
    var optionsprofit = {
      labels: ["Syuraih", "Umar", "Musa"],
      series: [30, 55, 35],
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
                label: "$ 34,098",
                formatter: () => "Total Profit",
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
      colors: ["#54BA4A", "var(--theme-deafult)", "#FFA941"],
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

    var chartprofit = new ApexCharts(
      document.querySelector("#profitmonthly"),
      optionsprofit
    );
    chartprofit.render();
  })
</script>