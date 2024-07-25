<div class="w-full h-full p-4 bg-amber-50 rounded-lg shadow-md">
    <h2 class="flex justify-center items-center text-2xl font-bold mb-4 text-center text-slate-600">本日の総摂取量</h2>
    <div class="h-72 m-2 p-2 text-xl space-y-4 text-gray-900 grid grid-cols-3 items-center jutify-center rounded-lg">
        <div></div>
        <div class="w-full font-semibold text-gray-500 flex justify-center items-center border-b border-gray-300">摂取量</div>
        <div class="w-full font-semibold text-gray-500 flex justify-center items-center border-b border-gray-300">目標値</div>
        <p class="font-semibold flex justify-center items-center text-indigo-500 border-b border-gray-300">カロリー</p>
        <p class="{{$totalNutrition['total_calorie'] > $goal->calorie ? 'text-red-500' : 'text-emerald-500'}} border-b flex justify-center items-center border-gray-300">{{ $totalNutrition['total_calorie'] }} kcal</p>
        <p class="text-gray-500 flex justify-center items-center border-b border-gray-300">{{ $goal->calorie }}kcal</p>
        <p class="font-semibold flex justify-center items-center text-indigo-500 border-b border-gray-300">タンパク質</p>
        <p class="{{$totalNutrition['total_protein'] > $goal->protein ? 'text-red-500' : 'text-emerald-500'}} border-b flex justify-center items-center border-gray-300">{{ $totalNutrition['total_protein'] }} g</p>
        <p class="text-gray-500 flex justify-center items-center border-b border-gray-300">{{ $goal->protein }}g</p>
        <p class="font-semibold flex justify-center items-center text-indigo-500 border-b border-gray-300">脂質</p>
        <p class="{{$totalNutrition['total_fat'] > $goal->fat ? 'text-red-500' : 'text-emerald-500'}} border-b flex justify-center items-center border-gray-300">{{ $totalNutrition['total_fat'] }} g</p>
        <p class="text-gray-500 flex justify-center items-center border-b border-gray-300">{{ $goal->fat }}g</p>
        <p class="font-semibold flex justify-center items-center text-indigo-500 border-b border-gray-300">炭水化物</p>
        <p class="{{$totalNutrition['total_carbohydrate'] > $goal->carbohydrate ? 'text-red-500' : 'text-emerald-500'}} border-b flex justify-center items-center border-gray-300">{{ $totalNutrition['total_carbohydrate'] }} g</p>
        <p class="text-gray-500 flex justify-center items-center border-b border-gray-300">{{ $goal->carbohydrate }}g</p>
    </div>
</div>
