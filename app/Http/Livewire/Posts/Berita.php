<?php



namespace App\Http\Livewire\Posts;




use App\Models\Image;

use App\Models\Regency;
use App\Models\District;

use App\Models\Post;
use App\Models\Employer;
use App\Models\User;
use App\Models\Notification as Notif;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

use Livewire\Component;

use Livewire\WithFileUploads;

use Livewire\WithPagination;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;







class Berita extends Component

{ use WithPagination;

    use WithFileUploads;



    public $title, $content, $post_id;

    public $post, $isSuccess = 0;
    
    public $cv, $acv, $more_info;

    public $photos = [];

    public $isOpen = 0;

    public $perPage = 10;

    public $searchjob,$searchless,$searchdata,$kualif_lulus,$jenis_kerja,$spes_kerja,$peng_kerja,$ting_kerja;

    public $minrange,$maxrange,$search0,$search1,$search2,$search3,$search4,$search5;

    public $sj_split,$loc_split,$kl_split,$jk_split;

    public $locations = "";

    // public $posts;

    protected $listeners = [

        // 'post-data' => 'postScroll',

        'post-detail' => 'postDetail',

        'searchJobs', 'postDetail', 'searchJob',
        
        'minRange', 'maxRange',



    ];



    public $myid = 0;

    public function loadMore(){
        $this->perPage += 10;
    }

    public function postDetail($id){

        $this->myid = $id;

        // dd($id);

    }
    public function minRange($value){
        if(!is_null($value))
        $this->minrange = $value*1000000;
    }
    public function maxRange($value){
        if(!is_null($value))
        $this->maxrange = $value*1000000;
    }



    // public function postScroll(){

    //     $this->limitPerPage = $this->limitPerPage + 1;

    // }

    public function searchJobs($search){
        $this->searchjob = 'mjsa09J0J)ISJD(jf39jc029jksndm';
        $this->emit('searchJob', $search);
    }
    public function searchJob($search){
        // dd($search);
        $this->search1 = null;
        $this->searchjob = $search[0];

        if($search[1] == null){

            $search[1] = "";

        }

        $this->locations = $search[1];

        $this->kualif_lulus = $search[2];

        $this->jenis_kerja = $search[3];

        $this->minrange = $search[4];

        $this->maxrange = $search[5];

        $this->myid = "";
        $this->perPage = 0;
    }



    public function mount($id){

        if(Auth::user() != null){
            $this->acv = Auth::user()->cv;
        }
        $split = explode('&', $id);

        // dd($split);

        if(count($split) > 1){

            $sj_split = str_replace('+',' ',explode('=', $split[0]));

            $loc_split = str_replace('+',' ',explode('=', $split[1]));

            $kl_split = str_replace('+',' ',explode('=', $split[2]));

            $jk_split = str_replace('+',' ',explode('=', $split[3]));

            $minr_split = str_replace('+',' ',explode('=', $split[4]));

            $maxr_split = str_replace('+',' ',explode('=', $split[5]));


            if($loc_split[1] != null){
            
                $regency_split = $loc_split[1];
            
            }else{
            
                $regency_split = "";
            
            }
            

            // dd($regencies);

            if($sj_split[1] != '' || $loc_split[1] != '' || $kl_split[1] != '' || $jk_split[1] != '' || $maxr_split[1] != '' || $minr_split[1] != ''){

                if($this->searchjob != '' || $this->locations != '' || $this->kualif_lulus != '' || $this->jenis_kerja != '' || $this->maxrange != '' || $this->minrange != ''){

    

                }else{

                    $this->searchjob = $sj_split[1];

                    $this->locations = $regency_split;

                    $this->kualif_lulus = $kl_split[1];

                    $this->jenis_kerja = $jk_split[1];

                    $this->minrange = $minr_split[1];

                    $this->maxrange = $maxr_split[1];

                }
                // dd($this->locations);

            }

        }elseif(count($split) == 1){

            $fil_split = str_replace('+',' ',explode('=', $split[0]));

            // dd($fil_split[0]);

            if($fil_split[0] == 'sj_send'){

                $this->searchjob = $fil_split[1];

            }elseif($fil_split[0] == 'jk_send'){

                $this->jenis_kerja = $fil_split[1];

            }elseif($fil_split[0] == 'loc_send'){

                $this->locations = $fil_split[1];

            }elseif($fil_split[0] == 'kl_send'){

                $this->kualif_lulus = $fil_split[1];

            }elseif($fil_split[0] == 'pk_send'){

                $this->peng_kerja = $fil_split[1];

            }elseif($fil_split[0] == 'sk_send'){

                $this->spes_kerja = $fil_split[1];

            }elseif($fil_split[0] == 'tk_send'){

                $this->ting_kerja = $fil_split[1];

            }elseif($fil_split[0] == 'minrange'){

                $this->minrange = $fil_split[1];

            }elseif($fil_split[0] == 'maxrange'){

                $this->maxrange = $fil_split[1];

            }

        }

    } 



