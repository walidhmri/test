/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */

let low = document.querySelector("meta[name='tickets-low']").content;
let medium = document.querySelector("meta[name='tickets-medium']").content;
let high = document.querySelector("meta[name='tickets-high']").content;
let urgent = document.querySelector("meta[name='tickets-urgent']").content;

const pieConfig = {
  type: 'doughnut',
  data: {
    datasets: [
      {
       
        data: [low, medium, high, urgent],
        /**
         * These colors come from Tailwind CSS palette
         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
         */
        backgroundColor: ['#0694a2', '#1c64f2', '#7e3af2', 'red'],
        label: 'Dataset 1',
      },
    ],
    labels: ['Low', 'Medium', 'High','Urgent'],
  },
  options: {
    responsive: true,
    cutoutPercentage: 50,
    /**
     * Default legends are ugly and impossible to style.
     * See examples in charts.html to add your own legends
     *  */
    legend: {
      display: true,
    },
  },
}

// change this to the id of your chart element in HMTL
const pieCtx = document.getElementById('pie')
window.myPie = new Chart(pieCtx, pieConfig)
