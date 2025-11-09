<?php

namespace App\Livewire;

use App\Enums\LinkStatus;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.clean')]
class UpdateEmail extends Component
{
    public $password;

    public $url;

    public function mount(Request $request)
    {
        $this->url = $request->fullUrl();
        session(['new_email' => $request->email]);
    }

    public function rules(): array
    {
        return [
            'password' => 'required|string'
        ];
    }
    public function render()
    {
        return view('livewire.update-email');
    }

    public function updateEmail()
    {
        $this->validate();
        $link = Link::where('link', $this->url)->first();
        if ($link) {
            if (! Hash::check($this->password, auth()->user()->password)) {
                return $this->addError('password', 'Invalid Credential');
            }
            $user = auth()->user();
            $user->email = session('new_email');
            $user->email_verified_at = now();
            $user->save();
            session()->forget(['new_email']);
            $link->status = LinkStatus::REVOKED;
            $link->save();
            return redirect()->route('user.profile.setting');
        }
        abort(403, 'Invalid Link Or Expired');
    }
}
