<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Employer;
use App\Models\Payment;
use App\Models\PaymentClass;
use App\Models\OnClassUser;
use Illuminate\Support\Facades\DB;
use App\Mail\OnClassMail;
use Mail;

class XenditApiController extends Controller
{
    private $token = 'xnd_development_ew1lgoBzrd7GeufsPcw9rkW5gxlDHWbODgM3k3UI7Hpd06ssIjkkAfKYEa4mQy';
 
    public function getApiVa(){
        Xendit::setApiKey($this->token);
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        return response()->json([
            'data' => $getVABanks
        ])->setStatusCode(200);
    }

    public function createVa(Request $request){
        Xendit::setApiKey($this->token);
        $external_id = 'va-'.time();
        $params = ["external_id" => $external_id,
            "bank_code" => $request->bank,
            "name" => $request->email,
            "expected_amount" => $request->price,
            "is_closed" => true,
            "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
            "is_single_use" => true,
        ];

        $insert = Payment::insert([
            'external_id' => $external_id,
            'payment_channel' => 'Virtual Account',
            'email' => $request->email,
            'price' => $request->price,
            "expiration_date" => Carbon::now()->addDays(1),

        ]);

        $createVA = \Xendit\VirtualAccounts::create($params);
        return response()->json([
            'data' => $createVA
        ])->setStatusCode(200);
    }

    public function callbackVa(Request $request){
        $xenditXCallbackToken = 'RUUSVdkanUdfo65Rp9VqfRNB8KOPFNS805o1F25Tsx5KGTET';
        $reqHeaders = getallheaders();
        $xIncomingCallbackTokenHeader = isset($reqHeaders['X-Callback-Token']) ? $reqHeaders['X-Callback-Token'] : "";
        if($xIncomingCallbackTokenHeader == null){
            // Permintaan masuk diverifikasi berasal dari Xendit
              
            // Baris ini untuk mendapatkan semua input pesan dalam format JSON teks mentah
            $rawRequestInput = file_get_contents("php://input");
            // Baris ini melakukan format input mentah menjadi array asosiatif
            $arrRequestInput = json_decode($rawRequestInput, true);
            // print_r($arrRequestInput);
            $res_id = $arrRequestInput['id'];
            $res_externalId = $arrRequestInput['external_id'];
            $res_userId = $arrRequestInput['owner_id'];
            $res_status = $arrRequestInput['status'];
            $res_vaId = $arrRequestInput['id'];
            $res_accountNum = $arrRequestInput['account_number'];
            $res_bankCode = $arrRequestInput['bank_code'];
            // $res_expired = $arrRequestInput['expiration_date'];
            // $res_paidAmount = $arrRequestInput['paid_amount'];
            // $res_paidAt = $arrRequestInput['paid_at'];
            // $res_paymentChannel = $arrRequestInput['payment_channel'];
            // $res_paymentDestination = $arrRequestInput['payment_destination'];

            // return response()->json($arrRequestInput);
          $split_exId = explode('-',$res_externalId);
        //   return response()->json($split_exId);
          $invoice_id = 'inv/'.$split_exId[0].'/'.$split_exId[1];
            // return response()->json($arrRequestInput['expiration_date']);
            if(strpos($res_externalId, 'post')){
                $payment = Payment::where('external_id', $res_externalId)->exists();
            }elseif(strpos($res_externalId, 'class')){
                $payment = PaymentClass::where('external_id', $res_externalId)->exists();
            }
            if($payment){
                if($res_status == "ACTIVE"){
                    $paydata = [
                        'status' => 1,
                        'owner_id' => $res_userId,
                        'va_id' => $res_vaId,
                        'account_number' => $res_accountNum,
                        'bank_code' => $res_bankCode,
                        'inv_id' => $invoice_id,
                    ];
                    if(strpos($res_externalId, 'post')){
                        $update = Payment::where('external_id', $res_externalId)->update($paydata);
                    }elseif(strpos($res_externalId, 'class')){
                        $update = PaymentClass::where('external_id', $res_externalId)->update($paydata);
                    }
                    if($update > 0){
                        return response()->json('OK');
                    }
                    return response()->json('Gagal');
                }
            }else{
                return response()->json([
                    'message' => 'Data tidak ada',
                ]);
            }
            // Kamu bisa menggunakan array objek diatas sebagai informasi callback yang dapat digunaka untuk melakukan pengecekan atau aktivas tertentu di aplikasi atau sistem kamu.
          
          }else{
            // Permintaan bukan dari Xendit, tolak dan buang pesan dengan HTTP status 403
            return response()->json(403);
          }
    }

    public function callbackPayment(){
        $xenditXCallbackToken = 'RUUSVdkanUdfo65Rp9VqfRNB8KOPFNS805o1F25Tsx5KGTET';
        $reqHeaders = getallheaders();
        $xIncomingCallbackTokenHeader = isset($reqHeaders['X-Callback-Token']) ? $reqHeaders['X-Callback-Token'] : "";
        if($xIncomingCallbackTokenHeader == null){
        // if($xIncomingCallbackTokenHeader === $xenditXCallbackToken){
            $rawRequestInput = file_get_contents("php://input");
            $arrRequestInput = json_decode($rawRequestInput, true);
            $res_id = $arrRequestInput['id'];
            $res_externalId = $arrRequestInput['external_id'];
            $res_userId = $arrRequestInput['owner_id'];
            // $res_paymentId = $arrRequestInput['payment_id'];
            // $res_status = $arrRequestInput['status'];
            $cb_vaid = $arrRequestInput['callback_virtual_account_id'];
            // return response()->json($arrRequestInput);
            if(strpos($res_externalId, 'post')){
                $payment = Payment::where('external_id', $res_externalId)->first();
            }elseif(strpos($res_externalId, 'class')){
                $payment = PaymentClass::where('external_id', $res_externalId)->first();
            }
            if($payment){
                if($cb_vaid){
                    if(strpos($res_externalId, 'post')){
                        $update = Payment::where('external_id', $res_externalId)->update(['status' => 2]);
                    }elseif(strpos($res_externalId, 'class')){
                        $update = PaymentClass::where('external_id', $res_externalId)->update(['status' => 2]);
                        $usid = $payment->user_id;
                        $classid = $payment->on_class_id;
                        $ustype = $payment->user_type;
                        // return response()->json(['usid' => $usid, 'classid' => $classid]);
                        $insertuserclass = DB::connection('mysql2')->table('on_class_user')->insert([
                            'on_class_id' => $classid,
                            'user_id' => $usid,
                            'user_type' => $ustype,
                        ]);
                        if($ustype == 'user'){
                            $getuser = User::where(['id' => $usid])->first();
                        }elseif($ustype == 'employer'){
                            $getuser = Employer::where('id', $usid)->first();
                        }
                        $send_mail =  Mail::to($getuser->email)->send(new OnClassMail($getuser));
                    }
                    if($update > 0){
                        return response()->json('OK');
                    }
                    return response()->json('Gagal');
                }
            }else{
                return response()->json([
                    'message' => 'Data tidak ada',
                ]);
            }
        }else{
            return response()->json(403);
          }
    }
}
