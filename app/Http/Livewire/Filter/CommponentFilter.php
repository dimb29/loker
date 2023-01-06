<?php

namespace App\Http\Livewire\Filter;

use Livewire\Component;
use App\Models\JenisKerja;
use App\Models\KualifikasiLulus;
use App\Models\PengalamanKerja;
use App\Models\SpesialisKerja;
use App\Models\BidangKerja;
use App\Models\TingkatKerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommponentFilter extends Component
{
    public $title, $jenker, $name_jk, $jenker_id;
    public $kualif, $name_kl, $kualif_id;
    public $pengkerja, $name_pk, $pengkerja_id;
    public $spesialis, $name_sk, $spesialis_id;
    public $tingker, $name_tk, $tingker_id;
    public $bidker, $name, $bidker_id;
    public $cektype, $filter_id, $parent_id;
    public $isOpen = 0,$isDelete = 0;
    protected $listeners = [
        'dataFillArray','dataBidKer'
    ];
    public function dataFillArray($dataFillArray){
        $this->title = $dataFillArray[0];
        if(count($dataFillArray) == 2){
            $this->parent =  $dataFillArray[1];
        }
        $this->store();
        // dd($dataFillArray);

    }
    public function dataBidKer($dataBidKer){
        $this->bidker = $dataBidKer;
        $this->store();
    }

    public function render()
    {
        $this->jenker = JenisKerja::all();
        $this->kualif = KualifikasiLulus::all();
        $this->pengkerja = PengalamanKerja::all();
        $this->spesialis = SpesialisKerja::all();
        $this->bidker = BidangKerja::all();
        $this->tingker = TingkatKerja::all();
        $return = view('livewire.filter.commponent-filter', [
            'jenkers' => $this->jenker,
            'kualifs' => $this->kualif,
            'pengkerjas' => $this->pengkerja,
            'spesialises' => $this->spesialis,
            'bidkers' => $this->bidker,
            'tingkers' => $this->tingker,
        ]);
        if(Auth::guard('employer')->user() != null){
            return view('livewire.main');
        }else if(Auth::user()->user_type == 'administr'){
            return $return;
        }else{
            return view('livewire.main');
        }
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
        ]);

        if($this->cektype == 'jk'){
            JenisKerja::updateOrCreate(['id' => $this->filter_id],[
                'name_jk' => $this->title,
            ]);
    
            session()->flash('message_jk', 'Jenis Kerja berhasil dibuat.');
        }elseif($this->cektype == 'kl'){
            KualifikasiLulus::updateOrCreate(['id' => $this->filter_id],[
                'name_kl' => $this->title,
            ]);
    
            session()->flash('message_kl', 'Kualifikasi Lulus berhasil dibuat.');
        }elseif($this->cektype == 'pk'){
            PengalamanKerja::updateOrCreate(['id' => $this->filter_id],[
                'name_pk' => $this->title,
            ]);
    
            session()->flash('message_pk', 'Pengalaman Kerja berhasil dibuat.');
        }elseif($this->cektype == 'sk'){
            SpesialisKerja::updateOrCreate(['id' => $this->filter_id],[
                'name_sk' => $this->title,
            ]);
    
            session()->flash('message_sk', 'Spesialis Kerja berhasil dibuat.');
        }elseif($this->cektype == 'bk'){
            $this->validate([
                'parent' => 'required',
            ]);
            $post = BidangKerja::updateOrCreate(['id' => $this->filter_id],[
                'name' => $this->title,
                // 'spesialis_kerja_id' => $this->parent,
            ]);
            if(is_null($this->filter_id)){
                if (count($this->parent) > 0) {
                    // DB::table('bidang_kerja_spesialis_kerja')->where('bidang_kerja_id', $post->id)->delete();
        
                    foreach ($this->parent as $parents) {
                        DB::table('bidang_kerja_spesialis_kerja')->insert([
                            'bidang_kerja_id' => $post->id,
                            'spesialis_kerja_id' => intVal($parents),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
    
            session()->flash('message_bk', 'Bidang Kerja berhasil dibuat.');
        }elseif($this->cektype == 'tk'){
            TingkatKerja::updateOrCreate(['id' => $this->filter_id],[
                'name_tk' => $this->title,
            ]);
    
            session()->flash('message_tk', 'Tingkat Kerja berhasil dibuat.');
        }elseif($this->cektype == 'ibk'){
            $this->validate([
                'bidker' => 'required',
            ]);
            
            if (count($this->bidker) > 0) {
                // DB::table('bidang_kerja_spesialis_kerja')->where('bidang_kerja_id', $post->id)->delete();
    
                foreach ($this->bidker as $bidkers) {
                    DB::table('bidang_kerja_spesialis_kerja')->insert([
                        'bidang_kerja_id' => intVal($bidkers),
                        'spesialis_kerja_id' => $this->filter_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
            session()->flash('message_bk', 'Bidang Kerja berhasil ditambahkan.');
        }
        $this->closeCreate();
    }
    public function edit($id)
    {
        // dd($id);
        $this->cektype = $id[0];
        $this->filter_id = $id[1];
        if($this->cektype == 'jk'){
            $get_fildata = JenisKerja::where('id', $this->filter_id)->first();
            // dd($get_fildata);
            $this->title = $get_fildata->name_jk;
        }elseif($this->cektype == 'kl'){
            $get_fildata = KualifikasiLulus::where('id', $this->filter_id)->first();
            // dd($get_fildata);
            $this->title = $get_fildata->name_kl;
        }elseif($this->cektype == 'pk'){
            $get_fildata = PengalamanKerja::where('id', $this->filter_id)->first();
            // dd($get_fildata);
            $this->title = $get_fildata->name_pk;
        }elseif($this->cektype == 'sk'){
            $get_fildata = SpesialisKerja::where('id', $this->filter_id)->first();
            // dd($get_fildata);
            $this->title = $get_fildata->name_sk;
        }elseif($this->cektype == 'bk'){
            $get_fildata = BidangKerja::where('id', $this->filter_id)->first();
            $get_parent = SpesialisKerja::where('id', $get_fildata->spesialis_kerja_id)->get();
            // dd($get_parent);
            $this->title = $get_fildata->name;
            if($get_parent != null){
                $this->parent = $get_parent->pluck('id');
            }
        }elseif($this->cektype == 'tk'){
            $get_fildata = TingkatKerja::where('id', $this->filter_id)->first();
            // dd($get_fildata);
            $this->title = $get_fildata->name_tk;
        }elseif($this->cektype == 'ibk'){
            $get_fildata = SpesialisKerja::where('id', $this->filter_id)->first();
            // dd($get_fildata);
            $this->title = $get_fildata->name_sk;
        }
        $this->openCreate();
    }

    public function delete()
    {
        // $this->resetInputFilter();
        // dd($this->cektype);
        if($this->cektype == 'jk'){
            JenisKerja::find($this->filter_id)->delete();
            session()->flash('message_jk', 'Jenis Kerja berhasil dihapus.');
        }elseif($this->cektype == 'kl'){
            KualifikasiLulus::find($this->filter_id)->delete();
            session()->flash('message_kl', 'Kualifikasi Lulus berhasil dihapus.');
        }elseif($this->cektype == 'pk'){
            PengalamanKerja::find($this->filter_id)->delete();
            session()->flash('message_pk', 'Pengalaman Kerja berhasil dihapus.');
        }elseif($this->cektype == 'sk'){
            SpesialisKerja::find($this->filter_id)->delete();
            session()->flash('message_sk', 'Spesialis Kerja berhasil dihapus.');
        }elseif($this->cektype == 'bk'){
            BidangKerja::find($this->filter_id)->delete();
            session()->flash('message_bk', 'Bidang Kerja berhasil dihapus.');
        }elseif($this->cektype == 'tk'){
            TingkatKerja::find($this->filter_id)->delete();
            session()->flash('message_tk', 'Tingkat Kerja berhasil dihapus.');
        }elseif($this->cektype == 'ibk'){
            $delbidker = DB::table('bidang_kerja_spesialis_kerja')->where(['bidang_kerja_id' => $this->filter_id, 'spesialis_kerja_id' => $this->parent_id])->delete();
            // dd($delbidker);
            session()->flash('message_bk', 'Bidang Kerja berhasil dihapus.');
        }
        $this->closeDelete();
    }

    public function create($type){
        $this->resetInputFilter();
        $this->cektype = $type;
        $this->openCreate();
    }
    public function openCreate(){
        $this->isOpen = true;
    }
    public function closeCreate(){
        $this->isOpen = false;
    }
    public function openDelete($id){
        $this->cektype = $id[0];
        $this->filter_id = $id[1];
        if(count($id) == 3){
            $this->parent_id = $id[2];
        }
        $this->isDelete = true;
    }
    public function closeDelete(){
        $this->isDelete = false;
    }
    public function resetInputFilter(){
        $this->title = null;
        $this->parent = null;
        $this->filter_id = null;
        $this->cektype = null;
    }
    
}
