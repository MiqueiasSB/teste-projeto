<?php

namespace App\Http\Middleware;

use App\Http\Controllers\RedirectController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next) {
       
        // Utilize a senha como necessário
        // Por exemplo:
    
        if(!is_null(Auth::user())){
            if (Auth::user()->id == 1) {
                // Senha correta, continue com o fluxo normal
                return $next($request);
            } else {
                // Senha incorreta, retorne uma resposta de erro ou redirecione
                return redirect()->back()->withErrors(['senha' => 'Senha incorreta']);
            }
        }else {
            // Senha incorreta, retorne uma resposta de erro ou redirecione
            return redirect()->back()->withErrors(['senha' => 'Senha incorreta']);
        }
        
    }
}
