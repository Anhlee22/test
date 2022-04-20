<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;

class Checklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    private $user;

    public function __construct(){
        $this->user = new UserModel();
    }

    public function handle(Request $request, Closure $next)
    {   
        if(Auth::check()){
            $usname  = Auth::user()->username;
            $role = $this->user->checkrole($usname);
            if($role[0]->role === 0){
                return redirect()->route('trangchu.homePage');
            }else{
                return $next($request);
            }
        }else{
            return redirect()->route('trangchu.loginView');
        }
    }
}