    public function render()

    {
        // dd($this->minrange.'-'.$this->maxrange);
        $now = Carbon::now();
        // dd($this->locations);
        $this->regency = Regency::where('name', 'like',$this->locations . '%')->first();
        $this->district = District::where('name', 'like',$this->locations . '%')->first();
        // dd($this->regency->id);
            $getposts = Post::where('title', 'like', '%'.$this->searchjob.'%')
                ->orWhere('content', 'like', '%'.$this->searchjob.'%')->first();
            // if(is_null($getposts)){
            //     $posts = Post::all();
            // }else{
            //     $posts = Post::search($this->searchjob);
            // }
            $posts = Post::with('regency')->orderBy('created_at', 'DESC');
            if($this->searchjob != null){
                $searchdata = explode(' ', $this->searchjob);
                foreach($searchdata as $searchdt){
                    $posts->where(function($q) use($searchdt){
                        $q->where('title', 'like', '%'.$searchdt.'%')
                        ->orWhere('content', 'like', '%'.$searchdt.'%')
                        ->orWhere('per_name', 'like', '%'.$searchdt.'%');
                    });
                }
            }
            if($this->locations != null){
                $posts->whereHas('regency',function($query){
                    if($this->regency){
                        $query->where('regency_id', 'like', $this->regency->id.'%');
                    }
                    if($this->district){
                        $query->whereHas('district',function($q){
                            $q->where('id', 'like', $this->district->id.'%');
                        });
                    }
                });
            }
            if($this->jenis_kerja != null){
                // $posts->where('jeniskerja_id',$this->jenis_kerja);
                $posts->whereHas('jeniskerja',function($query){
                    $query->where('jenis_kerja_id',$this->jenis_kerja);
                });
            }
            // dd($this->kualif_lulus);
            if($this->kualif_lulus != null){
                $posts->whereHas('kualifikasilulus',function($query){
                    $query->where('kualifikasi_lulus_id',$this->kualif_lulus);
                });
            }
            if($this->peng_kerja != null){
                // $posts->where('pengalamankerja_id',$this->peng_kerja);
                $posts->whereHas('pengalamankerja',function($query){
                    $query->where('pengalaman_kerja_id',$this->peng_kerja);
                });
            }
            if($this->spes_kerja != null){
                // $posts->where('spesialiskerja_id',$this->spes_kerja);
                $posts->whereHas('spesialiskerja',function($query){
                    $query->where('spesialis_kerja_id',$this->spes_kerja);
                });
            }
            if($this->ting_kerja != null){
                // $posts->where('tingkatkerja_id',$this->ting_kerja);
                $posts->whereHas('tingkatkerja',function($query){
                    $query->where('tingkat_kerja_id',$this->ting_kerja);
                });
            }
            // dd($this->minrange.'-'.$this->maxrange);
            if($this->minrange != null){
                $posts->where('salary_start','>=',$this->minrange);
            }
            if($this->maxrange != null){
                $posts->where('salary_end','<=',$this->maxrange);
            }
            $post = $posts->get();
            if(count($post) >= 10){
                $post = $posts->paginate($this->perPage);
            }else{
                $post = $posts->get();
            }
            // dd($post);
            // $users = Post::search()->query(function ($builder) {
            //     $builder->whereHas('kualifikasilulus',function($query){
            //         $query->where('id',$this->kualif_lulus);
            //     });
            // })->get();
            // dd(Post::with(['author_employer'])->get());
            
            // $mypost = Post::search()->paginate();

        $no = 1;



        if($this->myid != 0){

            $post_detail = Post::with([

                'author', 

                'author_employer', 

                'images', 

                'jeniskerja', 

                'kualifikasilulus',

                'pengalamankerja',

                'spesialiskerja',

                'tingkatkerja',

                ])->find($this->myid);

            // $post_detail = $post->firstorfail()->toArray();

        }else{

            $post_detail = null;

        }

        $jobsave = Post::rightJoin('post_save', 'posts.id', 'post_save.post_id')->get();
        $getallpost = count(Post::all());

        // dd($getallpost);



                        

        return view('livewire.posts.berita', [

            'posts' => $post,

            'no' => $no,

            'thistime' => $now,

            'post_detail' => $post_detail,

            'simpan_job' => $jobsave,
            
            'postall' => $getallpost,



        ]);

    }



