<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Models\Employer;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompleteData extends Component
{
    public $usid, $first_name, $last_name, $email, $kode_referal;

    public function mount(){
        $mydata = Auth::user();
        $this->usid = $mydata->id;
        $this->first_name = $mydata->first_name;
        $this->last_name = $mydata->last_name;
        $this->email = $mydata->email;
        // $this->kode_referal = $mydata->parent_id;
    }

    public function render(){
        return view('livewire.profile.complete-data');
    }

    public function store(){
        if($this->kode_referal){
            $get_ref = User::where('referral', $this->kode_referal)->first();
            // dd($get_ref);
            if($get_ref != null){
                $refid = $get_ref->referral;
                $utype = 'afiliator';
            }else{
                $refid = null;
                $utype = null;
            }
        }else{
            $refid = null;
            $utype = 'user';
        }
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'kode_referal' => ['in:' . $refid],
        ]);
        
        $updateUser = User::updateOrCreate(['id'=> $this->usid],[
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'parent_id' => $this->kode_referal,
            'user_type' => $utype,
        ]);
        return redirect('dashboard');
        
    }
}
