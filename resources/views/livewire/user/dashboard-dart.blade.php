<div class="overflow-hidden bg-white shadow sm:rounded-lg p-3">
    <div class="container">
        <div class="card">
            <canvas id="totalScore"></canvas>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.onload = setTimeout(
        () => {
            const data = {
                labels: [@foreach($scoreHistoryLabels as $date) '{{$date}}', @endforeach],
                // ['ada','aze','ar',"aze"],
                datasets: [
                    {
                        data: {{json_encode(array_values($scoreHistoryValues))}},
                        backgroundColor: [
                        ],
                    }],
            };
            new Chart(document.getElementById('totalScore'), {
                type: 'line',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    responsive: true,
                    legend: {
                        labels: {
                            generateLabels: (chart) => {
                                const datasets = chart.data.datasets;
                                return datasets[0].data.map((data, i) => ({
                                    text: `${chart.data.labels[i]}: ${data}`,
                                    fillStyle: datasets[0].backgroundColor[i],
                                }));
                            },
                        },
                    },
                },
            });
        }, 100);
</script>

