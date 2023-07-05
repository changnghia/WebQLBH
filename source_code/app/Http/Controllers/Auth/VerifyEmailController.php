<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Mail;


class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }
       
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            $name = auth()->user()->name;
            $emaildangky = auth()->user()->email;
            $passdk =  $request->session()->pull('guiqua', null);;
            Mail::send('dangkythanhcong',compact('name','emaildangky','passdk'),function($email)use($emaildangky){
                $email->subject('Hoatuoi.com - Xác thực Email thành công');
                $email->to($emaildangky);
            });
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
