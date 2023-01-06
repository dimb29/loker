<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use App\Models\User;
use App\Models\Employer;
use App\Models\Post as Loker;
use App\Models\Follow;
use App\Models\Notification as Notif;
use App\Models\OnClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class SearchShow extends Component
{
    public $search_bar,$getfollowing,$getfollower,$authId,$usertype,$usid,$emid,$select_type,$array_select;
    public function mount($id){
        $split = explode('=', $id);
        $this->search_bar = $split[1];
        $this->selectType(0);
    }
    public function render()
    {
        if(Auth::user() != null){
            $this->authId = Auth::user()->id;
            $this->usid = Auth::user()->id;
            $this->usertype = 'user';
            $authfollower = Auth::user()->follower;
            $authfollowing = Auth::user()->following;
        }elseif(Auth::guard('employer')->user() != null){
            $this->emid = Auth::guard('employer')->user();
            $this->authId = Auth::guard('employer')->user()->id;
            $this->usertype = 'employer';
            $authfollower = Auth::guard('employer')->user()->follower;
            $authfollowing = Auth::guard('employer')->user()->following;
        }

        $search_loker = Loker::orderBy('created_at', 'DESC');
        $search_user = User::where('id', '!=', $this->usid);
        $search_employer = Employer::where('id', '!=', $this->emid);
        $search_class = OnClass::with('materi')->orderBy('created_at', 'DESC');

        $searchbars = explode(' ', $this->search_bar);
        foreach($searchbars as $searchbar){
            $search_loker->where(function($q) use ($searchbar){
                $q->where('title', 'like', '%'.$searchbar.'%');
            });
            $search_user->where(function($q) use ($searchbar){
                $q->where('first_name', 'like', '%'.$searchbar.'%')
                ->orWhere('last_name', 'like', '%'.$searchbar.'%');
            });
            $search_employer->where(function($q) use ($searchbar){
                $q->where('name','like', '%'.$searchbar.'%');
            });
            $search_class->where(function($q) use ($searchbar){
                $q->where('title', 'like', '%'.$searchbar.'%')
                ->orWhere('content', 'like', '%'.$searchbar.'%');
            });
        }
        $search_loker = $search_loker->take(5)->get();
        $search_class = $search_class->take(5)->get();

        if($this->select_type == 1):
            $search_user = $search_user->get();
        else:
            $search_user = $search_user->take(5)->get();
        endif;

        if($this->select_type == 2):
            $search_employer = $search_employer->get();
        else:
            $search_employer = $search_employer->take(5)->get();
        endif;

        $jobsave = Loker::rightJoin('post_save', 'posts.id', 'post_save.post_id')->get();
        // $this->getfollowing = Follow::where(['following_id' => $this->authId])->first();
        // $this->getfollower = Follow::where(['follower_id' => $this->authId])->first();
        $data_follow = Follow::all();

        return view('livewire.search.search-show', [
            'search_loker' => $search_loker,
            'search_user' => $search_user,
            'search_employer' => $search_employer,
            'search_class' => $search_class,
            'simpan_job' => $jobsave,
            'data_follow' => $data_follow,
        ]);
    }

    public function selectType($id){
        if($id == 1):
            $this->array_select = [
                ['id' => 0, 'name' => 'Semua', 'type' => 0],
                ['id' => 1, 'name' => 'Pengguna', 'type' => 1],
                ['id' => 2, 'name' => 'Perusahaan', 'type' => 0],
            ];
        elseif($id == 2):
            $this->array_select = [
                ['id' => 0, 'name' => 'Semua', 'type' => 0],
                ['id' => 1, 'name' => 'Pengguna', 'type' => 0],
                ['id' => 2, 'name' => 'Perusahaan', 'type' => 1],
            ];
        else:
            $this->array_select = [
                ['id' => 0, 'name' => 'Semua', 'type' => 1],
                ['id' => 1, 'name' => 'Pengguna', 'type' => 0],
                ['id' => 2, 'name' => 'Perusahaan', 'type' => 0],
            ];
        endif;
        $this->select_type = $id;
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

    public function followUser($id){
        $userid = $id[0];
        $user_type = $id[1];
        if(Auth::user() || Auth::guard('employer')->user()){
            $addfollow = Follow::create([
                'type_to' => $user_type,
                'follower_id' => $this->authId,
                'type' => $this->usertype,
                'following_id' => $userid,
            ]);
            $addtonotif = Notif::create([
                'notif_type' => 4,
                'type'      => $this->usertype,
                'from'      => $this->authId,
                'type_to'      => $user_type,
                'to'        => $userid,
            ]);
        }else{
            return redirect('login');
        }
    }
    public function followbackUser($id){
        $userid = $id[0];
        $user_type = $id[1];
        $addfollow = Follow::create([
            'type' => $this->usertype,
            'type_to' => $user_type,
            'follower_id' => $this->authId,
            'following_id' => $userid,
        ]);
        $addtonotif = Notif::where([
            'notif_type' => 4,
            'from' => $userid, 
            'to' => $this->authId, 
            'type' => $this->usertype, 
            'type_to' => $user_type
            ])->update([
            'read' => 0,
        ]);
    }
    public function unfollowUser($id){
        $userid = $id[0];
        $user_type = $id[1];
        $getfollower = Follow::where('following_id', $userid)->where('follower_id', $this->authId)->where('type_to', $user_type)->where('type', $this->usertype)->first();
        // dd($getfollower);
        $unfoll = Follow::where('id', $getfollower->id)->delete();

    }
    public function openChat($id){
        $userid = $id[0];
        $user_type = $id[1];
        $data = $userid."&".$user_type;
        $hash = Crypt::encryptString($data);
        // $dechash = Crypt::decryptString($data);
        if($this->usertype == 'user'){
            return redirect()->to('user/chat/'.$hash);
        }else{
            return redirect()->to('employer/chat/'.$hash);
        }
    }
    
}
