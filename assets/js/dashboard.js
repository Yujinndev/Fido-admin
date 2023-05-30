$(function () {
  var userChart = {
    series: [
      { name: "TOTAL USERS" },
      { name: "TOTAL ADOPTERS" },
    ],

    chart: {
      type: "bar",
      height: 345,
      offsetX: -15,
      toolbar: { show: true },
      foreColor: "#ffffff",
      fontFamily: 'inherit',
      sparkline: { enabled: false },
    },

    ccolors: ["#5D87FF", "#49BEFF"],

    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "35%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: { size: 0 },

    dataLabels: {
      enabled: true,
    },

    legend: {
      show: true,
    },

    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },

    xaxis: {
      type: "category",
      categories: ["ILOCOS NORTE", "ILOCOS SUR", "LA UNION", "PANGASINAN"],
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },

    yaxis: {
      show: false,
      min: 0,
      max: 3,
      tickAmount: 5,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },

    stroke: {
      show: true,
      width: 2,
      lineCap: "butt",
      colors: ["transparent"],
    },

    tooltip: { theme: "light" },

    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]
  };
  // end of user chart values

  var petChart = {
    color: "#adb5bd",
    series: [],
    labels: ["Cat", "Dog", "Pig"],
    chart: {
      width: 200,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },

    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '60%',
        },
      },
    },

    stroke: {
      show: false,
    },

    dataLabels: {
      enabled: true,
    },

    legend: {
      show: false,
    },

    ccolors: ["#  ", "#49BEFF"],

    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 150,
          },
        },
      },
    ],
    
    tooltip: {
      theme: "light",
      fillSeriesColor: false,
    },
  };
  
  // FETCH VALUES FROM MYSQL PHP QUERY
  function fetchData() {
    $.ajax({
      url: 'controllers/fetch-data.php',
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        if (data.length > 0) {
          userChart.series[0].data = data.map(obj => obj.totalUsers)
          userChart.series[1].data = data.map(obj => obj.totalAdopters)
          userChart.xaxis.categories = data.map(obj => obj.provinces)
          petChart.series = data.map(obj => obj.petCount)

          // Render the chart with updated data
          var chart = new ApexCharts(document.querySelector("#chart"), userChart);
          chart.render();
          var chart = new ApexCharts(document.querySelector("#breakup"), petChart);
          chart.render();
        } else {
          console.error('No data returned from fetch_data.php');
        }
      },
      error: function (_xhr, _status, error) {
        console.error('Error fetching data:', error);
      }
    });
  }

  fetchData();
})