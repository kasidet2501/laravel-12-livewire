<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $search = '';
    public $sortBy = 'age';
    public $sortDirection = 'asc';


    public function sortByField($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteUser($userId)
    {
        $user = UserInfo::findOrFail($userId);

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }
        $user->delete();
    }

    public function render()
    {
        $query = UserInfo::query();

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%')
                  ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->orderBy($this->sortBy, $this->sortDirection)->get();

        return view('livewire.users.index', compact("users"));
    }
}
