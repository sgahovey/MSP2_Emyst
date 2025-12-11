document.addEventListener("DOMContentLoaded", () => {

    // ========= GRAPH 1 : Camembert =========

    const typesCanvas = document.getElementById("typesSeancesChart");

    if (typesCanvas) {

        const typesLabels = JSON.parse(typesCanvas.dataset.labels);
        const typesValues = JSON.parse(typesCanvas.dataset.values);

        new Chart(typesCanvas, {
            type: 'pie',
            data: {
                labels: typesLabels,
                datasets: [{
                    data: typesValues,
                    backgroundColor: [
                        '#4E79A7', '#F28E2B', '#E15759', '#76B7B2',
                        '#59A14F', '#EDC948', '#B07AA1', '#FF9DA7', '#9C755F'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false  // 👈 Cacher la légende
                    }
                }
            }
        });
    }

    // ========= GRAPH 2 : Barres hebdo =========

    const weeklyCanvas = document.getElementById("weeklyVolumeChart");

    if (weeklyCanvas) {

        new Chart(weeklyCanvas, {
            type: "bar",
            data: {
                labels: JSON.parse(weeklyCanvas.dataset.labels),
                datasets: [{
                    label: "Heures",
                    data: JSON.parse(weeklyCanvas.dataset.values),
                    backgroundColor: "#36a2eb"
                }]
            }
        });
    }
});
