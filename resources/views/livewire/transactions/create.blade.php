<section class="w-full max-w-4xl mx-auto px-4 py-6">
    <x-page-heading>
        <x-slot:title>{{ isset($id) ? 'Edit' : 'Add' }} Transaction</x-slot:title>
        <x-slot:subtitle>
            {{ isset($id) ? 'Update transaction details' : 'Create a new income or expense transaction' }}
        </x-slot:subtitle>
    </x-page-heading>

    <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 rounded-lg p-6">
        <form wire:submit="{{ isset($id) ? 'update(' . $id . ')' : 'save' }}" class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:field>
                    <flux:label>Owner</flux:label>
                    <flux:select wire:model.live="user_id">
                        <flux:select.option value="">Select owner (optional)</flux:select.option>
                        @foreach($users as $user)
                            <flux:select.option value="{{ $user->id }}">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    @error('user_id')
                        <flux:error>{{ $message }}</flux:error>
                    @enderror
                </flux:field>

                <flux:field>
                    <flux:label>Transaction Type</flux:label>
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <label class="relative">
                            <input
                                type="radio"
                                wire:model.live="type"
                                value="income"
                                class="sr-only peer"
                            >
                            <div class="w-full p-4 text-center border-2 rounded-lg cursor-pointer transition-all
                                peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700
                                hover:border-green-300 hover:bg-green-25">
                                <flux:icon.arrow-trending-up class="w-6 h-6 mx-auto mb-2 text-green-600" />
                                <span class="font-medium">Income</span>
                            </div>
                        </label>

                        <label class="relative">
                            <input
                                type="radio"
                                wire:model.live="type"
                                value="expense"
                                class="sr-only peer"
                            >
                            <div class="w-full p-4 text-center border-2 rounded-lg cursor-pointer transition-all
                                peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:text-red-700
                                hover:border-red-300 hover:bg-red-25">
                                <flux:icon.arrow-trending-down class="w-6 h-6 mx-auto mb-2 text-red-600" />
                                <span class="font-medium">Expense</span>
                            </div>
                        </label>
                    </div>
                    @error('type')
                        <flux:error>{{ $message }}</flux:error>
                    @enderror
                </flux:field>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <flux:field>
                    <flux:input
                        wire:model.live="amount"
                        label="Amount"
                        type="number"
                        step="0.01"
                        min="0"
                        placeholder="0.00"
                    />
                    @error('amount')
                        <flux:error>{{ $message }}</flux:error>
                    @enderror
                </flux:field>
            </div>

            <flux:field>
                <flux:input
                    wire:model.live="title"
                    label="Title"
                    placeholder="Enter transaction title"
                />
                @error('title')
                    <flux:error>{{ $message }}</flux:error>
                @enderror
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:field>
                    <flux:label>Category</flux:label>
                    <div class="space-y-3">
                        <flux:input
                            wire:model.live="category"
                            placeholder="category"
                        />
                    </div>
                    @error('category')
                        <flux:error>{{ $message }}</flux:error>
                    @enderror
                </flux:field>

                <flux:field>
                    <flux:input
                        wire:model.live="transaction_date"
                        label="Transaction Date"
                        type="date"
                    />
                    @error('transaction_date')
                        <flux:error>{{ $message }}</flux:error>
                    @enderror
                </flux:field>
            </div>

            <flux:field>
                <flux:textarea
                    wire:model.live="description"
                    label="Description (Optional)"
                    placeholder="Enter additional details about this transaction"
                    rows="3"
                />
                @error('description')
                    <flux:error>{{ $message }}</flux:error>
                @enderror
            </flux:field>


            <div class="flex gap-4 pt-4">
                <flux:button
                    type="submit"
                    variant="primary"
                    icon="check"
                    class="flex-1"
                >
                    {{ isset($id) ? 'Update Transaction' : 'Save Transaction' }}
                </flux:button>

                <flux:button
                    href="{{ route('transactions') }}"
                    variant="ghost"
                    wire:navigate
                >
                    Cancel
                </flux:button>
            </div>
        </form>
    </div>
</section>
