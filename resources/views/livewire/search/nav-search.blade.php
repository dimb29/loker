<div class="relative mt-2 mx-auto w-60 sm:w-80 mb-1" x-data="{searchmodal:false}">
    <div class="absolute flex z-50 items-center ml-2 mt-2">
    <lord-icon
    	src="https://cdn.lordicon.com/msoeawqm.json"
		trigger="loop"
		colors="primary:#1b1091,secondary:#1663c7"
		style="width:30px;height:30px">
	</lord-icon>
    </div>
    <input id="searchbox" autocomplete="off" wire:model="search_bar" x-on:keydown="searchmodal = true" x-on:keydown.enter="getUrl()" type="text" class="pl-11 pr-4 h-12 w-full rounded-md shadow-md bg-blue-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm" placeholder="Search anything you want :)">
    <div x-show="searchmodal" class="fixed modal z-10 bg-white rounded rounded-b h-48 sm:h-72 overflow-auto zind70" x-on:click.away="searchmodal = false" @scroll.window.throttle="searchmodal = false">
        <div class="flex flex-col bg-white px-1 w-60 sm:w-80 text-center text-sm">
            <!-- <div class="flex flex-row">
                @foreach($array_select as $select_search)
                @if($select_search['type'] == 1)
                <div wire:click="selectType({{$select_search['id']}})" class="w-1/3 border-b text-blue-700 border-solid border-blue-700 cursor-pointer hover:bg-gray-200">
                    {{$select_search['name']}}
                </div>
                @else
                <div wire:click="selectType({{$select_search['id']}})" class="w-1/3 border-b border-solid cursor-pointer hover:bg-gray-200">
                    {{$select_search['name']}}
                </div>
                @endif
                @endforeach
            </div> -->
            <div class="flex flex-col mt-2 text-left">
                @if($search_loker || $search_user || $search_employer)
                    <!-- Loker -->
                    @foreach($search_loker as $search_data)
                    <div onclick="window.open(`{{url('/posts/'.$search_data->id)}}`, '_self')" class="flex flex-row px-1 py-2 border-b border-solid border-gray-200 hover:bg-gray-200 cursor-pointer">
                        <div class="mr-2 w-1/4">
                            @if(count($search_data->images) > 0)
                                @foreach($search_data->images as $images)
                                    @if($loop->first)
                                        <img src="{{url($images->url)}}" alt="" class="w-10 h-10 m-auto rounded-3xl border border-solid object-contain">
                                    @endif
                                @endforeach
                            @else
                            <div class="w-10 h-10 m-auto px-3 py-2 rounded-3xl border border-solid">
                                <i class="fa-solid fa-magnifying-glass my-auto text-center"></i>
                            </div>
                            @endif
                        </div>
                        <div class="my-auto w-3/4">
                            @if($select_type == 1)
                                <p>{{$search_data->title}}</p>
                                <p class="mt-1 text-xs text-gray-300">Loker</p>
                            @else
                                <p>Data tidak ditemukan!</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <!-- Kelas -->
                    @foreach($search_class as $search_data)
                    <div onclick="window.open(`{{url('/onclass/'.$search_data->id)}}`, '_self')" class="flex flex-row px-1 py-2 border-b border-solid border-gray-200 hover:bg-gray-200 cursor-pointer">
                        <div class="mr-2 w-1/4">
                            @if(count($search_data->images) > 0)
                                @foreach($search_data->images as $images)
                                    @if($loop->first)
                                        <img src="{{url($images->url)}}" alt="" class="w-10 h-10 m-auto rounded-3xl border border-solid object-contain">
                                    @endif
                                @endforeach
                            @else
                            <div class="w-10 h-10 m-auto px-3 py-2 rounded-3xl border border-solid">
                                <i class="fa-solid fa-magnifying-glass my-auto text-center"></i>
                            </div>
                            @endif
                        </div>
                        <div class="my-auto w-3/4">
                            @if($select_type == 1)
                                <p>{{$search_data->title}}</p>
                                <p class="mt-1 text-xs text-gray-300">Kelas</p>
                            @else
                                <p>Data tidak ditemukan!</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <!-- User -->
                    @foreach($search_user as $search_data)
                    <div onclick="window.open(`{{url('/users/'.$search_data->profile_url)}}`, '_self')" class="flex flex-row px-1 py-2 border-b border-solid border-gray-200 hover:bg-gray-200 cursor-pointer">
                        <div class="mr-2 w-1/4">
                            @if($search_data->profile_photo_path)
                                <img src="{{url($search_data->profile_photo_path)}}" alt="" class="w-10 h-10 m-auto rounded-3xl border border-solid object-contain">
                            @else
                            <div class="w-10 h-10 m-auto px-3 py-2 rounded-3xl border border-solid">
                                <i class="fa-solid fa-magnifying-glass my-auto text-center"></i>
                            </div>
                            @endif
                        </div>
                        <div class="my-auto w-3/4">
                            @if($select_type == 1)
                                <p>{{$search_data->first_name.' '.$search_data->last_name}}</p>
                                <p class="mt-1 text-xs text-gray-300">Pengguna</p>
                            @else
                                <p>Data tidak ditemukan!</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <!-- Employer -->
                    @foreach($search_employer as $search_data)
                    <div onclick="window.open(`{{url('/employers/'.$search_data->profile_url)}}`, '_self')" class="flex flex-row px-1 py-2 border-b border-solid border-gray-200 hover:bg-gray-200 cursor-pointer">
                        <div class="mr-2 w-1/4">
                            @if($search_data->profile_photo_path)
                                <img src="{{url($search_data->profile_photo_path)}}" alt="" class="w-10 h-10 m-auto rounded-3xl border border-solid object-contain">
                            @else
                            <div class="w-10 h-10 m-auto px-3 py-2 rounded-3xl border border-solid">
                                <i class="fa-solid fa-magnifying-glass my-auto text-center"></i>
                            </div>
                            @endif
                        </div>
                        <div class="my-auto w-3/4">
                            @if($select_type == 1)
                                <p>{{$search_data->name}}</p>
                                <p class="mt-1 text-xs text-gray-300">Perusahaan</p>
                            @else
                                <p>Data tidak ditemukan!</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <div class="flex flex-row px-1 py-2 my-4 border-gray-200 hover:bg-gray-200 cursor-pointer" onclick="getUrl()">
                        <p class="mx-auto my-auto text-blue-700">Lihat Semua</p>
                    </div>
                @else
                    <p>Data tidak ditemukan!</p>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function getUrl(){
        // alert($('#searchbox').val());
        window.open(`{{url('/search/show/ss_send=')}}`+$('#searchbox').val(), '_self');

    }
</script>