<div class="overflow-hidden bg-white shadow sm:rounded-lg p-3">
    <div class="container">
        <div class="card">
            <canvas id="totalGames"></canvas>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.js"></script>
<script type="text/javascript">
    window.onload = setTimeout(
        () => {
            const data = {
                labels: [
                    'Victoires',
                    'Défaites',
                    'Pats',
                    'Nuls',
                    'En cour',
                ],
                datasets: [
                    {
                        data: [{{$win}}, {{$lose}}, {{$pat}}, {{$nul}}, {{$inStandby}}],
                        backgroundColor: [
                            'rgb(0, 255, 0)',
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(255, 205, 255)',
                        ],
                    }],
            };
            const promisedDeliveryChart = new Chart(document.getElementById('totalGames'), {
                type: 'doughnut',
                data: data,
                options: {
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
            Chart.pluginService.register({
                beforeDraw: function(chart) {
                    const width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;
                    ctx.restore();
                    const fontSize = (height / 114).toFixed(2);
                    ctx.font = fontSize + 'em sans-serif';
                    ctx.textBaseline = 'middle';
                    const text = {{$totalGames}},
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 1.8;
                    ctx.fillText(text, textX, textY);
                    ctx.save();
                },
            });
        }, 100);
</script>
