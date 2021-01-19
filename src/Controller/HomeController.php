<?php

namespace App\Controller;

class HomeController extends Controller
{
    public function show()
    {
        return $this->render('home/index.twig');
    }
}