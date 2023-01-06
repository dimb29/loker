<?php

namespace App\Http\Livewire\OnClass;

use App\Models\OnClassImage;
use App\Models\OnClassTitle;
use App\Models\OnClassMateri;
use App\Models\OnClassBenefit;
use App\Models\OnClassJenis;
use App\Models\OnClass;
use App\Models\Regency;
use App\Models\District;
use App\Models\SpesialisKerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;

class OnClasses extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title, $content, $kelas_id, $views, $jenis;
    public $spesialis, $checkgaji;
    public $location,$location_district,$location_regency, $inloc, $listloc, $showloc, $getdataloc;
    public $spesialisess = array(), $regencies = array();
    public $multitle = array(),$multitles = array(),$Multiloc = array();
    public $photos = [], $countkelas;
    public $isOpen = 0,$materiOpen = 0, $benefitOpen = 0;
    public $locinput, $materi, $materi_id, $materi_title, $materi_content, $benefit, $benefit_id, $benefit_title;
    protected $listeners = [
        'multiLoc',
        'dataFillArray'
    ];

    public function multiLoc($title){
        $this->location = $title;
    }
    public function dataFillArray($dataFillArray){
        $this->regencies = $dataFillArray[0];
        $this->spesialisess =  $dataFillArray[1];
        if($dataFillArray[2] != null){
            $this->multitle = $dataFillArray[2];
        }else{
            $this->multitle = $this->title;
        }
        $this->content =  $dataFillArray[3];
        // $this->regencies = $dataFillArray;
        $this->store();
    }

    public function mount(){
        
    }

    public function render()
    {
        if(Auth::guard('employer')->user() != null){
            $employerId = Auth::guard('employer')->user()->id;
            $kelass = OnClass::with('author')->where(['user_id' => $employerId, 'user_type' => '2'])->orderBy('id', 'desc')->paginate();
        }else{
            $userId = Auth::user()->id;
            if(Auth::user()->user_type == "administr"){
                $kelass = OnClass::with('author')->orderBy('id', 'desc')->paginate();
            }else{
                $kelass = OnClass::with('author')->where(['user_id' => $userId, 'user_type' => '1'])->orderBy('id', 'desc')->paginate();
            }
        }
        $this->countkelas = count($kelass);
        $return = view('livewire.on-class.on-classes', [
            'kelass' =>  $kelass,
            'locations' => Regency::all(),
            'spesialises' => SpesialisKerja::all(),
            'jns_materi' => OnClassJenis::all(),
        ]);
        if(Auth::guard('employer')->user() != null){
            return $return;
        }else if(Auth::user()->user_type == 'administr'){
            return $return;
        }else{
            return view('livewire.main');
        }
    }

    public function store()
    {
        $this->validate([
            'content' => 'required',
            'photos.*' => 'image|max:4000',
        ]);
        if(is_array($this->multitle)){
            $mytitle = implode("-",$this->multitle);
        }else{
            $mytitle = $this->multitle[0];
        }
        // Update or Insert kelas
        if(Auth::guard('employer')->user() != null){
            $kelas = OnClass::updateOrCreate(['id' => $this->kelas_id], [
                'title' => $mytitle,
                'content' => $this->content,
                'price' => $this->price,
                'employer_id' => Auth::guard('employer')->user()->id,
                'on_class_jenis_id' => $this->jenis,
                'user_type' => 2,
                'per_name' => Auth::guard('employer')->user()->name,
            ]);
        }else{
            $kelas = OnClass::updateOrCreate(['id' => $this->kelas_id], [
                'title' => $mytitle,
                'content' => $this->content,
                'price' => $this->price,
                'user_id' => Auth::user()->id,
                'on_class_jenis_id' => $this->jenis,
                'user_type' => 1,
                'per_name' => Auth::user()->first_name.' '.Auth::user()->last_name,
            ]);
        }

        // Image upload and store name in db
        if($this->photos != null){
            $geturl = OnClassImage::where('on_class_id', $kelas->id)->first();
            // dd($geturl);
            if($geturl != null){
                // foreach($geturl as $getimgs){
                //     Storage::disk('public_uploads')->delete($getimgs->url);
                // }
                Storage::disk('public_uploads')->delete($geturl->url);
                OnClassImage::where('on_class_id', $kelas->id)->delete();
            }
            $counter = 0;

            // $storedImage = $photo->store('public/photos');
            $storepublic = Storage::disk('public_uploads')->put('storage/photos', $this->photos);
            $featured = false;
            if($counter == 0 ){
                $featured = true;
            }
            // $imgtitle = $this
            OnClassImage::create([
                'url' => $storepublic,
                'title' => $mytitle,
                'on_class_id' => $kelas->id,
                'featured' => $featured
            ]);
        }

        if ($this->multitle != null) {
            $kelas_title = DB::connection('mysql2')->table('on_class_title')->where('on_class_id', $kelas->id)->delete();
            if(is_array($this->multitle)){
                foreach ($this->multitle as $multitle) {
                    DB::connection('mysql2')->table('on_class_title')->insert([
                        'on_class_id' => $kelas->id,
                        'title' =>  $multitle,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }else{
                if($this->multitle != null){
                    foreach ($this->multitle as $multitle) {
                        DB::connection('mysql2')->table('on_class_title')->insert([
                            'on_class_id' => $kelas->id,
                            'title' =>  $multitle,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }else{
                    DB::connection('mysql2')->table('on_class_title')->insert([
                        'on_class_id' => $kelas->id,
                        'title' =>  $this->title,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        if($this->location != null){
            if (count($this->location) > 0) {
                // dd($this->location);
                $kelas_title_reg = DB::connection('mysql2')->table('on_class_regency')->where('on_class_id', $kelas->id)->delete();
                $kelas_title_dist = DB::connection('mysql2')->table('district_on_class')->where('on_class_id', $kelas->id)->delete();
                foreach ($this->location as $loc) {
                    $getlocid = Regency::where('name', 'LIKE', '%'.$loc.'%')->first();
                    if($getlocid != null){
                        DB::connection('mysql2')->table('on_class_regency')->insert([
                            'on_class_id' => $kelas->id,
                            'regency_id' => $getlocid->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }else{
                        $getlocid = District::where('name', 'LIKE', '%'.$loc.'%')->first();
                        DB::connection('mysql2')->table('district_on_class')->insert([
                            'on_class_id' => $kelas->id,
                            'district_id' => $getlocid->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
        if($this->spesialis != null){
            if (count($this->spesialis) > 0) {
                $kelas_title = DB::connection('mysql2')->table('on_class_spesialis_kerja')->where('on_class_id', $kelas->id)->delete();
                foreach ($this->spesialis as $spesialis) {
                    DB::connection('mysql2')->table('on_class_spesialis_kerja')->insert([
                        'on_class_id' => $kelas->id,
                        'spesialis_kerja_id' => intVal($spesialis),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        session()->flash(
            'message',
            $this->kelas_id ? 'Class Updated Successfully.' : 'Class Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        DB::connection('mysql2')->table('on_class_title')->where('on_class_id', $id)->delete();
        DB::table('on_classs_regency')->where('on_class_id', $id)->delete();
        DB::table('on_class_district')->where('on_class_id', $id)->delete();
        DB::connection('mysql2')->table('on_class_spesialis_kerja')->where('on_class_id', $id)->delete();
        DB::table('on_class_save')->where('on_class_id', $id)->delete();
        
        $geturl = Image::where('on_class_id', $id)->first();
        if($geturl != null){
            Storage::disk('public_uploads')->delete($geturl->url);
            Image::where('on_classs_id', $id)->delete();
        }
        DB::connection('mysql2')-table('on_class_image')->where('on_class_id', $id)->delete();
        OnClass::find($id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $kelas = OnClass::with('classtitle', 'spesialiskerja', 'regency', 'district')
        ->findOrFail($id);

        $this->kelas_id = $id;
        $this->multitles = $kelas->classtitle;
        $this->multitle = $kelas->classtitle->pluck('title');
        // $this->title = $kelas->title;
        $this->content = $kelas->content;
        $this->price = $kelas->price;
        $this->checkgaji = $kelas->salary_check;
        $this->location_regency = $kelas->regency;
        $this->location_district = $kelas->district;
        $this->spesialis = $kelas->spesialiskerja->pluck('id');
        $this->materi = $kelas->materi;
        $this->benefit = $kelas->benefit;
        $this->jenis = $kelas->on_class_jenis_id;

        $this->openModal();
    }

    public function locationSearch(){
        
        $query = $this->inloc;
        $filterResult = Regency::where('name', 'LIKE', '%'. $query. '%')->get();
        if(count($filterResult) < 1){
            $filterResult = District::where('name', 'LIKE', '%'. $query. '%')->get();
        }
        $this->listloc = $filterResult;
        // session()->flash('listlocs', 'cekcekcek');
        // dd($this->listloc);
    }

    public function create()
    {
        $total_upload = $this->countkelas;
        if(Auth::guard('employer')->user() != null){
            $getmax = Auth::guard('employer')->user()->max_upload;
            if($getmax <= $total_upload){
                $this->openModal2();
            }else{
                $this->openModal();
            }
        }else{
            $this->openModal();
        }
        $this->resetInputFields();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }
    public function openMateri(){
        $this->materiOpen = true;
    }

    public function storeMateri(){
        $this->validate([
            'materi_title' => 'required',
            'materi_content' => 'required',
        ]);
        $materi = onClassMateri::updateOrCreate(['id' => $this->materi_id],[
            'on_class_id' => $this->kelas_id,
            'title' => $this->materi_title,
            'content' => $this->materi_content,
        ]);
        $this->edit($this->kelas_id);
        $this->closeMateri();
    }
    public function editMateri($id){
        $materi = onClassMateri::find($id);
        $this->materi_id = $id;
        $this->materi_title = $materi->title;
        $this->materi_content = $materi->content;
        $this->openMateri();
    }
    public function closeMateri(){
        $this->materiOpen = false;
        $this->resetInputMateri();
    }
    private function resetInputMateri(){
        $this->materi_id = null;
        $this->materi_title = null;
        $this->materi_content = null;
    }

    public function openBenefit(){
        $this->benefitOpen = true;
    }
    
    public function storeBenefit(){
        $this->validate([
            'benefit_title' => 'required',
        ]);
        $benefit = onClassBenefit::updateOrCreate(['id' => $this->benefit_id],[
            'on_class_id' => $this->kelas_id,
            'title' => $this->benefit_title,
        ]);
        $this->edit($this->kelas_id);
        $this->closeBenefit();
    }
    public function editBenefit($id){
        $benefit = onClassBenefit::find($id);
        $this->benefit_id = $id;
        $this->benefit_title = $benefit->title;
        $this->openBenefit();
    }
    public function deleteBenefit($id){
        $del_benefit = onClassBenefit::where('id', $id)->delete();
    }
    public function closeBenefit(){
        $this->benefitOpen = false;
        $this->resetInputBenefit();
    }
    private function resetInputBenefit(){
        $this->benefit_id = null;
        $this->benefit_title = null;
    }

    private function resetInputFields()
    {
        $this->multitle = null;
        $this->content = null;
        $this->photos = null;
        $this->kelas_id = null;
        $this->location_regency = null;
        $this->location_district = null;
        $this->spesialis = null;
        $this->jenis = null;
    }
}
