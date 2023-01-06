<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Agent\Agent;
use App\Models\Chat as Chats;
use App\Models\ChatList;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Database\Eloquent\Builder;

class Chat extends Component
{
    public $minput,$toid,$totype,$chatOpen=0,$chat_list_id,$mlistid,$isAll;
    protected $singlechat;

    public function mount($id){
        $usid = Auth::user()->id;
        $this->usid = $usid;
        // dd(strlen($id));
        if(strlen($id) == 3){
            $this->isAll = false;
        }else{
            $this->isAll = true;
            $dechash = Crypt::decryptString($id);
            $split_data = explode('&', $dechash);
            if(count($split_data) > 1){
                $this->openChat($split_data);
            }
        }
    }
    public function render()
    {
        $chats = Chats::with(['chat_user', 'chat_employer'])->orderBy('created_at', 'ASC')->where(['from' => $this->usid, 'to' => $this->toid])->orWhere(['from' => $this->toid])->get();

        $chat_list = ChatList::with(['chat','chat_to_user','chat_to_employer'])
            ->where(function(Builder $q){
                $q->where('to', $this->usid)
                ->orWhere('from', $this->usid);
            })
            ->orderBy('updated_at', 'DESC')->get();
         $singlechat = Chats::all();
        if($this->totype == 'user' || $this->totype == null):
            $headchat = User::where(['id' => $this->toid])->first();
        elseif($this->totype == 'employer'):
            $headchat = Employer::where(['id' => $this->toid])->first();
        endif;
        // dd($chat_list);
        $agent = new Agent();
        // dd($agent->isMobile());
        return view('livewire.chat.chat',[
            'singlechat' => $singlechat,
            'chats' => $chats,
            'headchat' => $headchat,
            'chat_lists' => $chat_list,
            'agent' => $agent,
        ]);
    }
    public function openChat($data){
    // public function openChat($id,$type,$mlistid){
        // dd($data);
        $this->toid = $data[0];
        $this->totype = $data[1];
        // $this->mlistid = $data[2];
        $this->chatOpen = true;
        $this->readChat();
    }
    public function closeChat(){
        $this->isAll = false;
    }
    public function openMobileChat($data){
        $this->toid = $data[0];
        $this->totype = $data[1];
        $this->isAll = true;
        $this->chatOpen = true;
        $this->readChat();
    }
    public function closeMobileChat(){
        if($this->isAll){
            $this->isAll = false;
            return redirect('/user/chat/all');
        }
    }
    public function SendMessage(){
        $usid = Auth::user()->id;
        // dd($this->minput);
        $getlistfrom = ChatList::where(['from' => $usid, 'to' => $this->toid, 'type' => 'user', 'type_to' => $this->totype])->first();
        $getlistto = ChatList::where(['to' => $usid, 'from' => $this->toid, 'type_to' => 'user', 'type' => $this->totype])->first();

        if($getlistfrom != null){
            ChatList::where(['from' => $usid, 'to' => $this->toid, 'type' => 'user', 'type_to' => $this->totype])
            ->update([
                'type' => 'user',
                'updated_at' => now(),
            ]);
        }else{
            $mlist = ChatList::create([
                'type' => 'user',
                'from' => $usid,
                'type_to' => $this->totype,
                'to' => $this->toid,
            ]);
        }

        if($getlistto != null){
            ChatList::where(['to' => $usid, 'from' => $this->toid, 'type_to' => 'user', 'type' => $this->totype])
            ->update([
                'type' => $this->totype,
                'updated_at' => now(),
            ]);
        }else{
            $mlistto = ChatList::create([
                'type_to' => 'user',
                'to' => $usid,
                'type' => $this->totype,
                'from' => $this->toid,
            ]);
        }
        if($getlistfrom != null && $getlistto != null){
            $mlist_id = $getlistfrom->id;
        }else{
            $mlist_id = $mlist->id;
            // if($getlistto != null){
            //     $mlist_id = $mlist->id;
            // }else{
            //     $mlist_id = $mlistto->id;
            // }
        }
        $msend = Chats::create([
            'chat_list_id' => $mlist_id,
            'desc' => $this->minput,
            'type' => 'user',
            'from' => $usid,
            'to' => $this->toid,
            'type_to' => $this->totype,
        ]);

        $this->minput = null;
        // session()->flash('message','uo uo uo');

    }
    public function readChat(){
        $readchat = Chats::where(['to' => $this->usid, 'from' => $this->toid, 'type_to' => 'user'])->update(['read' => 0]);
        // dd($readchat);
    }
}
