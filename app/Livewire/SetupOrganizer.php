<?php

namespace App\Livewire;

use App\Models\Organizer;
use App\Models\Wallet;
use Livewire\Component;
use Livewire\WithFileUploads;

class SetupOrganizer extends Component
{
    use WithFileUploads;

    public $name;

    public $image;

    public function rules()
    {
        return [
            'name' => 'required|string'
        ];
    }

    public function render()
    {
        return view('livewire.setup-organizer');
    }

    public function mount()
    {
        $user = auth()->user();
        if ($user->organizer) {
            return redirect()->route('filament.organizer.pages.dashboard', ['tenant' => $user->organizer->id]);
        }
    }

    public function createOrganizer()
    {
        $this->validate();
        $organizer = Organizer::firstOrCreate([
            'user_id' => auth()->id()
        ], [
            'name' => $this->name,
            'user_id' => auth()->id()
        ]);
        $wallet = Wallet::firstOrCreate([
            'organizer_id' => $organizer->id
        ]);

        if ($organizer) {
            return redirect()->route('filament.organizer.pages.dashboard', ['tenant' => $organizer->id]);
        }
    }
}
