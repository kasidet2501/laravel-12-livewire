<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\UserInfo;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate('nullable|exists:users_info,id')]
    public $user_id;

    #[Validate('required|in:income,expense')]
    public $type = 'income';

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('nullable|string')]
    public $description = '';

    #[Validate('required|numeric|min:0.01')]
    public $amount = '';

    #[Validate('nullable|string|max:100')]
    public $category = '';

    #[Validate('required|date')]
    public $transaction_date = '';

    // public $predefinedCategories = [
    //     'income' => [
    //         'Salary', 'Freelance', 'Investment', 'Business', 'Gift', 'Other Income'
    //     ],
    //     'expense' => [
    //         'Food', 'Transportation', 'Entertainment', 'Shopping', 'Bills', 'Healthcare', 'Education', 'Other Expense'
    //     ]
    // ];

    public function mount($id = null)
    {
        $this->transaction_date = now()->format('Y-m-d');

        if ($id) {
            $transaction = Transaction::findOrFail($id);
            $this->user_id = $transaction->user_id;
            $this->type = $transaction->type;
            $this->title = $transaction->title;
            $this->description = $transaction->description;
            $this->amount = $transaction->amount;
            $this->category = $transaction->category;
            $this->transaction_date = $transaction->transaction_date;
        }
    }

    public function save()
    {
        $validated = $this->validate();
        $validated['user_id'] = (int)$this->user_id;
        Transaction::create($validated);

        session()->flash('message', 'Transaction saved successfully!');
        return redirect()->route('transactions');
    }

    public function update($id)
    {
        $validated = $this->validate();

        $transaction = Transaction::findOrFail($id);
        $transaction->update($validated);

        session()->flash('message', 'Transaction updated successfully!');
        return redirect()->route('transactions');
    }

    public function render()
    {
        $users = UserInfo::select('id', 'first_name', 'last_name')->orderBy('first_name')->get();

        return view('livewire.transactions.create', compact('users'));
    }
}
