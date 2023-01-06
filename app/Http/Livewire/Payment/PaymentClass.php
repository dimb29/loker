<?php

namespace App\Http\Livewire\Payment;

use App\Models\OnClass;
use App\Models\PaymentClass as PayClass;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use Xendit\Xendit;
use Carbon\Carbon;

class PaymentClass extends Component
{
    public $class, $bank_code;
    private $token = 'xnd_development_eQeP7zD1dFjXz26hqpuqU4ZbSrdxAgcoYXW0BHYXYx0CE6wW04piVi3nnGCCGU';

    public function mount($id){
        $this->class = OnClass::find($id);
    }

    public function render()
    {
        return view('livewire.payment.payment-class');
    }

    public function createVa(){
        $this->validate([
            'bank_code' => 'required',
        ]);
        if(Auth::user() != null){
            $usid = Auth::user()->id;
            $usemail = Auth::user()->email;
            $usname = Auth::user()->first_name.' '.Auth::user()->last_name;
            $ustype = 'user';
            $getmypay = PayClass::where(['user_id' => $usid, 'user_type' => $ustype])->orderBy('updated_at', 'DESC')->first();
            // dd($getmypay->status);
        }elseif(Auth::guard('employer')->user()){
            $usid = Auth::guard('employer')->user()->id;
            $usemail = Auth::guard('employer')->user()->email;
            $usname = Auth::guard('employer')->user()->name;
            $ustype = 'employer';
            $getmypay = PayClass::where(['user_id' => $usid, 'user_type' => $ustype])->orderBy('updated_at', 'DESC')->first();
        }else{
            return redirect('login');
        }
        if(is_null($getmypay) || $getmypay->status == 2){
            $isready = true;
        }else{
            if($getmypay->expiration_date < now()){
                $delva = PayClass::where('id', $getmypay->id)->delete();
                $isready = true;
            }else{
                $isready = false;
                session()->flash('message', 'Anda sudah memiliki virtual account.');
            }
        }
        if($isready){
            if($this->class->price){
                Xendit::setApiKey($this->token);
                $external_id = 'va-class-'.time();
                // dd($this->bank_code);
                $params = ["external_id" => $external_id,
                    "bank_code" => $this->bank_code,
                    "name" => $usname,
                    "expected_amount" => $this->class->price,
                    "is_closed" => true,
                    "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
                    "is_single_use" => true,
                ];
            }else{
                $params = array();
            }
        
            $insert = PayClass::insert([
                'on_class_id' => $this->class->id,
                'external_id' => $external_id,
                'payment_channel' => 'Virtual Account',
                'email' => $usemail,
                'price' => $this->class->price,
                'user_id' => $usid,
                'user_type' => $ustype,
                'bank_code' =>  $this->bank_code,
                "expiration_date" => Carbon::now()->addDays(1),
                'admin_fee' =>  0,
    
            ]);
    
            $createVA = \Xendit\VirtualAccounts::create($params);
            session()->flash('message', 'virtual account berhasil dibuat. Tunggu sebentar..');
            sleep(2);
            $return = redirect("/dashboard/payment/payon");
            return $return;
        }
    }
}
