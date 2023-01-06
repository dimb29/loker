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

class ChatPop extends Component
{
    public $minput,$toid,$totype,$fromtype,$chatOpen=0,$chat_list_id,$mlistid,$isAll,$openChatBox = true,$closeChatBox;
    protected $singlechat;

    protected $listeners = [
        'receiveChatSignal'
    ];

    public function receiveChatSignal($id){
        // dd($id);
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
        $this->openChatBox();
    }
    // public function mount($id){
    //     $usid = Auth::user()->id;
    //     $this->usid = $usid;
    //     // dd(strlen($id));
    //     if(strlen($id) == 3){
    //         $this->isAll = false;
    //     }else{
    //         $this->isAll = true;
    //         $dechash = Crypt::decryptString($id);
    //         $split_data = explode('&', $dechash);
    //         if(count($split_data) > 1){
    //             $this->openChat($split_data);
    //         }
    //     }
    // }
    public function render()
    {
        if(Auth::guard('employer')->user()){
            $usid = Auth::guard('employer')->user()->id;
            $this->usid = $usid;
            $fromtype = $this->fromtype = 'employer';

        }elseif(Auth::user()){
            $usid = Auth::user()->id;
            $this->usid = $usid;
            $fromtype = $this->fromtype = 'user';
        }
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
        return view('livewire.chat.chat-pop',[
            'singlechat' => $singlechat,
            'chats' => $chats,
            'headchat' => $headchat,
            'chat_lists' => $chat_list,
            'agent' => $agent,
        ]);
    }
    public function openChat($data){
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
        $usid = $this->usid;
        // dd($this->minput);
        $getlistfrom = ChatList::where(['from' => $usid, 'to' => $this->toid, 'type' => $this->fromtype, 'type_to' => $this->totype])->first();
        $getlistto = ChatList::where(['to' => $usid, 'from' => $this->toid, 'type_to' => $this->fromtype, 'type' => $this->totype])->first();

        if($getlistfrom != null){
            ChatList::where(['from' => $usid, 'to' => $this->toid, 'type' => $this->fromtype, 'type_to' => $this->totype])
            ->update([
                'type' => $this->fromtype,
                'updated_at' => now(),
            ]);
        }else{
            $mlist = ChatList::create([
                'type' => $this->fromtype,
                'from' => $usid,
                'type_to' => $this->totype,
                'to' => $this->toid,
            ]);
        }

        if($getlistto != null){
            ChatList::where(['to' => $usid, 'from' => $this->toid, 'type_to' => $this->fromtype, 'type' => $this->totype])
            ->update([
                'type' => $this->totype,
                'updated_at' => now(),
            ]);
        }else{
            $mlistto = ChatList::create([
                'type_to' => $this->fromtype,
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
            'type' => $this->fromtype,
            'from' => $usid,
            'to' => $this->toid,
            'type_to' => $this->totype,
        ]);

        $this->minput = null;
        // session()->flash('message','uo uo uo');

    }
    public function readChat(){
        $readchat = Chats::where(['to' => $this->usid, 'from' => $this->toid, 'type_to' => $this->fromtype])->update(['read' => 0]);
        // dd($readchat);
    }

    public function openChatBox(){
        $this->openChatBox = true;
    }
    public function closeChatBox(){
        $this->openChatBox = false;
    }
}
