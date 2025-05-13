<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

     public function saveIntendedUrl(Request $request)
    {
        Session::put('url.intended', $request->input('intended_url'));
        return response()->json(['success' => true]);
    }
    
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Proses otentikasi pengguna
        $request->session()->regenerate(); // Regenerasi ID sesi untuk keamanan

        if($request->user()->role === 'admin') {
            return redirect('admin/dashboard/users'); // Redirect admin ke dashboard admin
        }

        if ($request->hasSession() && $request->session()->has('url.intended')) {
            $intendedUrl = Session::get('url.intended');
            Session::forget('url.intended');
            return redirect()->to($intendedUrl);
        }
    
        // Jika tidak ada URL intended (login langsung), redirect ke halaman home
        return redirect(url('/'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
    