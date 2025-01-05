<?php

namespace App\Livewire\Administration\Security;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Locked;

class ManageTwoFactorAuthentication extends Component
{
    #[Locked]
    public int $userId;

    #[Locked]
    public User $user;

    public function mount(): void
    {
        $this->user = User::find($this->userId);
    }

    public function render()
    {
        return view('livewire.administration.security.manage-two-factor-authentication');
    }
}
