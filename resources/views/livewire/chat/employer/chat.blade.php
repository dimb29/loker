@if($agent->isDesktop())
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <livewire:profil-nav/>
    </h2>
</x-slot>
@endif
    <div class="flex flex-row bg-white m-4">
        @if($agent->isMobile())
            @if($this->isAll)
                <div class="hidden sm:flex flex-col w-2/6 h-screen border-r-2 border-gray-200">
            @else
                <div class="flex flex-col w-full h-screen border-r-2 border-gray-200">
            @endif
        @else
            <div class="hidden sm:flex flex-col w-2/6 h-screen border-r-2 border-gray-200">
        @endif
            <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200 bg-blue-600 p-4 h-16" wire:poll.750m>
            @if($agent->isMobile())
                <a href="{{url('/')}}" class="text-white cursor-pointer my-auto"><i class="fa-solid fa-arrow-left hover:bg-blue-800 rounded-xl" wire:click="closeMobileChat"></i></a>
            @endif
            </div>
            @foreach($chat_lists as $chat_list)
            @if($chat_list->chat_to_user != null && $chat_list->chat_to_user->id != $this->usid)
                @if($chat_list->to == $this->usid || $chat_list->from == $this->usid)
                    @if($agent->isMobile())
                    <div x-data @click="resetMessage()" wire:click="openMobileChat([{{$chat_list->to}},'{{$chat_list->type_to}}',{{$chat_list->id}}])" class="flex flex-row w-full border-b-2 border-gray-200 hover:bg-gray-200 p-4 cursor-pointer">
                    @else
                    <div x-data @click="resetMessage()" wire:click="openChat([{{$chat_list->to}},'{{$chat_list->type_to}}',{{$chat_list->id}}])" class="flex flex-row w-full border-b-2 border-gray-200 hover:bg-gray-200 p-4 cursor-pointer">
                    @endif
                        @if($chat_list->chat_to_user->profile_photo_path != null)
                        <img src="{{url($chat_list->chat_to_user->profile_photo_path)}}" alt="profil user" class="h-6 w-6 sm:w-10 sm:h-10 rounded-full object-cover"/>
                        @else
                        <img src="{{url('storage/photos/default-logo.jpg')}}" alt="profil user" class="h-6 w-6 sm:w-10 sm:h-10 rounded-full object-cover"/>
                        @endif
                        <div class="flex flex-col ml-2 h-12">
                            <p class="font-bold">{{$chat_list->chat_to_user->first_name.' '. $chat_list->chat_to_user->last_name}}</p>
                            @foreach($singlechat as $schat)
                                @php
                                $cfrom = $chat_list->from; $this->cfrom = $cfrom;
                                $ctype = $chat_list->type; $this->ctype = $ctype;
                                if($this->usid == $cfrom):
                                    $cfrom = $chat_list->to; $this->cfrom = $cfrom;
                                    $ctype = $chat_list->type_to; $this->ctype = $ctype;
                                endif;
                                $singchat = $schat->orderBy('created_at', 'DESC')
                                    ->where(function ($quer){$quer->where('from', $this->usid)->where('to', $this->cfrom);})
                                    ->orWhere(function ($quer){$quer->where('from', $this->cfrom)->where('to', $this->usid);})
                                    ->where('type', 'user')->first();
                                $countchat = $schat->where(['from' => $chat_list->from, 'to' => $this->usid, 'read' => 1])->get();
                                @endphp
                                @if($loop->last)
                                <div class="flex flex-row text-sm text-gray-600 -mt-1 pl-1 w-full">
                                    <p class="p-1 break-all truncate w-72 md:w-36 lg:w-56">{!! Str::limit($singchat->desc, 66) !!}</p>
                                    @if($countchat->sum('read') != 0)
                                    <p class="text-white text-xs bg-green-400 rounded-2xl my-auto px-2 mr-0 right-0">{{$countchat->sum('read')}}</p>
                                    @endif
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @elseif($chat_list->chat_to_employer != null && $chat_list->chat_to_employer->id != $this->usid)
                @if($chat_list->to == $this->usid || $chat_list->from == $this->usid)
                @if($agent->isMobile())
                <div x-data @click="resetMessage()" wire:click="openMobileChat([{{$chat_list->to}},'{{$chat_list->type_to}}'])" class="flex flex-row w-full border-b-2 border-gray-200 hover:bg-gray-200 p-4 cursor-pointer">
                @else
                <div x-data @click="resetMessage()" wire:click="openChat([{{$chat_list->to}},'{{$chat_list->type_to}}'])" class="flex flex-row w-full border-b-2 border-gray-200 hover:bg-gray-200 p-4 cursor-pointer">
                @endif
                    @if($chat_list->chat_to_employer->profile_photo_path != null)
                    <img src="{{url($chat_list->chat_to_employer->profile_photo_path)}}" alt="profil user" class="h-6 w-6 sm:w-10 sm:h-10 rounded-full object-cover"/>
                    @else
                    <img src="{{url('storage/photos/default-logo.jpg')}}" alt="profil user" class="h-6 w-6 sm:w-10 sm:h-10 rounded-full object-cover"/>
                    @endif
                    <div class="flex flex-col ml-2 h-12">
                        <p class="font-bold">{{$chat_list->chat_to_employer->name}}</p>
                        @foreach($singlechat as $schat)
                            @php 
                            $cfrom = $chat_list->from; $this->cfrom = $cfrom;
                            $ctype = $chat_list->type; $this->ctype = $ctype;
                            if($this->usid == $cfrom):
                                $cfrom = $chat_list->to; $this->cfrom = $cfrom;
                                $ctype = $chat_list->type_to; $this->ctype = $ctype;
                            endif;
                            //dd('this user:'. $this->usid .' - dari:'. $this->cfrom);
                            $singchat2 = $schat->orderBy('created_at', 'DESC')
                                ->where(function ($quer){$quer->where('from', $this->cfrom)->where('to', $this->usid);})
                                ->orWhere(function ($quer){$quer->where('from', $this->usid)->where('to', $this->cfrom);})
                                ->where('type', 'user')->first();
                            $countchat = $schat->where(['from' => $chat_list->chat->from, 'to' => $this->usid, 'read' => 1])->get();
                            @endphp
                            @if($loop->last)
                            <!-- hidden md:hidden lg: -->
                            <div class="flex flex-row text-sm text-gray-600 -mt-1 pl-1 w-full">
                                <p class="p-1 break-all truncate w-72 md:w-36 lg:w-56">{!! Str::limit($singchat2->desc, 66) !!}</p>
                                @if($countchat->sum('read') != 0)
                                <p class="text-white text-xs bg-green-400 rounded-2xl my-auto px-2 mr-0 right-0">{{$countchat->sum('read')}}</p>
                                @endif
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            @else
            @endif
            @endforeach
        </div>
        @if($agent->isMobile())
        @if($this->isAll)
        <div class="flex-1 justify-between flex flex-col h-screen" x-data="{SendMessage:false}">
        @else
        <div class="hidden sm:flex-1 justify-between flex flex-col h-screen" x-data="{SendMessage:false}">
        @endif
        @else
        <div class="flex-1 justify-between flex flex-col h-screen" x-data="{SendMessage:false}">
        @endif
            @if($chatOpen)
            <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200 bg-blue-600 p-4 h-16">
                <div class="relative flex items-center space-x-4">
                    @if($totype == 'employer')
                        @if($agent->isMobile())
                            @if($this->isAll)
                            <i class="fa-solid fa-arrow-left text-white cursor-pointer hover:bg-blue-800 rounded-xl" wire:click="closeChat"></i>
                            @else
                            <i class="fa-solid fa-arrow-left text-white cursor-pointer hover:bg-blue-800 rounded-xl" wire:click="closeMobileChat"></i>
                            @endif
                        @endif
                        <div class="relative">
                        @if($headchat->profile_photo_path != null)
                        <img src="{{url($headchat->profile_photo_path)}}" alt="" class="w-6 sm:w-10 h-6 sm:h-10 rounded-full object-cover">
                        @else
                        <img src="{{url('storage/photos/default-logo.jpg')}}" alt="" class="w-6 sm:w-10 h-6 sm:h-10 rounded-full object-cover">
                        @endif
                        </div>
                        <div class="flex flex-col leading-tight">
                            <div class="text-lg mt-1 flex items-center">
                            <span class="text-white mr-3">{{$headchat->name}}</span>
                            </div>
                            <span class="text-sm text-white">{{$totype}}</span>
                        </div>
                    @elseif($totype == 'user')
                        @if($agent->isMobile())
                            @if($this->isAll)
                            <i class="fa-solid fa-arrow-left text-white cursor-pointer hover:bg-blue-800 rounded-xl" wire:click="closeChat"></i>
                            @else
                            <i class="fa-solid fa-arrow-left text-white cursor-pointer hover:bg-blue-800 rounded-xl" wire:click="closeMobileChat"></i>
                            @endif
                        @endif
                        <div class="relative">
                        @if($headchat->profile_photo_path != null)
                        <img src="{{url($headchat->profile_photo_path)}}" alt="" class="w-6 sm:w-10 h-6 sm:h-10 rounded-full object-cover">
                        @else
                        <img src="{{url('storage/photos/default-logo.jpg')}}" alt="" class="w-6 sm:w-10 h-6 sm:h-10 rounded-full object-cover">
                        @endif
                        </div>
                        <div class="flex flex-col leading-tight">
                            <div class="text-lg mt-1 flex items-center">
                            <span class="text-white mr-3">{{$headchat->first_name .' '. $headchat->last_name}}</span>
                            </div>
                            <span class="text-sm text-white">{{$totype}}</span>
                        </div>
                    @endif
                </div>
                <div class="flex items-center space-x-2">
                    <button type="button" class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-white hover:bg-blue-900 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                    <!-- <button type="button" class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button> -->
                </div>
            </div>
            <div id="messages"
            class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                @foreach($chats as $chatkeys => $chat)
                    @if(Auth::guard('employer')->user()->id == $chats[$chatkeys]['from'])
                        <div class="chat-message" wire:poll.750ms>
                            <div class="flex items-end justify-end">
                                @php
                                    $this_value = $chats[$chatkeys];
                                    if(isset($chats[$chatkeys+1])){
                                        $nextval = $chats[$chatkeys+1];
                                    }else{
                                        $nextval = ['from' => null];
                                    }
                                @endphp
                                @if($nextval['from'] == $this_value['from'])
                                <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end pr-6">
                                    <div><span class="px-4 py-2 rounded-lg inline-block bg-blue-600 text-white whitespace-pre-line">{!! $chat->desc !!}</span></div>
                                </div>
                                @else
                                <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
                                    <div><span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white whitespace-pre-line">{!! $chat->desc !!}</span></div>
                                </div>
                                @if($chats[$chatkeys]['chat_employer']->profile_photo_path != null)
                                <img src="{{url($chats[$chatkeys]['chat_employer']->profile_photo_path)}}" alt="My profile" class="w-6 h-6 rounded-full order-1 object-cover">
                                @else
                                <img src="{{url('storage/photos/default-logo.jpg')}}" alt="My profile" class="w-6 h-6 rounded-full order-1 object-cover">
                                @endif
                                @endif
                            </div>
                        </div>
                    @elseif(Auth::guard('employer')->user()->id == $chat->to)
                        <div class="chat-message" wire:poll.750ms>
                            <div class="flex items-end">
                                @php
                                    $this_value = $chats[$chatkeys];
                                    if(isset($chats[$chatkeys+1])){
                                        $nextval = $chats[$chatkeys+1];
                                    }else{
                                        $nextval = ['from' => null];
                                    }
                                @endphp
                                @if($nextval['from'] == $this_value['from'])
                                <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start pl-6">
                                    <div><span class="px-4 py-2 rounded-lg inline-block bg-gray-300 text-gray-600 whitespace-pre-line">{!! $chat->desc !!}</span></div>
                                </div>
                                @else
                                <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                                    <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600 whitespace-pre-line">{!! $chat->desc !!}</span></div>
                                </div>
                                    @if($chat->type == 'user')
                                        @if($chats[$chatkeys]['chat_user']->profile_photo_path != null)
                                        <img src="{{url($chats[$chatkeys]['chat_user']->profile_photo_path)}}" alt="My profile" class="w-6 h-6 rounded-full order-1 object-cover">
                                        @else
                                        <img src="{{url('storage/photos/default-logo.jpg')}}" alt="My profile" class="w-6 h-6 rounded-full order-1 object-cover">
                                        @endif
                                    @else
                                        @if($chats[$chatkeys]['chat_employer']->profile_photo_path != null)
                                        <img src="{{url($chats[$chatkeys]['chat_employer']->profile_photo_path)}}" alt="My profile" class="w-6 h-6 rounded-full order-1 object-cover">
                                        @else
                                        <img src="{{url('storage/photos/default-logo.jpg')}}" alt="My profile" class="w-6 h-6 rounded-full order-1 object-cover">
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
                <div class="relative flex">
                    <span class="absolute inset-y-0 flex items-center">
                        <button type="button" class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                        </svg>
                        </button>
                    </span>
                    <!-- <div class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3"></div> -->
                    <div wire:ignore class="w-full h-10">
                        <textarea
                            class="shadow appearance-none border rounded w-full h-12 pt-3 pl-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="minput" wire:model="minput" >
                        </textarea>
                    </div>

                    <div class="absolute right-16 items-center inset-y-0 hidden sm:flex">
                        <button type="button" class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                        </button>
                        <button type="button" class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        </button>
                        <button type="button" class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        </button>
                    </div>
                    <button wire:click="SendMessage()" @click="resetMessage()"
                    type="button" class="inline-flex items-center justify-center rounded-lg px-4 py-3 ml-1 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                        <span class="font-bold"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 ml-2 transform rotate-90">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
        </div>
    </div>
    
<style>
.scrollbar-w-2::-webkit-scrollbar {
  width: 0.25rem;
  height: 0.25rem;
}

.scrollbar-track-blue-lighter::-webkit-scrollbar-track {
  --bg-opacity: 1;
  background-color: #f7fafc;
  background-color: rgba(247, 250, 252, var(--bg-opacity));
}

.scrollbar-thumb-blue::-webkit-scrollbar-thumb {
  --bg-opacity: 1;
  background-color: #edf2f7;
  background-color: rgba(237, 242, 247, var(--bg-opacity));
}

.scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
  border-radius: 0.25rem;
}
</style>

<script>
const elp = document.getElementById('messages')
elp.scrollTop = elp.scrollHeight
    function resetMessage(){
        setTimeout(function() {
            const el = document.getElementById('messages')
            el.scrollTop = el.scrollHeight
        },1000)
    }
</script>