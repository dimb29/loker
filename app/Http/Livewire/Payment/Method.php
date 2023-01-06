<?php

namespace App\Http\Livewire\Payment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\PayMethod;
use App\Models\Payment;
use Xendit\Xendit;
use Carbon\Carbon;

class Method extends Component
{
    public $getprice,$price,$bank_code;
    private $token = 'xnd_development_eQeP7zD1dFjXz26hqpuqU4ZbSrdxAgcoYXW0BHYXYx0CE6wW04piVi3nnGCCGU';
    public function mount($id){
        $this->getprice = PayMethod::where('method', '=', $id)->first();
        // dd($getprice);
    }
    public function render()
    {
        Xendit::setApiKey($this->token);
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        // return response()->json([
        //     'data' => $getVABanks
        // ])->setStatusCode(200);
        // dd(count($getVABanks));
        return view('livewire.payment.method',[
            'databank' => $getVABanks
        ]);
    }

    public function createVa(){
        $this->validate([
            'bank_code' => 'required',
        ]);
        if(Auth::guard('employer')->user() != null){
            $getmypay = Payment::where('user_id', Auth::guard('employer')->user()->id)->orderBy('updated_at', 'DESC')->first();
            // dd($getmypay->status);
        }else{
            return redirect('employer/login');
        }
        if(is_null($getmypay) || $getmypay->status == 2){
    
                Xendit::setApiKey($this->token);
                $external_id = 'va-post-'.time();
                // dd($this->bank_code);
                $params = ["external_id" => $external_id,
                    "bank_code" => $this->bank_code,
                    "name" => Auth::guard('employer')->user()->name,
                    "expected_amount" => $this->getprice->price+4500,
                    "is_closed" => true,
                    "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
                    "is_single_use" => true,
                ];
        
                $insert = Payment::insert([
                    'external_id' => $external_id,
                    'payment_channel' => 'Virtual Account',
                    'email' => Auth::guard('employer')->user()->email,
                    'price' => $this->getprice->price,
                    'user_id' => Auth::guard('employer')->user()->id,
                    'bank_code' =>  $this->bank_code,
                    "expiration_date" => Carbon::now()->addDays(1),
                    'admin_fee' =>  4500,
        
                ]);
                // dd($params);
        
                $createVA = \Xendit\VirtualAccounts::create($params);
                session()->flash('message', 'virtual account berhasil dibuat. Tunggu sebentar..');
                sleep(2);
                $return = redirect("/dashboard/payment/payon");
                return $return;
            }else{
                session()->flash('message', 'Anda sudah memiliki virtual account.');
            }
    }
}
