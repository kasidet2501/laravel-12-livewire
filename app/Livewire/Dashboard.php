<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserInfo;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $totalUsers;
    public $usersByAge;
    public $ageGroups;

    // Transaction statistics
    public $totalIncome;
    public $totalExpense;
    public $balance;
    public $totalTransactions;

    public function mount()
    {
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $this->totalUsers = UserInfo::count();

        $this->ageGroups = UserInfo::select(
            DB::raw('CASE
                WHEN age BETWEEN 0 AND 18 THEN "0-18 ปี"
                WHEN age BETWEEN 19 AND 30 THEN "19-30 ปี"
                WHEN age BETWEEN 31 AND 45 THEN "31-45 ปี"
                WHEN age BETWEEN 46 AND 60 THEN "46-60 ปี"
                WHEN age > 60 THEN "60+ ปี"
                ELSE "ไม่ระบุ"
            END as age_group'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('age_group')
        ->orderBy('age_group')
        ->get();

        $this->usersByAge = UserInfo::select('age', DB::raw('COUNT(*) as count'))
            ->groupBy('age')
            ->orderBy('age')
            ->get();

        // Transaction statistics
        $this->totalIncome = Transaction::where('type', 'income')->sum('amount');
        $this->totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $this->balance = $this->totalIncome - $this->totalExpense;
        $this->totalTransactions = Transaction::count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
