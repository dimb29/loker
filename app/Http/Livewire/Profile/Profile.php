<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;
use App\Models\BidangKerja;
use App\Models\Notification as Notif;
use Jenssegers\Agent\Agent;

class Profile extends Component
{
    public $post,$infoOpen=0,$imgOpen=0,$headerOpen=0,$authId,$usrtype,$er_followingId,$er_followerId,$ing_followingId,$ing_folowerId,$getfollower,$getfollowing;

    public function mount($id){
        // $this->udata = User::where('profile_url', $id)->first();
        $this->udata = User::where('profile_url', $id)->first();
        // dd($this->udata);
    }
    public function render()
    {
        if(Auth::user() != null){
            $this->authId = Auth::user()->id;
            $this->usrtype = 'user';
            $this->getfollowing = Follow::where(['following_id' => $this->authId, 'follower_id' => $this->udata->id])->first();
            $this->getfollower = Follow::where(['following_id' => $this->udata->id, 'follower_id' => $this->authId])->first();
            // dd(Auth::user()->follower);
            // if(Auth::user()->follower != null){
            //     $this->er_followingId = Auth::user()->follower[0]->following_id;
            //     $this->er_followerId = Auth::user()->follower[0]->follower_id;
            // }elseif(Auth::user()->following != null){
            //     $this->ing_followingId = Auth::user()->following[0]->following_id;
            //     $this->ing_folowerId = Auth::user()->following[0]->follower_id;
            // }
        }elseif(Auth::guard('employer')->user() != null){
            $this->authId = Auth::guard('employer')->user()->id;
            $this->usrtype = 'employer';
        }
        return view('livewire.profile.profile',[
            'agent' => new Agent(),
        ]);
    }
    public function followUser(){
        // dd('cuk');
        if(Auth::user() || Auth::guard('employer')->user()){
            $addfollow = Follow::create([
                'follower_id' => $this->authId,
                'following_id' => $this->udata->id,
                'type'      => $this->usrtype,
                'type_to'      => 'user',
            ]);
            $addtonotif = Notif::create([
                'notif_type' => 4,
                'type'      => $this->usrtype,
                'from'      => $this->authId,
                'type_to'      => 'user',
                'to'        => $this->udata->id,
            ]);
        }else{
            return redirect('login');
        }
    }
    public function followbackUser(){
        $addfollow = Follow::create([
            'follower_id' => $this->authId,
            'following_id' => $this->udata->id,
            'type' => $this->usrtype,
            'type_to' => 'user',
        ]);
        $addtonotif = Notif::where([
            'from' => $this->udata->id,
            'to' => $this->authId, 
            'type' => $this->usrtype, 
            'type_to' => 'user'
            ])->update([
            'read' => 0,
        ]);
    }
    public function openChat($id){
        $data = $id."&user";
        $hash = Crypt::encryptString($data);
        // $dechash = Crypt::decryptString($data);
        $agent = new Agent();
        if($agent->isMobile()){
            if($this->usrtype == 'user'){
                return redirect()->to('user/chat/'.$hash);
            }else{
                return redirect()->to('employer/chat/'.$hash);
            }
        }else{
            $this->emit('receiveChatSignal', $hash);
        }

    }
    public function unfollowUser(){
        $getfollower = Follow::where('following_id', $this->udata->id)
        ->where('follower_id', $this->authId)
        ->where('type_to', 'user')
        ->where('type', $this->usrtype)->first();
        // dd($getfollower);
        $unfoll = Follow::where('id', $getfollower->id)->delete();

    }
    public function openInfo(){
        $this->infoOpen = true;
    }
    public function closeInfo(){
        $this->infoOpen = false;
    }

    public function openImg(){
        $this->imgOpen = true;
    }
    public function closeImg(){
        $this->imgOpen = false;
    }

    public function openHeader(){
        $this->headerOpen = true;
    }
    public function closeHeader(){
        $this->headerOpen = false;
    }
}
