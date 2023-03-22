<x-app-layout>
    <div class="flex flex-col bg-gray-200 min-h-screen justify-center">
        <div
            class="flex flex-col bg-white pt-10 pb-8 sm:max-w-lg sm:min-w-[490px] sm:mx-auto px-6 sm:px-8 sm:rounded-xl shadow-xl ring-1 ring-blue-900/50">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold">Habit Tracker</h1>
                <button type="button" class="text-white bg-primary-600 px-3.5 py-2 rounded-md">New Habit</button>
            </div>
            <div class="divide-y divide-gray-300/50">
                <div class="text-base leading-7 text-gray-900">
                    <div class="flex items-center py-2.5">
                        <div class="flex flex-col basis-1/2">
                            <h1 class="text-base font-semibold">Drink Water</h1>
                            <small class="font-normal text-gray-400">1 / 3 times</small>
                        </div>
                        <div class="flex basis-1/4 justify-center p-2.5">
                            <button
                                class="text-white bg-primary-600 font-semibold text-2xl px-4 py-2 rounded-lg">+1</button>
                        </div>
                        <div x-data="{ percent: 30, circumference: 30 * 2 * Math.PI }" class="flex basis-1/4 justify-center">
                            <div class="relative inline-flex items-center justify-center overflow-hidden">
                                <div class="flex absolute inset-0 items-center justify-center text-sm font-semibold"
                                    x-text="`${percent}%`"></div>
                                <svg class="w-20 h-20 transform -rotate-90">
                                    <circle class="text-gray-300" stroke-width="6" stroke="currentColor"
                                        fill="transparent" r="30" cx="40" cy="40" />
                                    <circle class="text-primary-600" stroke-width="6" stroke="currentColor"
                                        fill="transparent" r="30" cx="40" cy="40"
                                        :stroke-dasharray="circumference"
                                        :stroke-dashoffset="circumference - ((percent) / 100 * circumference)"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
