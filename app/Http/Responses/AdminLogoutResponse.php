<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\LogoutResponse;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class AdminLogoutResponse implements LogoutResponse
{
    public function toResponse($request): RedirectResponse | Redirector
    {
        return redirect()->to('/');
    }
}
