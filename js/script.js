const ctx = document.getElementById('chartIngresos');
new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Enero',    'Febrero', 'Marzo', 
        'Abril',    'Mayo',     'Junio',
        'Julio',    'Agosto',   'Septiembre',
        'Octubre',  'Noviembre', 'Diciembre',
    ],
    datasets: [{
        label: 'Ganancias por mes',
        data: [
            30000,25625,12451, 32254, 12505, 12458,
            78954,45785,13578, 89457, 45725, 124555,

        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const ctx2 = document.getElementById('chartCategorias');
  new Chart(ctx2, {
      type: 'bar', // Chart type
      data: {
          labels: ['Work', 'Desktop', 'All Uses', 'Gaming'], // Categories
          datasets: [{
              label: 'Computadoras por categorías',
              data: [20, 25, 30, 10], // Data for each category
              backgroundColor: [
                  'rgba(75, 192, 192, 0.2)', // Light teal for 'Work'
                  'rgba(153, 102, 255, 0.2)', // Light purple for 'Desktop'
                  'rgba(255, 159, 64, 0.2)', // Light orange for 'All Uses'
                  'rgba(255, 99, 132, 0.2)' // Light red for 'Gaming'
              ],
              borderColor: [
                  'rgba(75, 192, 192, 1)', // Darker teal
                  'rgba(153, 102, 255, 1)', // Darker purple
                  'rgba(255, 159, 64, 1)', // Darker orange
                  'rgba(255, 99, 132, 1)' // Darker red
              ],
              borderWidth: 1 // Border width for each bar
          }]
      },
      options: {
          responsive: true, // Makes the chart responsive
          plugins: {
              legend: {
                  display: true, // Display the legend
                  position: 'top' // Legend position
              }
          },
          scales: {
              y: {
                  beginAtZero: true // Ensures the y-axis starts at 0
              }
          }
      }
  });
  