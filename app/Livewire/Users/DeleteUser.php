<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Storage;

class DeleteUser extends Component
{
    public $userId;
    public $user;

    public function mount($id)
    {
        $this->userId = $id;
        $this->user = UserInfo::findOrFail($id);
    }

    public function deleteUser()
    {
        if ($this->user->profile_image) {
            Storage::disk('public')->delete($this->user->profile_image);
        }

        $this->user->delete();

        session()->flash('message', 'User deleted successfully!');

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.users.delete-user');
    }
}
