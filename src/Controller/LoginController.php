<?php

namespace App\Controller;

class LoginController extends Controller
{
    public function show()
    {
        return $this->render('login/index.twig');
        
    }
}

