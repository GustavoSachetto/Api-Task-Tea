<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class EmailVerificationController extends Controller
{
    /**
     * Handle the email verification request.
     */
    public function verify(Request $request, int $id, string $hash): RedirectResponse
    {
        $user = \App\Models\User::findOrFail($id);
    
        if (!URL::hasValidSignature($request)) 
            return redirect('emailchecked')->with('status', 'URL de verificação inválida.');
        
        if ($user->hasVerifiedEmail()) 
            return redirect('emailchecked')->with('status', 'E-mail já verificado.');
            
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            $user->status = true;
            $user->save();

            return redirect('emailchecked')->with('status', 'E-mail verificado com sucesso :).');
        }
    
        return redirect('emailchecked')->with('status', null);
    }
}
