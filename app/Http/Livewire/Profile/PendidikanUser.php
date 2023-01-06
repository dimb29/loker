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
use App\Models\PendidikanUser as PendikUser;
use App\Models\BidangStudi;
use App\Models\KualifikasiLulus;

class PendidikanUser extends Component
{
    public $company,$grad_date,$fos,$country,$kualif,$kualifs,$typescore,$score,$fromscore,$desc,$pendidikan_id;
    public $isEdits = 0, $isDelete = 0,$penduserid, $isScore = 0;

    public function mount(){
        $userId = Auth::user()->id;
        $get_penusers = PendikUser::with(['bidangstudi','kualifikasilulus'])->where('user_id', $userId)->get();
        $this->get_penusers = $get_penusers;
        $bidstd_arr = BidangStudi::all();
        $this->bidstd_arr = $bidstd_arr;
        $kualifs = KualifikasiLulus::all();
        $this->kualifs = $kualifs;
    }

    public function render()
    {
        $userId = Auth::user()->id;
        // $get_typescore = PendikUser::where(['user_id' => $userId, 'type_score' => $this->typescore])->first();
        if($this->typescore == 1){
            $this->isScore = true;
        }else{
            $this->isScore = false;
        }

        return view('livewire.profile.pendidikan-user');

    }

    public function store(){
        $this->validate([
            'company'       => 'required|string|min:3|max:50',
            'grad_date'    => 'required|string|max:10',
            'kualif'    => 'required|string|max:3',
            'fos'           => 'required|string|max:3',
            'major'           => 'required|string|max:50',
            'country'       => 'required|string|max:35',
            'typescore'        => 'string|max:3',
            'score'        => 'string|max:10',
            'fromscore'        => 'string|max:10',
            'desc'          => 'string|max:255',
        ]);
        // dd($this->kualif);
        $post_pengalaman = PendikUser::updateOrCreate(['id' => $this->pendidikan_id],[
            'name'          => $this->company,
            'graduation_date'    => $this->grad_date,
            'qualification'    => $this->kualif,
            'fos'           => $this->fos,
            'country'       => $this->country,
            'major'        => $this->major,
            'type_score'      => $this->typescore,
            'final_score'      => $this->score,
            'from_score'      => $this->fromscore,
            'description'   => $this->desc,
            'user_id'   => Auth::user()->id,
        ]);
        // dd($this->work_end);
        if(is_null($this->pendidikan_id)){
            session()->flash('message', 'data berhasil ditambahkan.');
        }else{
            session()->flash('message', 'data berhasil diperbarui.');
        }
        $this->isScore = false;
        return redirect()->to('/user/pendidikan');

    }
    public function create(){
        $this->resetinputfield();
        $this->isEdits = true;
    }

    public function openEdit($id){
        $pendikUser = PendikUser::with(['bidangstudi','kualifikasilulus'])->where('id', $id)->first();
        // dd($pendikUser->specialist);
        $this->pendidikan_id = $id;
        $this->company = $pendikUser->name;
        $this->grad_date = $pendikUser->graduation_date;
        $this->kualif = $pendikUser->qualification;
        $this->fos = $pendikUser->fos;
        $this->country = $pendikUser->country;
        $this->major = $pendikUser->major;
        $this->typescore = $pendikUser->type_score;
        $this->score = $pendikUser->final_score;
        $this->fromscore = $pendikUser->from_score;
        $this->desc = $pendikUser->description;
        $this->isEdits = true;
    }
    public function delete(){
        $delete_pendidikan = PendikUser::where('id',$this->penduserid)->delete();
        $this->closeDelete();
        session()->flash('message', 'data berhasil dihapus.');
        return redirect()->to('/user/pendidikan');
    }
    public function closeEdit(){
        $this->isEdits = false;
    }
    public function openDelete($id){
        $this->penduserid = $id;
        $this->isDelete = true;
    }
    public function closeDelete(){
        $this->isDelete = false;
    }

    public function resetinputfield(){
        $this->pendidikan_id = null;
        $this->company = null;
        $this->grad_date = null;
        $this->kualif = null;
        $this->fos = null;
        $this->country = null;
        $this->major = null;
        $this->typescore = null;
        $this->score = null;
        $this->fromscore = null;
        $this->desc = null;
    }
}
