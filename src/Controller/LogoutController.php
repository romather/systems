<?php

namespace App\Controller;

class LogoutController 
{
    public function logout()
    {
        if (!Auth::isLoggedIn()) {
            Redirect::to('home');
        }
        
        Auth::logout();
    }
}