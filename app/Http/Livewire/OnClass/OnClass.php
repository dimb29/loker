<?php

namespace App\Http\Livewire\OnClass;

use App\Models\OnClass as OClass;
use App\Models\Employer;
use App\Models\User;
use App\Models\OnClassUser;
use App\Models\OnClassMateri;
use App\Models\OnClassUserBook;
use App\Models\Notification as Notif;
use App\Models\Regency;
use App\Models\District;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;

class OnClass extends Component
{

    public $class_id, $kelas, $isOpen = 0, $isSuccess = 0;
    public $kelas_id, $bmenu=1, $getuserbook, $getbook, $city, $province, $date_type;

    public function mount($id)
    {
        $this->class_id = $id;
        if(Auth::user()){
            $usid = $this->usid = Auth::user()->id;
        }else{
            $usid = null;
        }
        $kelas = $this->kelas = OClass::with([
            'author', 
            'images', 
            'spesialiskerja',
            'author_employer',
            'materi',
            'benefit',
        ])->find($id);
        $getuserbook = OnClassUser::where(['user_id' => $usid, 'on_class_id' => $id])->first();
        if($getuserbook):
            $this->getuserbook = $getuserbook;
        endif;
        $materi = $this->materi = OnClassMateri::where(['on_class_id' => $kelas->id])->get();
        if($kelas->kota){
            $getcity = Regency::find($kelas->kota);
            $this->city = $getcity->name;
        }
        if($kelas->provinsi){
            $getprovince = Regency::find($kelas->provinsi);
            $this->province = $getprovince->name;
        }
        if($kelas->start_date){
            if($kelas->end_date){
                $this->date_type = 2;
            }else{
                $this->date_type = 1;
            }
        }
        // dd($this->getuserbook);
    }
    
    public function render()
    {
        return view('livewire.on-class.on-class');
    }

    public function menuSelect($id){
        $this->bmenu = $id;
    }

    public function readMateri($id){
        $read = DB::connection('mysql2')->table('on_class_materi_user')->insert([
            'on_class_materi_id' => $id,
            'user_id' =>$this->usid,
        ]);
    }
}
