<?php

namespace App\Http\Livewire\Profile;

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

class MyClass extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title, $content, $kelas_id, $views, $jenis;
    public $spesialis, $checkgaji;
    public $location,$location_district,$location_regency, $inloc, $listloc, $showloc, $getdataloc;
    public $spesialisess = array(), $regencies = array();
    public $multitle = array(),$multitles = array(),$Multiloc = array();
    public $photos = [], $countkelas, $placename, $alamat, $kodepos, $date_type, $date, $daterange, $price;
    public $isOpen = 0,$materiOpen = 0, $benefitOpen = 0, $cities, $provinces, $city, $province, $city_id, $city_name, $province_id, $province_name;
    public $locinput, $materi, $materi_id, $materi_title, $materi_content, $benefit, $benefit_id, $benefit_title;
    public $addmateri, $materidb, $addbenefit, $benefitdb, $isEditMat = false, $isEditBen = false;
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
        session()->put('addmateries', array());
        session()->put('materidb', array());
        session()->put('addbenefit', array());
        session()->put('benefitdb', array());
    }

    public function render()
    {
        if(Auth::guard('employer')->user() != null){
            $usid = $employerId = Auth::guard('employer')->user()->id;
            $kelass = OnClass::with('author')->where(['user_id' => $employerId, 'user_type' => '2'])->orderBy('id', 'desc')->paginate();
        }else{
            $usid = $userId = Auth::user()->id;
            if(Auth::user()->user_type == "administr"){
                $kelass = OnClass::with('author')->orderBy('id', 'desc')->paginate();
            }else{
                $kelass = OnClass::with('author')->where(['user_id' => $userId, 'user_type' => '1'])->orderBy('id', 'desc')->paginate();
            }
        }
        $this->countkelas = count($kelass);

        $class = OnClass::with(['images', 'materi'])->leftJoin('on_class_user as user', 'on_classes.id', 'user.on_class_id')
                        ->select('on_classes.id', 'on_classes.title', 'on_classes.content', 'on_classes.user_id as author_id', 'on_classes.user_type as author_type', 'user.user_id', 'user.user_type')
                        ->where('user.user_id', $usid)->get();

        $return = view('livewire.profile.my-class', [
            'kelass' =>  $kelass,
            'class' => $class,
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

    public function getCity(){
        if($this->province_id){
            $query = $this->city_name;
            $cities = Regency::where('name', 'LIKE', '%'. $query. '%')->whereRaw('LENGTH(id) = 4')->where('province_id', $this->province_id)->get();
            $this->cities = $cities;
        }else{
            session()->flash('message_kota', 'provinsi tidak boleh kosong');
        }
        // dd($cities);

    }

    public function setCity($id,$name){
        $this->city_id = $id;
        $this->city = $id;
        $this->city_name = $name;
    }

    public function getProvince(){
        $query = $this->province_name;
        $provinces = Regency::where('name', 'LIKE', '%'. $query. '%')->whereRaw('LENGTH(id) = 2')->get();
        $this->provinces = $provinces;

    }

    public function setProvince($id,$name){
        $this->province_id = $id;
        $this->province = $id;
        $this->province_name = $name;
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

        if(count(session('materidb')) > 0){
            $getsessionmateri = session('materidb');
            if(count($getsessionmateri) > 0){ 
                foreach($getsessionmateri as $key => $session_materi){
                    $addmateri = OnClassMateri::updateOrCreate(['id' => $session_materi['id']], [
                        'title' => $session_materi['title'],
                        'on_class_id' => $kelas->id,
                        'content' => $session_materi['content'],
                    ]);
                }
            }
        }

        $getsessionmateri = session('addmateries');
        if(count($getsessionmateri) > 0){
            foreach($getsessionmateri as $key => $session_materi){
                $addmateri = OnClassMateri::updateOrCreate(['id' => $kelas->id.'99809808808980809890898098098988089809'],[
                    'title' => $session_materi['title'],
                    'on_class_id' => $kelas->id,
                    'content' => $session_materi['content'],
                ]);
            }
        }

        if(count(session('benefitdb')) > 0){
            $getsessionbenefit = session('benefitdb');
            if(count($getsessionbenefit) > 0){ 
                foreach($getsessionbenefit as $key => $session_benefit){
                    $addbenefit = OnClassBenefit::updateOrCreate(['id' => $session_benefit['id']], [
                        'title' => $session_benefit['title'],
                        'on_class_id' => $kelas->id,
                    ]);
                }
            }
        }

        $getsessionbenefit = session('addbenefit');
        if(count($getsessionbenefit) > 0){
            foreach($getsessionbenefit as $key => $session_benefit){
                $addbenefit = OnClassBenefit::updateOrCreate(['id' => $kelas->id.'99809808808980809890898098098988089809'],[
                    'title' => $session_benefit['title'],
                    'on_class_id' => $kelas->id,
                ]);
            }
        }

        if($this->jenis == 1){
            $upate_address = OnClass::where(['id' => $kelas->id])->update([
                'placename' => $this->placename,
                'alamat' => $this->alamat,
                'kodepos' => $this->kodepos,
                'kota' => $this->city,
                'provinsi' => $this->province,
            ]);
        }
        if($this->date_type){
            if($this->date_type == 1){
                $warray = [
                    'start_date' => $this->date,
                    'end_date' => null,
                ];
            }elseif($this->date_type == 2){
                $split_date = explode(' to ', $this->daterange);
                $warray = [
                    'start_date' => $split_date[0],
                    'end_date' => $split_date[1],
                ];
            }
            $update_date = OnClass::where(['id' => $kelas->id])->update($warray);
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
        if($kelas->materi != null){
            $this->materidb =  session()->get('materidb');
            foreach($kelas->materi as $keymateri => $thismateri){
                $setid = 'fromdb'.$thismateri->id;
                $this->materidb[$setid] = [
                    "id" => $thismateri->id,
                    "title" => $thismateri->title,
                    "content" => $thismateri->content,
                ];
                session()->put('materidb', $this->materidb);
                // dd(['data' => $this->materi, 'session' => session()->get('materidb')]);
            }
        }

        $this->benefit = $kelas->benefit;
        if($kelas->benefit != null){
            $this->benefitdb =  session()->get('benefitdb');
            foreach($kelas->benefit as $keybenefit => $thisbenefit){
                $setid = 'fromdb'.$thisbenefit->id;
                $this->benefitdb[$setid] = [
                    "id" => $thisbenefit->id,
                    "title" => $thisbenefit->title,
                ];
                session()->put('benefitdb', $this->benefitdb);
            }
        }
        $this->jenis = $kelas->on_class_jenis_id;

        $this->placename = $kelas->placename;
        $this->alamat = $kelas->alamat;
        $this->kodepos = $kelas->kodepos;
        $this->city = $kelas->kota;
        $this->province = $kelas->provinsi;
        if($kelas->kota){
            $getcity = Regency::find($kelas->kota);
            $this->city_name = $getcity->name;
        }
        if($kelas->provinsi){
            $getprovince = Regency::find($kelas->provinsi);
            $this->province_name = $getprovince->name;
        }
        if($kelas->start_date || $kelas->end_date){
            if($kelas->end_date){
                $this->date_type = 2;
                $this->daterange = $kelas->start_date.' to '.$kelas->end_date;
            }else{
                $this->date_type = 1;
                $this->date = $kelas->start_date;
            }
        }

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

    public function addMateri(){
        $this->validate([
            'materi_title' => 'required',
            'materi_content' => 'required',
        ]);
        
        if(is_null($this->addmateri)){
            $this->addmateri = array();
            session()->put('addmateries', $this->addmateri);
            // dd($this->addmateri);
        }
        $countmateri = 'materi'.count(session('addmateries'));
        $this->addmateri[$countmateri] = [
            "title" => $this->materi_title,
            "content" => $this->materi_content,
        ];
        // dd($this->addmateri[$countmateri]);
        session()->put('addmateries', $this->addmateri);
        // $this->edit($this->kelas_id);
        $this->closeMateri();
    }
    public function editMateri($id){
        // dd(['id' => $id,'data' => session()->get('materidb')]);
        $this->isEditMat = true;
        if(stripos($id, 'db') != false){
            $this->materidb = session()->get('materidb');
            $this->materi_title = $this->materidb[$id]['title'];
            $this->materi_content = $this->materidb[$id]['content'];
        }else{
            $this->addmateri = session()->get('addmateries');
            $this->materi_title = $this->addmateri[$id]['title'];
            $this->materi_content = $this->addmateri[$id]['content'];
            // $this->variantlist = $getsession[$id]['list'];
        }
        $this->materi_id = $id;
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
        $this->isEditMat = false;
    }

    public function updateMateri($id){
        if(stripos($id, 'db') != false){
            $this->materidb[$id]['title'] = $this->materi_title;
            $this->materidb[$id]['content'] = $this->materi_content;
            session()->put('materidb', $this->materidb);
        }else{
            $this->addmateri[$id]['title'] = $this->materi_title;
            $this->addmateri[$id]['content'] = $this->materi_content;
            session()->put('addmateries', $this->addmateri);
        }
        $this->resetInputMateri();
        $this->closeMateri();
    }
    public function deleteMateri($id){
        if(isset($this->addmateri[$id])) {
            unset($this->addmateri[$id]);
            session()->put('addmateries', $this->addmateri);
        }
        if($this->addmateri){
            $getaddmateries = session('addmateries');
            $setkeymateri = 0;
            $this->addmateri = array();
            foreach($getaddmateries as $getaddmateri){
                $countmateri = 'materi'.$setkeymateri;
                $this->addmateri[$countmateri] = $getaddmateri;
                $setkeymateri++;
            }
            session()->pull('addmateries');
            session()->put('addmateries', $this->addmateri);
        }
    }
    public function delmateriDB($id){
        $materi_id = $this->materidb[$id]['id'];
        $delmateri = OnClassMateri::where('id', $materi_id)->delete();
        if(isset($this->materidb[$id])) {
            unset($this->materidb[$id]);
            session()->put('materidb', $this->materidb);  
        }
    }

    public function openBenefit(){
        $this->benefitOpen = true;
    }
    
    public function addBenefit(){
        $this->validate([
            'benefit_title' => 'required',
        ]);
        
        if(is_null($this->addbenefit)){
            $this->addbenefit = array();
            session()->put('addbenefit', $this->addbenefit);
        }
        $countbenefit = 'benefit'.count(session('addbenefit'));
        $this->addbenefit[$countbenefit] = [
            "title" => $this->benefit_title,
        ];
        session()->put('addbenefit', $this->addbenefit);
        $this->closeBenefit();
    }
    public function editBenefit($id){
        $this->isEditBen = true;
        if(stripos($id, 'db') != false){
            $this->benefitdb = session()->get('benefitdb');
            $this->benefit_title = $this->benefitdb[$id]['title'];
        }else{
            $this->addbenefit = session()->get('addbenefit');
            $this->benefit_title = $this->addbenefit[$id]['title'];
        }
        $this->benefit_id = $id;
        $this->openBenefit();
    }

    public function updateBenefit($id){
        if(stripos($id, 'db') != false){
            $this->benefitdb[$id]['title'] = $this->benefit_title;
            session()->put('benefitdb', $this->benefitdb);
        }else{
            $this->addbenefit[$id]['title'] = $this->benefit_title;
            session()->put('addbenefit', $this->addbenefit);
        }
        $this->resetInputBenefit();
        $this->closeBenefit();
    }
    public function deleteBenefit($id){
        if(isset($this->addbenefit[$id])) {
            unset($this->addbenefit[$id]);
            session()->put('addbenefit', $this->addbenefit);
        }
        if($this->addbenefit){
            $getaddbenefit = session('addbenefit');
            $setkeybenefit = 0;
            $this->addbenefit = array();
            foreach($getaddbenefit as $getaddbenefit){
                $countbenefit = 'benefit'.$setkeybenefit;
                $this->addbenefit[$countbenefit] = $getaddbenefit;
                $setkeybenefit++;
            }
            session()->pull('addbenefit');
            session()->put('addbenefit', $this->addbenefit);
        }
    }
    public function delbenefitDB($id){
        $benefit_id = $this->benefitdb[$id]['id'];
        $delbenefit = OnClassBenefit::where('id', $benefit_id)->delete();
        if(isset($this->benefitdb[$id])) {
            unset($this->benefitdb[$id]);
            session()->put('benefitdb', $this->benefitdb);  
        }
    }
    public function closeBenefit(){
        $this->benefitOpen = false;
        $this->resetInputBenefit();
    }
    private function resetInputBenefit(){
        $this->benefit_id = null;
        $this->benefit_title = null;
        $this->isEditBen = false;
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

        if(isset($this->addmateri)){
            $this->addmateri = array();
            session()->put('addmateries', $this->addmateri);
        }
        if(isset($this->materidb)){
            $this->materidb = array();
            session()->put('materidb', $this->materidb);
        }
        if(isset($this->addbenefit)){
            $this->addbenefit = array();
            session()->put('addbenefit', $this->addbenefit);
        }
        if(isset($this->benefitdb)){
            $this->benefitdb = array();
            session()->put('benefitdb', $this->benefitdb);
        }
    }
}