    public function saveJob($id){

        DB::table('post_save')->insert([

            'user_id' => Auth::user()->id,

            'post_id' => $id,

            'created_at' => now(),

            'updated_at' => now(),

        ]);

    }



    public function delSaveJob($id){

        DB::table('post_save')->where('post_id', $id)->delete();

    }

    public function previousPages(Request $request){
        $getpage = $request->serverMemo['data']['page'];
        $page = $getpage-1;
        return redirect('/dashboard/lowongan/sj_send=?page='.$page);
    }

    public function nextPages(Request $request){
        $getpage = $request->serverMemo['data']['page'];
        $page = $getpage+1;
        return redirect('/dashboard/lowongan/sj_send=?page='.$page);
    }



    public function countview($id)

    {

        $getdata = Post::select('views')

                        ->where('id', $id)

                        ->firstorfail()->toArray();

        $count = $getdata['views'] + '1';



        Post::where('id', $id)->update(['views' => $count]);

    }


    public function sendApply($id){
        $this->validate([
            'cv.*' => 'mimes:pdf|max:40000',
            'more_info' => 'required',
        ]);
        // dd($id);
        $post = Post::where('id', $id)->first();
        $author = Employer::where('id', $post->employer_id)->first();
        $title = "Surat Lamaran";
        if(Auth::user() != null ){
            $uname = Auth::user()->first_name." ".Auth::user()->last_name;
            $uid = Auth::user()->id;
            $ucv = Auth::user()->cv;
        }
        $utype = "user";
        $post = Notif::create([
            'title' => $title,
            'type' => $utype,
            'from' => $uid,
            'to' => $author->id,
            'desc' => $this->more_info,
            'post_id' => $post->id,
        ]);

        //Upload CV
        if($this->cv != null){
            if (count($this->cv) > 0) {
                $delfile = Storage::disk('public_uploads')->delete($ucv);
                $counter = 0;
                foreach ($this->cv as $cv) {

                    $storepublic = Storage::disk('public_uploads')->put('storage/cv', $cv);
                    $featured = false;
                    if($counter == 0 ){
                        $featured = true;
                    }
                    User::where(['id' => $uid])->update([
                        'cv' => $storepublic,
                        'featured' => $featured
                    ]);
                    $counter++;
                }
            }
        }
        $this->closeModal();
        $this->successModal();
    }

    public function openModal(){
        if(Auth::user() != null){
            $this->isOpen = true;
        }else{
            return redirect()->route('login');
        }
    }

    public function successModal(){
        $this->isSuccess = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->isSuccess = false;
    }

}

