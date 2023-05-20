<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class RegisterForm extends Component
{
    public string $username;

    public string $email;

    public string $password;

    public string $password_confirmation;

    protected $rules = [
        'username' => ['required', 'string', 'min:8'],
        'email' => ['required', 'email:dns', 'unique:users,email', 'string'],
        'password' => ['required', 'string', 'min:8'],
        'password_confirmation' => ['required', 'same:password'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.register-form');
    }
}
