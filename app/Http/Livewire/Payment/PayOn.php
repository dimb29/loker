<?php

namespace App\Http\Livewire\Payment;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\PaymentClass;

class PayOn extends Component
{
    public function render()
    {   
        if(Auth::guard('employer')->user()){
            $usid = Auth::guard('employer')->user()->id;
        }elseif(Auth::user()){
            $usid = Auth::user()->id;
        }
        $tagihan = Payment::where('user_id', '=', $usid)->orderBy('updated_at', 'DESC')->first();
        if(!$tagihan){
            $tagihan = PaymentClass::where('user_id', '=', $usid)->orderBy('updated_at', 'DESC')->first();
        }
        // dd($tagihan);
        return view('livewire.payment.pay-on',['tagihan' => $tagihan]);
    }
}
