<?php

namespace App\Livewire\Transactions;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public function deleteTransaction($transactionId)
    {
        Transaction::findOrFail($transactionId)->delete();
        session()->flash('message', 'Transaction deleted successfully!');
    }

    public function render()
    {
        $query = Transaction::with('userInfo');



        $transactions = $query->get();

        Debugbar::info([
            'transactions' => $transactions->toJson(),
        ]);

        $totalIncome = Transaction::income()->sum('amount');
        $totalExpense = Transaction::expense()->sum('amount');
        $balance = $totalIncome - $totalExpense;


        return view('livewire.transactions.index', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
    }
}
