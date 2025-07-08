<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\Users\UserForm;

class CreateUser extends Component
{
    use WithFileUploads;
    public UserForm $form;

    public function saveUser()
    {
        $this->form->rules();
        $this->form->submit();
    }

    public function render()
    {
        return view('livewire.users.create-user');
    }
}
