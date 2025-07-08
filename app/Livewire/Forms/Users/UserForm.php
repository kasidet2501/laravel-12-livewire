<?php

namespace App\Livewire\Forms\Users;

use Carbon\Carbon;
use Illuminate\Container\Attributes\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\UserInfo;
use Barryvdh\Debugbar\Facades\Debugbar;

class UserForm extends Form
{
    public ?UserInfo $user;
    public $title = '';
    public $first_name = '';
    public $last_name = '';
    public $birthdate = '';
    public $profile_image;



    public function setUser(UserInfo $user)
    {
        $this->user = $user;
        $this->title = $user->title;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->birthdate = $user->birthdate;
    }
    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'profile_image' => ['nullable', 'image', 'max:2048']
        ];

        return $rules;
    }

    public function submit()
    {
        $data = $this->validate();
        $data['age'] = Carbon::parse($this->birthdate)->age;
        $data['profile_image'] = $this->profile_image->store('profile_images', 'public');
        Debugbar::info($data);
        UserInfo::create($data);
        return redirect()->route('users');
    }

    public function updateUser()
    {
        $data = $this->validate();
        $data['age'] = Carbon::parse($this->birthdate)->age;

        if ($this->profile_image) {
            if ($this->user->profile_image) {
                \Storage::disk("public")->delete($this->user->profile_image);
            }
            $data['profile_image'] = $this->profile_image->store('profile_images', 'public');
        } else {
            unset($data['profile_image']);
        }

        $this->user->update($data);

        Debugbar::info(['updated_data' => $data]);
        session()->flash('message', 'User updated successfully!');
    }

}
