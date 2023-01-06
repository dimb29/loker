<?php
namespace App\Http\Livewire\Posts;

use App\Models\Image;
use App\Models\Post;
use App\Models\JenisKerja;
use App\Models\Regency;
use App\Models\District;
use App\Models\KualifikasiLulus;
use App\Models\PengalamanKerja;
use App\Models\SpesialisKerja;
use App\Models\TingkatKerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;


class Posts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title, $content, $post_id, $views, $email, $wa, $minrange, $maxrange, $formulir;
    public $jenker, $kualif, $pengkerja, $spesialis, $tingker, $checkgaji;
    public $location,$location_district,$location_regency, $inloc, $listloc, $showloc, $getdataloc;
    public $jenkeres = array(), $kualifes = array(), $pengkerjases = array();
    public $spesialisess = array(), $tingkeres = array(),$regencies = array();
    public $multitle = array(),$multitles = array(),$Multiloc = array();
    public $photos = [], $countpost;
    public $isOpen = 0,$isOpen2 = 0;
    public $locinput;
    protected $listeners = [
        'multiLoc',
        'dataFillArray'
    ];

    public function multiLoc($title){
        $this->location = $title;
    }
    public function dataFillArray($dataFillArray){
        $this->regencies = $dataFillArray[0];
        $this->jenkeres =  $dataFillArray[1];
        $this->kualifes =  $dataFillArray[2];
        $this->pengkerjases =  $dataFillArray[3];
        $this->spesialisess =  $dataFillArray[4];
        $this->tingkeres =  $dataFillArray[5];
        if($dataFillArray[6] != null){
            $this->multitle = $dataFillArray[6];
        }else{
            $this->multitle = $this->title;
        }
        $this->content =  $dataFillArray[7];
        // $this->regencies = $dataFillArray;
        $this->store();
    }

    public function mount(){
        
    }

    public function render()
    {
        if(Auth::guard('employer')->user() != null){
            $employerId = Auth::guard('employer')->user()->id;
            $posts = Post::with('author')->where('employer_id', $employerId)->orderBy('id', 'desc')->paginate();
        }else{
            $userId = Auth::user()->id;
            if(Auth::user()->user_type == "administr"){
                $posts = Post::with('author')->orderBy('id', 'desc')->paginate();
            }else{
                $posts = Post::with('author')->where('author_id',$userId)->orderBy('id', 'desc')->paginate();
            }
        }
        $this->countpost = count($posts);
        $return = view('livewire.posts.posts', [
            'posts' =>  $posts,
            'locations' => Regency::all(),
            'jenkers' => JenisKerja::all(),
            'kualifs' => KualifikasiLulus::all(),
            'pengkerjas' => PengalamanKerja::all(),
            'spesialises' => SpesialisKerja::all(),
            'tingkers' => TingkatKerja::all(),
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
            // 'multitle' => 'required',
            'content' => 'required',
            'photos.*' => 'image|max:4000',
            // 'minrange'    => 'required',
            // 'maxrange'    => 'required',
            'email'     => 'required',
            'wa'        => 'required',
        ]);
        if(is_array($this->multitle)){
            $mytitle = implode("-",$this->multitle);
        }else{
            $mytitle = $this->multitle[0];
        }
        // Update or Insert Post
        if(Auth::guard('employer')->user() != null){
            $post = Post::updateOrCreate(['id' => $this->post_id], [
                'title' => $mytitle,
                'content' => $this->content,
                'email' => $this->email,
                'wa' => $this->wa,
                'formulir' => $this->formulir,
                'salary_start' => $this->minrange,
                'salary_end' => $this->maxrange,
                'salary_check' => $this->checkgaji,
                'employer_id' => Auth::guard('employer')->user()->id,
                'per_name' => Auth::guard('employer')->user()->name,
            ]);
        }else{
            $post = Post::updateOrCreate(['id' => $this->post_id], [
                'title' => $mytitle,
                'content' => $this->content,
                'email' => $this->email,
                'wa' => $this->wa,
                'formulir' => $this->formulir,
                'salary_start' => $this->minrange,
                'salary_end' => $this->maxrange,
                'salary_check' => $this->checkgaji,
                'author_id' => Auth::user()->id,
                'per_name' => Auth::user()->first_name.' '.Auth::user()->last_name,
            ]);
        }

        // Image upload and store name in db
        if($this->photos != null){
            if (count($this->photos) > 0) {
                $geturl = Image::where('post_id', $post->id)->first();
                if($geturl != null){
                    foreach($geturl as $getimgs){
                        Storage::disk('public_uploads')->delete($getimgs->url);
                    }
                    Image::where('post_id', $post->id)->delete();
                }
                $counter = 0;
                foreach ($this->photos as $photo) {

                    // $storedImage = $photo->store('public/photos');
                    $storepublic = Storage::disk('public_uploads')->put('storage/photos', $photo);
                    $featured = false;
                    if($counter == 0 ){
                        $featured = true;
                    }
                    // $imgtitle = $this
                    Image::create([
                        'url' => $storepublic,
                        'title' => $mytitle,
                        'post_id' => $post->id,
                        'featured' => $featured
                    ]);
                    $counter++;
                }
            }
        }

        // Post Tag mapping
        // if (count($this->tagids) > 0) {
        //     DB::table('post_tag')->where('post_id', $post->id)->delete();

        //     foreach ($this->tagids as $tagid) {
        //         DB::table('post_tag')->insert([
        //             'post_id' => $post->id,
        //             'tag_id' => intVal($tagid),
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }
        // }
        if ($this->multitle != null) {
            $post_title = DB::table('post_title')->where('post_id', $post->id)->delete();
            if(is_array($this->multitle)){
                foreach ($this->multitle as $multitle) {
                    DB::table('post_title')->insert([
                        'post_id' => $post->id,
                        'title' =>  $multitle,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }else{
                if($this->multitle != null){
                    foreach ($this->multitle as $multitle) {
                        DB::table('post_title')->insert([
                            'post_id' => $post->id,
                            'title' =>  $multitle,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }else{
                    DB::table('post_title')->insert([
                        'post_id' => $post->id,
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
                $post_title_reg = DB::table('post_regency')->where('post_id', $post->id)->delete();
                $post_title_dist = DB::table('district_post')->where('post_id', $post->id)->delete();
                foreach ($this->location as $loc) {
                    $getlocid = Regency::where('name', 'LIKE', '%'.$loc.'%')->first();
                    if($getlocid != null){
                        DB::table('post_regency')->insert([
                            'post_id' => $post->id,
                            'regency_id' => $getlocid->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }else{
                        $getlocid = District::where('name', 'LIKE', '%'.$loc.'%')->first();
                        DB::table('district_post')->insert([
                            'post_id' => $post->id,
                            'district_id' => $getlocid->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
        if($this->jenker != null){
            if (count($this->jenker) > 0) {
                $post_title = DB::table('jenis_kerja_post')->where('post_id', $post->id)->delete();
                foreach ($this->jenker as $jenker) {
                    DB::table('jenis_kerja_post')->insert([
                        'post_id' => $post->id,
                        'jenis_kerja_id' => intVal($jenker),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        if($this->kualif != null){
            if (count($this->kualif) > 0) {
                $post_title = DB::table('kualifikasi_lulus_post')->where('post_id', $post->id)->delete();
                foreach ($this->kualif as $kualif) {
                    DB::table('kualifikasi_lulus_post')->insert([
                        'post_id' => $post->id,
                        'kualifikasi_lulus_id' => intVal($kualif),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        if($this->pengkerja != null){
            if (count($this->pengkerja) > 0) {
                $post_title = DB::table('pengalaman_kerja_post')->where('post_id', $post->id)->delete();
                foreach ($this->pengkerja as $pengkerja) {
                    DB::table('pengalaman_kerja_post')->insert([
                        'post_id' => $post->id,
                        'pengalaman_kerja_id' => intVal($pengkerja),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        if($this->spesialis != null){
            if (count($this->spesialis) > 0) {
                $post_title = DB::table('post_spesialis_kerja')->where('post_id', $post->id)->delete();
                foreach ($this->spesialis as $spesialis) {
                    DB::table('post_spesialis_kerja')->insert([
                        'post_id' => $post->id,
                        'spesialis_kerja_id' => intVal($spesialis),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    }
        if($this->tingker != null){
            if (count($this->tingker) > 0) {
                $post_title = DB::table('post_tingkat_kerja')->where('post_id', $post->id)->delete();
                foreach ($this->tingker as $tingker) {
                    DB::table('post_tingkat_kerja')->insert([
                        'post_id' => $post->id,
                        'tingkat_kerja_id' => intVal($tingker),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        session()->flash(
            'message',
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        DB::table('post_title')->where('post_id', $id)->delete();
        DB::table('post_regency')->where('post_id', $id)->delete();
        DB::table('post_district')->where('post_id', $id)->delete();
        DB::table('jenis_kerja_post')->where('post_id', $id)->delete();
        DB::table('kualifikasi_lulus_post')->where('post_id', $id)->delete();
        DB::table('pengalaman_kerja_post')->where('post_id', $id)->delete();
        DB::table('post_spesialis_kerja')->where('post_id', $id)->delete();
        DB::table('post_tingkat_kerja')->where('post_id', $id)->delete();
        DB::table('post_save')->where('post_id', $id)->delete();
        
        $geturl = Image::where('post_id', $id)->first();
        if($geturl != null){
            Storage::disk('public_uploads')->delete($geturl->url);
            Image::where('post_id', $id)->delete();
        }
        DB::table('images')->where('post_id', $id)->delete();
        Post::find($id)->delete();
        // DB::table('post_tag')->where('post_id', $id)->delete();
        // session()->flash('message', 'Post Deleted Successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $post = Post::with('PostTitles','jeniskerja','kualifikasilulus',
        'pengalamankerja','spesialiskerja','tingkatkerja','regency','district')
        ->findOrFail($id);

        $this->post_id = $id;
        $this->multitles = $post->postTitles;
        $this->multitle = $post->postTitles->pluck('title');
        // $this->title = $post->title;
        $this->content = $post->content;
        $this->minrange = $post->salary_start;
        $this->maxrange = $post->salary_end;
        $this->checkgaji = $post->salary_check;
        $this->location_regency = $post->regency;
        $this->location_district = $post->district;
        $this->jenker = $post->jeniskerja->pluck('id');
        $this->kualif = $post->kualifikasilulus->pluck('id');
        $this->spesialis = $post->spesialiskerja->pluck('id');
        $this->pengkerja = $post->pengalamankerja->pluck('id');
        $this->tingker = $post->tingkatkerja->pluck('id');
        $this->wa = $post->wa;
        $this->email = $post->email;
        $this->formulir = $post->formulir;

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
        $total_upload = $this->countpost;
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
    public function openModal2(){
        $this->isOpen2 = true;
    }
    public function closeModal2(){
        $this->isOpen2 = false;
    }

    private function resetInputFields()
    {
        $this->multitle = null;
        $this->content = null;
        $this->photos = null;
        $this->post_id = null;
        $this->location_regency = null;
        $this->location_district = null;
        $this->jenker = null;
        $this->kualif = null;
        $this->pengkerja = null;
        $this->spesialis = null;
        $this->tingker = null;
        $this->minrange = null;
        $this->maxrange = null;
        $this->checkgaji = null;
        $this->wa = null;
        $this->email = null;
    }
}
