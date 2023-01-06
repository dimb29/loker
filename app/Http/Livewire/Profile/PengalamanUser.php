<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PengalamanUser as PengUser;
use App\Models\SpesialisKerja;
use App\Models\BidangKerja;
use App\Models\TingkatKerja;

class PengalamanUser extends Component
{
    public $position_name,$company,$work_start,$work_end,$position,$specialist,$specialists,$fow,$country,$province,$city,$salary,$currency,$desc,$dataspesiaisluser,$pengalaman_id;
    public $isEdits = 0, $isDelete = 0,$penguserid;
    // protected $listeners = [
    //     'specialist'
    // ];
    // public function specialist($id){
    //     $tspesial = $id;
    //     if($tspesial != null){
    //         $getbidker = SpesialisKerja::with('bidangkerja')->where('id', $tspesial)->first();
    //         // dd($getbidker);
    //         $this->bidker_arr = $getbidker->bidangkerja;
    //     }
    // }
    public function mount(){
        $userId = Auth::user()->id;
        $get_penusers = PengUser::with(['spesialiskerja','bidangkerja','tingkatkerja'])->where('user_id', $userId)->get();
        $this->get_penusers = $get_penusers;
        $spesialists = SpesialisKerja::all();
        $this->spesialists = $spesialists;
        $bidker_arr = BidangKerja::all();
        $this->bidker_arr = $bidker_arr;
        $tingker_arr = TingkatKerja::all();
        $this->tingker_arr = $tingker_arr;
    }
    public function render()
    {
        $userId = Auth::user()->id;
        $pengUser = PengUser::with('spesialiskerja')->where('user_id', $userId)->first();
        // dd($this->currency);
        if($this->specialist != null && strlen($this->specialist) <= 3){
            $getbidker = SpesialisKerja::with('bidangkerja')->where('id', $this->specialist)->first();
            // dd($getbidker->bidangkerja);
            $this->bidker_arr = $getbidker->bidangkerja;
        }
        return view('livewire.profile.pengalaman-user');

    }

    public function store(){
        // $cobainject = array(['data1', ''.dd($this->position_name).'']);
        $this->validate([
            'position_name' => 'required|string|min:3|max:50',
            'company'       => 'required|string|min:3|max:50',
            'work_start'    => 'required|string|max:10',
            // 'work_end'      => 'string|max:10',
            'specialist'    => 'required|required|string|max:3',
            'fow'           => 'required|string|max:3',
            'tingker'       => 'required|string|max:3',
            'country'       => 'required|string|max:35',
            'province'      => 'required|string|max:50',
            'city'          => 'required|string|max:50',
            'salary'        => 'numeric|max:999999999',
            'currency'      => 'string|max:5',
            'desc'          => 'string|max:255',
        ]);
        // dd($this->position_name);
        $post_pengalaman = PengUser::updateOrCreate(['id' => $this->pengalaman_id],[
            'name'          => $this->position_name,
            'company_name'  => $this->company,
            'work_start'    => $this->work_start,
            'work_end'      => $this->work_end,
            'specialist'    => $this->specialist,
            'fow'           => $this->fow,
            'country'       => $this->country,
            'province'      => $this->province,
            'city'          => $this->city,
            'salary'        => $this->salary,
            'currency'      => $this->currency,
            'description'   => $this->desc,
            'position'   => $this->tingker,
            'user_id'   => Auth::user()->id,
        ]);
        // dd($this->work_end);
        if(is_null($this->pengalaman_id)){
            session()->flash('message', 'data berhasil ditambahkan.');
        }else{
            session()->flash('message', 'data berhasil diperbarui.');
        }
        return redirect()->to('/user/pengalaman');

    }
    public function create(){
        $this->resetinputfield();
        $this->isEdits = true;
    }

    public function openEdit($id){
        $pengUser = PengUser::with('spesialiskerja')->where('id', $id)->first();
        // dd($pengUser->specialist);
        $this->pengalaman_id = $id;
        $this->position_name = $pengUser->name;
        $this->company = $pengUser->company_name;
        $this->work_start = $pengUser->work_start;
        $this->work_end = $pengUser->work_end;
        // $this->position = $pengUser->name;
        $this->specialist = $pengUser->specialist;
        $this->tingker = $pengUser->position;
        $this->fow = $pengUser->fow;
        $this->country = $pengUser->country;
        $this->province = $pengUser->province;
        $this->city = $pengUser->city;
        $this->salary = $pengUser->salary;
        $this->currency = $pengUser->currency;
        $this->desc = $pengUser->description;
        $this->isEdits = true;
    }
    public function delete(){
        $delete_pengalaman = PengUser::where('id',$this->penguserid)->delete();
        $this->closeDelete();
        session()->flash('message', 'data berhasil dihapus.');
        return redirect()->to('/user/pengalaman');
    }
    public function closeEdit(){
        $this->isEdits = false;
    }
    public function openDelete($id){
        $this->penguserid = $id;
        $this->isDelete = true;
    }
    public function closeDelete(){
        $this->isDelete = false;
    }

    public function resetinputfield(){
        $this->pengalaman_id = null;
        $this->position_name = null;
        $this->company = null;
        $this->work_start = null;
        $this->work_end = null;
        // $this->position = $pengUser->name;
        $this->specialist = null;
        $this->tingker = null;
        $this->fow = null;
        $this->country = null;
        $this->province = null;
        $this->city = null;
        $this->salary = null;
        $this->currency = null;
        $this->desc = null;
    }
}
