<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon compte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card">
                <h1 style="margin-left : 20px;
                           margin-top: 15px;
                           text-decoration : underline;
                           font-style: normal;
                           ">
                    Bonjour {{ Auth::user()->name }} :
                </h1>
                <div style="margin: auto; width: 50%;">
                    <h2 style="text-align: center;
                        text-decoration : underline;
                        font-style: normal;">
                        Statistique sur toutes les parties
                    </h2>
                    <canvas id="totalGames"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{--<script>--}}
{{--    const data = {--}}
{{--        labels: [--}}
{{--            'Victoires',--}}
{{--            'Défaites',--}}
{{--            'Paths',--}}
{{--            'Nulls'--}}
{{--        ],--}}
{{--        datasets: [{--}}
{{--            label: 'total Games Statistique',--}}
{{--            data: [{{$win}}, {{$lose}}, {{$path}}, {{$null}}],--}}
{{--            backgroundColor: [--}}
{{--                'rgb(0, 255, 0)',--}}
{{--                'rgb(255, 99, 132)',--}}
{{--                'rgb(54, 162, 235)',--}}
{{--                'rgb(255, 205, 86)'--}}
{{--            ],--}}
{{--            hoverOffset: 4--}}
{{--        }]--}}
{{--    };--}}

{{--    const config = {--}}
{{--        type: 'doughnut',--}}
{{--        data: data,--}}
{{--    };--}}

{{--</script>--}}
{{--<script>--}}
{{--    const myChart = new Chart(--}}
{{--        document.getElementById('totalGames'),--}}
{{--        config--}}
{{--    );--}}
{{--</script>--}}

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.js"></script>
<script type="text/javascript">
    window.onload=function(){//from  w ww  .  j a v  a  2  s.com
        var data = {
            labels: [
                'Victoires',
                'Défaites',
                'Paths',
                'Nulls'
            ],
            datasets: [
                {
                    data: [{{$win}}, {{$lose}}, {{$path}}, {{$null}}],
                    backgroundColor: [
                        'rgb(0, 255, 0)',
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
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

