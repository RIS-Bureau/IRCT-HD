<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //La Vue Accueil
    public function home()
    {
        return view('home.accueil');
    }
    //La Vue A propos
    public function a_propos()
    {
        return view('home.a-propos');
    }
    //La Vue ajout centre
    public function ajout_centre()
    {
        return view('home.ajout-centre');
    }
    //La Vue A ajout patient
    public function ajout_patient()
    {
        return view('home.ajout-patient');
    }
    //La Vue A remplir fiche
    public function remplir_fiche()
    {
        return view('home.remplir-fiche-patient');
    }
    //La Vue Dashboad
    public function dashboad()
    {
        return view('home.dashboard');
    }
}
