<div class="w-full max-w-7xl mx-auto px-4 py-6">
    <x-page-heading>
        <x-slot:title>Dashboard</x-slot:title>
        <x-slot:subtitle>
            Members overview and statistics
        </x-slot:subtitle>
    </x-page-heading>

    <div class="flex justify-center mb-8">
        <div class="w-full max-w-2xl">
            <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 p-8">
                <div class="flex items-center">
                    <div class="p-4 rounded-full bg-blue-100 dark:bg-blue-900">
                        <flux:icon.user-group class="w-10 h-10 text-blue-600 dark:text-blue-400" />
                    </div>
                    <div class="ml-6">
                        <p class="text-lg font-medium text-gray-600 dark:text-gray-400">Total Members</p>
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">{{ number_format($totalUsers) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Summary Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Financial Overview</h2>
            <flux:button
                href="{{ route('transactions') }}"
                variant="outline"
                size="sm"
                wire:navigate
            >
                View All Transactions
            </flux:button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                        <flux:icon.arrow-trending-up class="w-8 h-8 text-green-600 dark:text-green-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Income</p>
                        <p class="text-2xl font-bold text-green-600">{{ number_format($totalIncome, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 dark:bg-red-900">
                        <flux:icon.arrow-trending-down class="w-8 h-8 text-red-600 dark:text-red-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Expense</p>
                        <p class="text-2xl font-bold text-red-600">{{ number_format($totalExpense, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                        <flux:icon.calculator class="w-8 h-8 text-blue-600 dark:text-blue-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Balance</p>
                        <p class="text-2xl font-bold {{ $balance >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ number_format($balance, 2) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                        <flux:icon.document-text class="w-8 h-8 text-purple-600 dark:text-purple-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Transactions</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalTransactions) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                <flux:icon.chart-pie class="w-5 h-5 inline mr-2" />
                Members by Age
            </h3>

            @if($usersByAge->count() > 0)
                <div class="max-h-96 overflow-y-auto space-y-3">
                    @foreach($usersByAge as $ageData)
                        @php
                            $percentage = $totalUsers > 0 ? ($ageData->count / $totalUsers) * 100 : 0;
                            $colors = [
                                'bg-blue-500', 'bg-green-500', 'bg-yellow-500',
                                'bg-purple-500', 'bg-red-500', 'bg-indigo-500',
                                'bg-pink-500', 'bg-cyan-500', 'bg-orange-500',
                                'bg-teal-500', 'bg-lime-500', 'bg-violet-500'
                            ];
                            $color = $colors[$loop->index % count($colors)];
                        @endphp
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-4 h-4 rounded {{ $color }}"></div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $ageData->age }} years old
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $ageData->count }} people
                                </span>

                            </div>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="{{ $color }} h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center py-8">No member data available</p>
            @endif
        </div>

        <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                <flux:icon.table-cells class="w-5 h-5 inline mr-2" />
                Age Report
            </h3>

            @if($usersByAge->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Age
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Number of people
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($usersByAge as $ageData)
                                @php
                                    $percentage = $totalUsers > 0 ? ($ageData->count / $totalUsers) * 100 : 0;
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $ageData->age }} years old
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $ageData->count }} people
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center py-8">No member data available</p>
            @endif
        </div>
    </div>

</div>
