// public/js/stats.js
document.addEventListener('DOMContentLoaded', function () {
    // Exercise chart (line with two datasets)
    const exCanvas = document.getElementById('exerciseChart');
    if (exCanvas) {
        const labels = JSON.parse(exCanvas.dataset.labels);
        const volume = JSON.parse(exCanvas.dataset.volume);
        const duration = JSON.parse(exCanvas.dataset.duration);

        new Chart(exCanvas, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Volume (kg×rep)',
                        data: volume,
                        borderColor: '#60a5fa',
                        backgroundColor: 'rgba(96,165,250,0.12)',
                        tension: 0.3,
                        yAxisID: 'y1',
                        fill: true,
                        pointRadius: 2
                    },
                    {
                        label: 'Durée (h)',
                        data: duration,
                        borderColor: '#6ee7b7',
                        backgroundColor: 'rgba(110,231,183,0.12)',
                        tension: 0.3,
                        yAxisID: 'y2',
                        fill: true,
                        pointRadius: 2
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: { mode: 'index', intersect: false },
                scales: {
                    y1: {
                        type: 'linear',
                        position: 'left',
                        ticks: { color: '#ccc' },
                        title: { display: true, text: 'Volume', color: '#ccc' }
                    },
                    y2: {
                        type: 'linear',
                        position: 'right',
                        ticks: { color: '#ccc' },
                        grid: { drawOnChartArea: false },
                        title: { display: true, text: 'Heures', color: '#ccc' }
                    },
                    x: { ticks: { color: '#ccc' } }
                },
                plugins: { legend: { position: 'top', labels: { color: '#eee' } } }
            }
        });
    }

    // Weekly chart (bar)
    const wCanvas = document.getElementById('weeklyChart');
    if (wCanvas) {
        const labels = JSON.parse(wCanvas.dataset.labels);
        const values = JSON.parse(wCanvas.dataset.values);

        new Chart(wCanvas, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Volume (kg×rep)',
                    data: values,
                    backgroundColor: '#f28e2b',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                scales: { x: { ticks: { color: '#ccc' } }, y: { ticks: { color: '#ccc' } } },
                plugins: { legend: { display: false } }
            }
        });
    }
});
