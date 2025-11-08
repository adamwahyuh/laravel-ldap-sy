<?php

namespace App\Http\Controllers;

use App\Ldap\Person;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $people = Person::get();
        // dd($people);
        return view('welcome', compact('people'));
    }

}
