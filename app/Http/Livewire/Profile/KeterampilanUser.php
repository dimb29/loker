<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\KeterampilanUser as KetUsers;

class KeterampilanUser extends Component
{
    public $ketuser,$level,$title,$userId,$ket_id,$id_del;
    public $isOpen = 0, $isDelete = 0;
    public function render()
    {
        $this->userId = Auth::user()->id;
        $ketUser = KetUsers::where('user_id', $this->userId)->get();
        return view('livewire.profile.keterampilan-user', ['ketusers' => $ketUser]);
    }

    public function store(){
        $this->validate([
            'title' => 'required',
            'level' => 'required',
        ]);
        // dd($this->userId);
        KetUsers::updateOrCreate(['id' => $this->ket_id], [
            'name' => $this->title,
            'level' => $this->level,
            'user_id' => $this->userId,
        ]);
        if($this->ket_id != null){
            session()->flash('message', 'Data berhasil diperbarui.');
        }else{
            session()->flash('message', 'Data berhasil dibuat.');
        }
        $this->closeCreate();
    }

    public function  edit($id){
        $get_post = KetUsers::where('id',$id)->first();
        // dd($get_post->level);
        $this->ket_id = $get_post->id;
        $this->title = $get_post->name;
        $this->level = $get_post->level;
        $this->openCreate();
    }

    public function delete(){

        $deldata = KetUsers::find($this->id_del)->delete();
        $this->id_del = null;
        if($deldata){
            session()->flash('message', 'Data berhasil diperbarui.');
        }else{
            session()->flash('message', 'Data gagal diperbarui.');
        }
        $this->closeDelete();

    }

    public function create(){
        $this->resetInput();
        $this->openCreate();
    }
    public function openCreate(){
        $this->isOpen = true;
    }
    public function closeCreate(){
        $this->isOpen = false;
    }
    public function openDelete($id){
        $this->id_del = $id;
        $this->isDelete = true;
    }
    public function closeDelete(){
        $this->isDelete = false;
    }

    public function resetInput(){
        $this->ket_id = null;
        $this->title = null;
        $this->level = null;
    }
}
