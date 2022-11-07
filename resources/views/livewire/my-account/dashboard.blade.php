<div class="py-12">
    <div class="container" >
        <div class="card">
            <canvas id="totalGames"></canvas>
            @dump('aa')
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.js"></script>
<script type="text/javascript">
    window.onload=function(){//from  w ww  .  j a v  a  2  s.com
        var data = {
            labels: [
                'Victoires',
                'Défaites',
                'Paths',
                'Nulls',
                'En attente'
            ],
            datasets: [
                {
                    data: [{{$win}}, {{$lose}}, {{$path}}, {{$null}}],
                    backgroundColor: [
                        'rgb(0, 255, 0)',
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 255)'
                    ]
                }]
        };
        var promisedDeliveryChart = new Chart(document.getElementById('totalGames'), {
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
                            }))
                        }
                    }
                }
            }
        });
        Chart.pluginService.register({
            beforeDraw: function(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 114).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";
                var text = {{$totalGames}},
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 1.8;
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        });
    }
</script>
