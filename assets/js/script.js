document.addEventListener('DOMContentLoaded', function () {
    // Dados para o gráfico de barras
    var barChartData = {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
            label: 'Monthly Revenue',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: [65, 59, 80, 81, 56]
        }]
    };

    // Dados para o gráfico de pizza
    var pieChartData = {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
        datasets: [{
            data: [12, 19, 3, 5, 2],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#2ECC71', '#9B59B6']
        }]
    };

    // Configuração do gráfico de barras
    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Configuração do gráfico de pizza
    var pieChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
    };

    // Obtém o contexto do canvas para cada gráfico
    var barChartCanvas = document.getElementById('barChart').getContext('2d');
    var pieChartCanvas = document.getElementById('pieChart').getContext('2d');

    // Criação dos gráficos
    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    });

    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieChartData,
        options: pieChartOptions
    });
});
