<?php

namespace App\Livewire\Administration\Users;

use Livewire\Component;
use App\Services\InviteUser as InviteUserService;
use Masmerise\Toaster\Toaster;

class InviteUser extends Component
{
    public function render()
    {
        return view('livewire.administration.users.invite-user');
    }

    public function store(): void
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        (new InviteUserService(
            user: $this->user,
            email: $this->email,
        ))->execute();

        Toaster::success(__('User invited'));

        $this->reset('email');
    }
}
