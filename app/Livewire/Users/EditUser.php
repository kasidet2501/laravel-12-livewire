<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\Users\UserForm;
use App\Models\UserInfo;
use Barryvdh\Debugbar\Facades\Debugbar;


class EditUser extends Component
{
    use WithFileUploads;

    public userForm $form;
    public $userId;

    public function mount($id)
    {
        $this->userId = $id;

        // ค้นหา UserInfo จาก ID
        $user = UserInfo::findOrFail($id);

        Debugbar::info([
            'route_id' => $id,
            'user_info' => $user
        ]);

        $this->form->setUser($user);
    }
    public function updateUser()
    {
        $this->form->updateUser();
        return redirect()->route("users");
    }
    public function render()
    {
        return view('livewire.users.edit-user');
    }
}
