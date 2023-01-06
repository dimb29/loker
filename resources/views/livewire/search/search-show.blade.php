<x-slot name="header">
</x-slot>

<x-slot name="footer">
</x-slot>
<div class="min-h-screen overflow-hidden py-0 sm:py-0 flex sm:flex-row flex-col" id="show-top">
    <div class="hidden sm:flex sm:flex-col w-1/4 border-r border-solid bg-white sm:py-4 py-2 px-2">
        <p class="mb-4 text-lg font-bold">Hasil Pencarian</p>
        <div class="flex flex-col w-full">
            @foreach($array_select as $select_search)
            @if($select_search['type'] == 1)
            <p wire:click="selectType({{$select_search['id']}})" onclick="window.scrollTo(0, 0)" class="my-2 p-2 px-3 text-md font-bold text-blue-700 border-r-4 border-solid border-blue-700 rounded-lg hover:bg-gray-300 cursor-pointer">{{$select_search['name']}}</p>
            @else
            <p wire:click="selectType({{$select_search['id']}})" onclick="window.scrollTo(0, 0)" class="my-2 p-2 px-3 text-md font-semibold rounded-lg hover:bg-gray-300 cursor-pointer">{{$select_search['name']}}</p>
            @endif
            @endforeach
        </div>
    </div>
    <div class="flex sm:hidden flex-row w-full text-center border border-solid bg-white">
        @foreach($array_select as $select_search)
        @if($select_search['type'] == 1)
        <p wire:click="selectType({{$select_search['id']}})" onclick="window.scrollTo(0, 0)" class="p-2 px-3 text-md font-bold text-blue-700 border-b-2 border-solid border-blue-700 hover:bg-gray-300 cursor-pointer">{{$select_search['name']}}</p>
        @else
        <p wire:click="selectType({{$select_search['id']}})" onclick="window.scrollTo(0, 0)" class="p-2 px-3 text-md font-semibold hover:bg-gray-300 cursor-pointer">{{$select_search['name']}}</p>
        @endif
        @endforeach
    </div>
    <div class="flex flex-col w-full sm:w-3/4 sm:my-6 sm:mx-7">
    <!-- if you want the keyboard insert number with symbol, just change the inputmode value from "numeric" to "tel" -->
    <!-- if you use alpine js just change attribute inputmode to x-inputmode -->
    <!-- <input inputmode="numeric" pattern="[0-9]*" class="border boder-solid rounded w-36 py-2 px-3"> -->

        <!-- Loker -->
        @if($select_type == 0)
        @if(count($search_loker) > 0)
        <div class="w-full lg:w-3/5 mx-auto shadow rounded-lg bg-white my-4 sm:my-4 py-4 px-2 sm:px-4">
            <p class="text-lg font-semibold mb-3">Lowongan Pekerjaan</p>
            @foreach($search_loker as $search_data)
            <div class="flex flex-row w-full mb-2 shadow rounded-lg bg-gray-300 px-2 py-1">
                <div onclick="window.open(`{{url('posts/'.$search_data->id)}}`, '_self')" class="my-auto mr-2 cursor-pointer aash">
                    @if(count($search_data->images) > 0)
                        @foreach($search_data->images as $images)
                            @if($loop->first)
                                <img src="{{url($images->url)}}" alt="" class="w-10 h-10 my-auto mx-auto rounded-lg bg-white border border-solid border-gray-400 object-contain">
                            @endif
                        @endforeach
                    @else
                    <div class="w-10 h-10 my-auto mx-auto px-3 py-2 rounded-lg bg-white border border-solid border-gray-400">
                        <i class="fa-solid fa-magnifying-glass my-auto mx-auto text-center"></i>
                    </div>
                    @endif
                </div>
                <div onclick="window.open(`{{url('posts/'.$search_data->id)}}`, '_self')" class="my-auto cursor-pointer hover:text-blue-700 w-9/12">
                    <p>{{$search_data->title}}</p>
                    <p class="mt-1 text-xs text-blue-900">Loker</p>
                </div>
                <div class="flex flex-row my-auto ccsh">
                    <p class="w-4/5"></p>
                    @if(Auth::user() != null)
                        @php $getpostid = null @endphp
                        @foreach($simpan_job as $simjob)
                            @if($simjob->post_id == $search_data->id)
                                @php $getpostid = $simjob->post_id @endphp
                            @endif
                        @endforeach
                        @if($getpostid == $search_data->id)
                            <div wire:click="delSaveJob({{$search_data->id}})" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer">
                                <i class="fa-solid fa-bookmark my-auto"></i>
                            </div>
                        @else
                            <div wire:click="saveJob({{$search_data->id}})" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer">
                                <i class="fa-regular fa-bookmark my-auto"></i>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
            @if(count($search_loker) >= 5)
            <div onclick="window.open(`{{url('class/sc_send='.$search_bar)}}`, '_self')" class="my-auto px-3 pt-2 w-full border-t border-solid cursor-pointer hover:text-blue-700">
                <p class="mx-auto text-center"> Lihat Semua</p>
            </div>
            @endif
        </div>
        @endif
        @endif
        <!-- Kelas -->
        @if($select_type == 0 || $select_type == 4)
        @if(count($search_class) > 0)
        <div class="w-full lg:w-3/5 mx-auto shadow rounded-lg bg-white my-4 sm:my-4 py-4 px-2 sm:px-4">
            <p class="text-lg font-semibold mb-3">Lowongan Pekerjaan</p>
            @foreach($search_class as $search_data)
            <div class="flex flex-row w-full mb-2 shadow rounded-lg bg-gray-300 px-2 py-1">
                <div onclick="window.open(`{{url('onclass/'.$search_data->id)}}`, '_self')" class="my-auto mr-2 cursor-pointer aash">
                    @if(count($search_data->images) > 0)
                        @foreach($search_data->images as $images)
                            @if($loop->first)
                                <img src="{{url($images->url)}}" alt="" class="w-10 h-10 my-auto mx-auto rounded-lg bg-white border border-solid border-gray-400 object-contain">
                            @endif
                        @endforeach
                    @else
                    <div class="w-10 h-10 my-auto mx-auto px-3 py-2 rounded-lg bg-white border border-solid border-gray-400">
                        <i class="fa-solid fa-magnifying-glass my-auto mx-auto text-center"></i>
                    </div>
                    @endif
                </div>
                <div onclick="window.open(`{{url('onclass/'.$search_data->id)}}`, '_self')" class="my-auto cursor-pointer hover:text-blue-700 w-9/12">
                    <p>{{$search_data->title}}</p>
                    <p class="mt-1 text-xs text-blue-900">Loker</p>
                </div>
                <div class="flex flex-row my-auto ccsh">
                    <p class="w-4/5"></p>
                    @if(Auth::user() != null)
                        @php $getpostid = null @endphp
                        @foreach($simpan_job as $simjob)
                            @if($simjob->post_id == $search_data->id)
                                @php $getpostid = $simjob->post_id @endphp
                            @endif
                        @endforeach
                        @if($getpostid == $search_data->id)
                            <div wire:click="delSaveClass({{$search_data->id}})" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer">
                                <i class="fa-solid fa-bookmark my-auto"></i>
                            </div>
                        @else
                            <div wire:click="saveClass({{$search_data->id}})" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer">
                                <i class="fa-regular fa-bookmark my-auto"></i>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
            @if(count($search_class) >= 5)
            <div onclick="window.open(`{{url('class/sc_send='.$search_bar)}}`, '_self')" class="my-auto px-3 pt-2 w-full border-t border-solid cursor-pointer hover:text-blue-700">
                <p class="mx-auto text-center"> Lihat Semua</p>
            </div>
            @endif
        </div>
        @endif
        @endif
        <!-- User -->
        @if($select_type == 0 || $select_type == 1)
        @if(count($search_user) > 0)
        <div class="w-full lg:w-3/5 mx-auto shadow rounded-lg bg-white my-4 sm:my-4 py-4 px-2 sm:px-4">
            <p class="text-lg font-semibold mb-3">Pengguna</p>
            @foreach($search_user as $search_data)
            <div class="flex flex-row w-full mb-2 shadow rounded-full bg-gray-300 px-2 py-1">
                <div onclick="window.open(`{{url('users/'.$search_data->profile_url)}}`, '_self')" class="my-auto mr-2 cursor-pointer aash">
                    @if($search_data->profile_photo_path)
                        <img src="{{url($search_data->profile_photo_path)}}" alt="" class="w-10 h-10 my-auto mx-auto rounded-3xl bg-white border border-solid border-gray-400 object-contain">
                    @else
                    <div class="w-10 h-10 my-auto mx-auto px-3 py-2 rounded-3xl bg-white border border-solid border-gray-400">
                        <i class="fa-solid fa-magnifying-glass my-auto mx-auto text-center"></i>
                    </div>
                    @endif
                </div>
                <div onclick="window.open(`{{url('users/'.$search_data->profile_url)}}`, '_self')" class="my-auto cursor-pointer hover:text-blue-700 bbsh">
                    <p>{{$search_data->first_name.' '.$search_data->last_name}}</p>
                    <p class="mt-1 text-xs text-blue-900">Pengguna</p>
                </div>
                <div class="flex flex-row my-auto ddsh">
                    @if(Auth::user() != null)
                        @php
                            $getfollowing = $data_follow->where('following_id', $this->authId)->where('follower_id', $search_data->id)->first();
                            //$getfollower = $data_follow->first();
                            $getfollower = $data_follow->where('following_id', $search_data->id)->where('follower_id', $this->authId)->first();
                            //var_dump(array($getfollower,$this->authId,$search_data->id));
                        @endphp
                        @if($getfollower != null)
                            @if($getfollowing != null)
                            <!-- Terhubung -->
                                <p class="w-3/5"></p>
                                <div wire:click="openChat([{{$search_data->id}},'user'])" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer">
                                    <i class="fa-solid fa-message my-auto mx-auto text-center"></i>
                                </div>
                                <div wire:click="unfollowUser([{{$search_data->id}},'user'])" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer ml-1">
                                    <i class="fa-solid fa-user-xmark my-auto mx-auto text-center"></i>
                                </div>
                            @else
                            <!-- Menunggu -->
                                <p class="w-4/5"></p>
                                <div class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer">
                                    <i class="fa-solid fa-clock my-auto mx-auto text-center"></i>
                                </div>
                            @endif
                        @else
                            @if($getfollowing != null)
                            <!-- Terima Permintaan -->
                                <p class="w-4/5"></p>
                                <div wire:click="followbackUser([{{$search_data->id}},'user'])" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer ml-auto">
                                    <i class="fa-solid fa-check my-auto mx-auto text-center"></i>
                                </div>
                            @else
                            <!-- Hubungkan -->
                                <p class="w-4/5"></p>
                                <div wire:click="followUser([{{$search_data->id}},'user'])" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer ml-auto">
                                    <i class="fa-solid fa-user-plus my-auto mx-auto text-center"></i>
                                </div>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
            @if(count($search_user) >= 5 && $select_type != 1)
            <div class="my-auto px-3 pt-2 w-full border-t border-solid cursor-pointer hover:text-blue-700">
                <a wire:click="selectType(1)" href="#show-top" class="w-full ">
                    <p class="mx-auto text-center"> Lihat Semua</p>
                </a>
            </div>
            @endif
        </div>
        @endif
        @endif

        <!-- Employer -->
        @if($select_type == 0 || $select_type == 2)
        @if(count($search_employer) > 0)
        <div class="w-full lg:w-3/5 mx-auto shadow rounded-lg bg-white my-4 sm:my-4 py-4 px-2 sm:px-4">
            <p class="text-lg font-semibold mb-3">Perusahaan</p>
            @foreach($search_employer as $search_data)
            <div class="flex flex-row w-full mb-2 shadow rounded-lg bg-gray-300 px-2 py-1">
                <div onclick="window.open(`{{url('employers/'.$search_data->profile_url)}}`, '_self')" class="my-auto mr-2 cursor-pointer aash">
                    @if($search_data->profile_photo_path)
                        <img src="{{url($search_data->profile_photo_path)}}" alt="" class="w-10 h-10 my-auto mx-auto rounded-lg bg-white border border-solid border-gray-400 object-contain">
                    @else
                    <div class="w-10 h-10 my-auto mx-auto px-3 py-2 rounded-lg bg-white border border-solid border-gray-400">
                        <i class="fa-solid fa-magnifying-glass my-auto mx-auto text-center"></i>
                    </div>
                    @endif
                </div>
                <div onclick="window.open(`{{url('employers/'.$search_data->profile_url)}}`, '_self')" class="my-auto cursor-pointer hover:text-blue-700 bbsh">
                    <p>{{$search_data->name}}</p>
                    <p class="mt-1 text-xs text-blue-900">Perusahaan</p>
                </div>
                <div class="flex flex-row my-auto ddsh">
                    @if(Auth::user() != null)
                        @php
                            $getfollowing = $data_follow->where('following_id', $this->authId)->where('follower_id', $search_data->id)->first();
                            //$getfollower = $data_follow->first();
                            $getfollower = $data_follow->where('following_id', $search_data->id)->where('follower_id', $this->authId)->first();
                            //var_dump(array($getfollower,$this->authId,$search_data->id));
                        @endphp
                        @if($getfollower != null)
                            @if($getfollowing == null)
                            <!-- Terhubung -->
                                <p class="w-4/5"></p>
                                <div wire:click="openChat([{{$search_data->id}}, 'employer'])" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer">
                                    <i class="fa-solid fa-message my-auto mx-auto text-center"></i>
                                </div>
                                <div wire:click="unfollowUser([{{$search_data->id}}, 'employer'])" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer ml-1">
                                    <i class="fa-solid fa-user-xmark my-auto mx-auto text-center"></i>
                                </div>
                            @endif
                        @else
                            @if($getfollowing == null)
                            <!-- Hubungkan -->
                                <p class="w-4/5"></p>
                                <div wire:click="followUser([{{$search_data->id}}, 'employer'])" class="w-10 h-10 my-auto px-3 py-2 rounded-3xl border border-solid border-gray-400 text-center cursor-pointer ml-auto">
                                    <i class="fa-solid fa-user-plus my-auto mx-auto text-center"></i>
                                </div>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
            @if(count($search_employer) >= 5 && $select_type != 2)
            <div class="my-auto px-3 pt-2 w-full border-t border-solid cursor-pointer hover:text-blue-700">
                <a wire:click="selectType(2)" href="#show-top" class="w-full ">
                    <p class="mx-auto text-center"> Lihat Semua</p>
                </a>
            </div>
            @endif
        </div>
        @endif
        @endif
    </div>
</div>
