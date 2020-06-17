<template>
  <div class="container-fluid">
    <h2 style="text-transform:capitalize; font-size:3vw;">
      {{ capitalize(this.$parent.currentComponent) }}
    </h2>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">how_to_reg</i>
            </div>
            <p class="card-category">Admins</p>
            <h3 class="card-title">10/10</h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">person</i>
            </div>
            <p class="card-category">Teachers</p>
            <h3 class="card-title">10/10</h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">people</i>
            </div>
            <p class="card-category">Students</p>
            <h3 class="card-title">10/10</h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">people</i>
            </div>
            <p class="card-category">Majors</p>
            <h3 class="card-title">10/10</h3>
          </div>
        </div>
      </div>
    </div>
    <div
      class="chart-container"
      style="position: relative; height:40vh; width:45vw"
    >
      <canvas id="myChart" width="400" height="400" responsive="true"></canvas>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      colorsArray: [],
      //data: [12, 19, 3, 5, 2, 3, 20, 25, 30, 50, 15, 32],
      data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      months: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "Novembre",
        "December"
      ],
      absences: [],
      absencePerMonth: []
    };
  },
  methods: {
    randomColor() {
      return `rgba(${Math.floor(Math.random() * 255 + 1)},${Math.floor(
        Math.random() * 255 + 1
      )},${Math.floor(Math.random() * 255 + 1)})`;
    },
    fillColorsArray() {
      for (let i = 0; i < 12; i++) {
        this.colorsArray.push(this.randomColor());
      }
    },
    getMonths() {
      for (let i = 0; i < this.absences.length; i++) {
        this.absencePerMonth.push(this.absences[i].date);
      }
    },
    getTotalAbsences() {
      for (let i = 0; i < this.absencePerMonth.length; i++) {
        let tempArr = this.absencePerMonth[i].split("-");
        this.data[tempArr[1] - 1]++;
      }
    },
    capitalize(str) {
      let name = str.split("/");
      return name[1];
      //return text.charAt(0).toUpperCase() + text.slice(1);
    },
    loadChart() {
      let ctx = document.getElementById("myChart");
      let myCharts = new Chart(ctx, {
        type: "bar",
        data: {
          labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "Novembre",
            "December"
          ],
          datasets: [
            {
              label: "Total Absences Per Month For " + new Date().getFullYear(),
              data: this.data,
              backgroundColor: [...this.colorsArray],
              borderWidth: 1
            }
          ]
        },
        options: {
          scales: {
            yAxes: [
              {
                display: true,
                ticks: {
                  suggestedMin: 0,
                  stepValue: 5,
                  steps: 10
                }
              }
            ]
          }
        }
      });
    },
    getAttendances() {
      axios.get("api/attendance").then(({ data }) => {
        this.absences = data;
        this.getMonths();
        this.getTotalAbsences();
        this.loadChart();
      });
    }
  },
  mounted() {
    this.fillColorsArray();
  },
  created() {
    this.getAttendances();
  }
};
</script>
