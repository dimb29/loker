<?php

namespace App\Http\Livewire\Profile\Employer;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Employer;
use App\Models\Follow;
use App\Models\BidangKerja;
use App\Models\Notification as Notif;
use Jenssegers\Agent\Agent;

class Profile extends Component
{
    public $post,$infoOpen=0,$authId,$usrtype,$er_followingId,$er_followerId,$ing_followingId,$ing_folowerId,$getfollower,$getfollowing,$thistime;

    public function mount($id){
        // $hash = Crypt::encryptString('1');
        // $dechash = Crypt::decryptString($id);
        $this->udata = Employer::where('profile_url', $id)->first();
        // dd($this->udata);
    }
    public function render()
    {
        if(Auth::user() != null){
            $this->authId = Auth::user()->id;
            $this->usrtype = 'user';
            // $this->getfollowing = Follow::where(['following_id' => $this->authId, 'follower_id' => $this->udata->id, 'type' => 'user'])->first();
            $this->getfollower = Follow::where(['following_id' => $this->udata->id, 'follower_id' => $this->authId, 'type' => 'employer'])->first();
        }elseif(Auth::guard('employer')->user() != null){
            $this->authId = Auth::guard('employer')->user()->id;
            $this->usrtype = 'employer';
        }
        $this->thistime = Carbon::now();
        return view('livewire.profile.employer.profile',[
            'agent' => new Agent(),
        ]);
    }
    public function followUser(){
        if(Auth::user() || Auth::guard('employer')->user()){
            $addfollow = Follow::create([
                'follower_id' => $this->authId,
                'following_id' => $this->udata->id,
                'type'      => $this->usrtype,
                'type_to'      => 'employer',
            ]);
            $addtonotif = Notif::create([
                'notif_type' => 4,
                'type'      => $this->usrtype,
                'from'      => $this->authId,
                'type_to'      => 'employer',
                'to'        => $this->udata->id,
            ]);
        }else{
            return redirect('login');
        }
    }
    public function followbackUser(){
        // $addfollow = Follow::create([
        //     'follower_id' => $this->authId,
        //     'following_id' => $this->udata->id,
        // ]);
        // $addtonotif = Notif::where(['from' => $this->udata->id, 'to' => $this->authId, 'type' => 'employer', 'type_to' => $this->usrtype])->update([
        //     'read' => 0,
        // ]);
    }
    public function openChat($id){
        $data = $id."&employer";
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
        ->where('type_to', 'employer')
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
}
