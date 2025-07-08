<section class="w-full max-w-7xl mx-auto px-4 py-6">

    <x-page-heading>
        <x-slot:title>Income & Expense</x-slot:title>
        <x-slot:subtitle>
            Manage your income and expense transactions
        </x-slot:subtitle>
        <x-slot:buttons>
            <flux:button href="{{ route('transactions.create') }}" variant="primary" icon="plus">
                Add Transaction
            </flux:button>
        </x-slot:buttons>
    </x-page-heading>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
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
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Transactions</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $transactions->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50 dark:bg-gray-700 border-b border-black">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Owner</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $transaction->transaction_date->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $transaction->type === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($transaction->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            @if($transaction->userInfo)
                                <div class="text-blue-600 dark:text-blue-400 font-medium">
                                    {{ $transaction->userInfo->first_name }} {{ $transaction->userInfo->last_name }}
                                </div>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                            <div class="font-medium">{{ $transaction->title }}</div>
                            @if($transaction->description)
                                <div class="text-gray-500 dark:text-gray-400 text-xs">{{ $transaction->description }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $transaction->category ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium
                            {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->type === 'income' ? '+' : '-' }}{{ number_format($transaction->amount, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            {{-- <flux:button
                                size="sm"
                                variant="ghost"
                                href="{{ route('transactions.edit', $transaction->id) }}"
                                wire:navigate
                            >
                                Edit
                            </flux:button> --}}
                            <flux:button
                                size="sm"
                                variant="danger"
                                wire:click="deleteTransaction({{ $transaction->id }})"
                                wire:confirm="Are you sure you want to delete this transaction?"
                            >
                                Delete
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No transactions.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
