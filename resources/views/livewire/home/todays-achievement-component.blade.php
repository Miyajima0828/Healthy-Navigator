<div class="w-full h-full p-4 bg-amber-50 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-4 text-slate-600">今日の達成率</h2>
    <div class="h-72 flex justify-center items-center">
        @if(!$goal)
        <p class="text-gray-500">目標を設定すると表示されます</p>
        @else
        <canvas id="myChart"></canvas>
        @endif
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['カロリー', 'タンパク質', '脂質', '炭水化物'],
                    datasets: [{
                        label: '達成率',
                        data: {!! $nutrientAchievement !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.x !== null) {
                                        label += context.parsed.x + ' %';
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true,
                            min: 0,
                            max: 100,
                        }
                    }
                }
            });
        </script>
    </div>
</div>
