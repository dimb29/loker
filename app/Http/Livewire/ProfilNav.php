<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Regency;
use Carbon\Carbon;

class ProfilNav extends Component
{
    public $locations;



    public function render()
    {



        return view('livewire.profil-nav');
    }
}
 