<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post as PostModel;
use App\Models\Employer;
use App\Models\User;
use App\Models\Notification as Notif;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;

class Post extends Component
{
    use WithFileUploads;

    public $post, $isOpen = 0, $isSuccess = 0;
    public $cv, $acv, $more_info, $post_id;

    public function mount($id)
    {
        $post = $this->post = PostModel::with([
            'author', 
            'images', 
            'videos', 
            'jeniskerja', 
            'kualifikasilulus',
            'pengalamankerja',
            'spesialiskerja',
            'tingkatkerja',
            'perusahaan',
            'author_employer',
            ])->find($id);
        if(Auth::user() != null){
            $this->acv = Auth::user()->cv;
        }

        
    }

    public function render()
    {
        
        
        $jobsave = PostModel::rightJoin('post_save', 'posts.id', 'post_save.post_id')->get();
        

        return view('livewire.posts.post', [

        'simpan_job' => $jobsave,
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

    public function sendApply($id){
        $this->validate([
            'cv.*' => 'mimes:pdf|max:40000',
            'more_info' => 'required',
        ]);
        // dd($id);
        $post = postModel::where('id', $id)->first();
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
