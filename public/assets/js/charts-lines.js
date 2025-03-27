let array = [0, 0, 0, 0, 0, 0, 0];
let array2 = [0, 0, 0, 0, 0, 0, 0];
for (let index = 1; index <= 7; index++) {
  let metaTag = document.querySelector("meta[name='tickets-solved-" + index + "']");
  if (metaTag) {
    array[index - 1] = metaTag.content; // استخدام index-1 لأن المصفوفة تبدأ من 0
  }
}
for (let index = 1; index <= 7; index++) {
  let metaTag = document.querySelector("meta[name='tickets-pending-" + index + "']");
  if (metaTag) {
    array2[index - 1] = metaTag.content; // استخدام index-1 لأن المصفوفة تبدأ من 0
  }
}

console.log(array);

const lineConfig = {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Solved',
        /**
         * These colors come from Tailwind CSS palette
         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
         */
        backgroundColor: '#0694a2',
        borderColor: '#0694a2',
        data: [array[0], array[1], array[2], array[3], array[4], array[5], array[6]],
        
        fill: true,
      },
      {
        label: 'Pending',
        fill: true,
        /**
         * These colors come from Tailwind CSS palette
         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
         */
        backgroundColor: '#7e3af2',
        borderColor: '#7e3af2',
        data:[array2[0], array2[1], array2[2], array2[3], array2[4], array2[5], array2[6]],
      },
    ],
  },
  options: {
    responsive: true,
    /**
     * Default legends are ugly and impossible to style.
     * See examples in charts.html to add your own legends
     *  */
    legend: {
      display: false,
    },
    tooltips: {
      mode: 'index',
      intersect: false,
    },
    hover: {
      mode: 'nearest',
      intersect: true,
    },
    scales: {
      x: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Month',
        },
      },
      y: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Value',
        },
      },
    },
  },
}

// change this to the id of your chart element in HMTL
const lineCtx = document.getElementById('line')
window.myLine = new Chart(lineCtx, lineConfig)
