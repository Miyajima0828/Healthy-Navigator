<div class="w-full h-full mt-4 px-2 bg-amber-50 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center my-4 text-slate-600">今週の達成率</h2>
    <div class="w-4/5 m-auto grid grid-cols-3 items-center">
        <div></div>
        <div class="w-full font-semibold text-gray-500 flex justify-center items-center border-b border-gray-300">今週の摂取量</div>
        <div class="w-full font-semibold text-gray-500 flex justify-center items-center border-b border-gray-300">1週間の目標値</div>
        <p class="font-semibold flex justify-center items-center text-indigo-500 border-b border-gray-300">カロリー</p>
        <p class="{{$weeklyNutrient['calorie'] > $weeklyGoal['calorie'] ? 'text-red-500' : 'text-emerald-500'}} border-b flex justify-center items-center border-gray-300">{{ $weeklyNutrient['calorie'] }} kcal</p>
        <p class="text-gray-500 flex justify-center items-center border-b border-gray-300">{{ $weeklyGoal['calorie'] }} kcal</p>
        <p class="font-semibold flex justify-center items-center text-indigo-500 border-b border-gray-300">タンパク質</p>
        <p class="{{$weeklyNutrient['protein'] > $weeklyGoal['protein'] ? 'text-red-500' : 'text-emerald-500'}} border-b flex justify-center items-center border-gray-300">{{ $weeklyNutrient['protein'] }} g</p>
        <p class="text-gray-500 flex justify-center items-center border-b border-gray-300">{{ $weeklyGoal['protein'] }} g</p>
        <p class="font-semibold flex justify-center items-center text-indigo-500 border-b border-gray-300">脂質</p>
        <p class="{{$weeklyNutrient['fat'] > $weeklyGoal['fat'] ? 'text-red-500' : 'text-emerald-500'}} border-b flex justify-center items-center border-gray-300">{{ $weeklyNutrient['fat'] }} g</p>
        <p class="text-gray-500 flex justify-center items-center border-b border-gray-300">{{ $weeklyGoal['fat'] }} g</p>
        <p class="font-semibold flex justify-center items-center text-indigo-500 border-b border-gray-300">炭水化物</p>
        <p class="{{$weeklyNutrient['carbohydrate'] > $weeklyGoal['carbohydrate'] ? 'text-red-500' : 'text-emerald-500'}} border-b flex justify-center items-center border-gray-300">{{ $weeklyNutrient['carbohydrate'] }} g</p>
        <p class="text-gray-500 flex justify-center items-center border-b border-gray-300">{{ $weeklyGoal['carbohydrate'] }} g</p>
    </div>
    <div class="h-64 flex justify-center items-center">
        <canvas id="weeklyAchievementChart"></canvas>
        <script>
            const weeklyAchievementChartCtx = document.getElementById('weeklyAchievementChart').getContext('2d');
            const weeklyAchievementChart = new Chart(weeklyAchievementChartCtx, {
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
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</div>
