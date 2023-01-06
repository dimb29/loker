<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Models\Employer;

class ProfilEmployer extends Controller
{
    public function render(){
        
    return view('profile.employer.show');

    }
}
