<?php

declare(strict_types=1);

namespace App\Livewire\Administration\Offices;

use App\Models\Office;
use App\Services\CreateOffice;
use App\Services\DestroyOffice;
use App\Services\UpdateOffice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ManageOffices extends Component
{
    #[Locked]
    public Collection $offices;

    public bool $addMode = false;

    #[Locked]
    public int $editedOfficeId = 0;

    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    public function mount(): void
    {
        $this->offices = collect(Office::where('account_id', Auth::user()->account_id)
            ->orderBy('name')
            ->get()
            ->map(fn (Office $office): array => [
                'id' => $office->id,
                'name' => $office->name,
            ]));
    }

    public function render()
    {
        return view('livewire.administration.offices.manage-offices');
    }

    public function placeholder(): string
    {
        return <<<'HTML'
        <div>
            <div class="flex flex-col space-y-2 mb-3">
                <div class="animate-pulse bg-slate-200 h-8 w-full rounded-xl"></div>
                <div class="animate-pulse bg-slate-200 h-8 w-full rounded-xl"></div>
                <div class="animate-pulse bg-slate-200 h-8 w-full rounded-xl"></div>
            </div>
        </div>
        HTML;
    }

    public function toggleAddMode(): void
    {
        $this->addMode = ! $this->addMode;
    }

    public function store(): void
    {
        $this->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        $office = (new CreateOffice(
            user: Auth::user(),
            name: $this->name,
        ))->execute();

        Toaster::success(__('Office created'));

        $this->toggleAddMode();
        $this->reset('name');

        $this->offices->push([
            'id' => $office->id,
            'name' => $office->name,
        ]);
    }

    public function toggleEditMode(int $officeId): void
    {
        $this->editedOfficeId = $officeId;

        $office = $this->offices->firstWhere('id', $officeId);
        $this->name = $office['name'];
    }

    public function update(): void
    {
        $this->validate([
            'name' => 'required|string|min:3|max:100',
        ]);

        $office = Office::where('id', $this->editedOfficeId)->first();

        $office = (new UpdateOffice(
            user: Auth::user(),
            office: $office,
            name: $this->name,
        ))->execute();

        Toaster::success(__('Office updated'));

        $office = [
            'id' => $office->id,
            'name' => $office->name,
        ];

        $this->offices = $this->offices->map(fn (array $existingOffice): array => $existingOffice['id'] === $this->editedOfficeId ? $office : $existingOffice);

        $this->resetEdit();
    }

    public function resetEdit(): void
    {
        $this->editedOfficeId = 0;
        $this->name = '';
        $this->resetErrorBag();
    }

    public function delete(int $officeId): void
    {
        $office = Office::where('id', $officeId)->first();

        (new DestroyOffice(
            user: Auth::user(),
            office: $office,
        ))->execute();

        Toaster::success(__('Office deleted'));

        $this->offices = $this->offices->reject(fn (array $office): bool => $office['id'] === $officeId);
    }
}
