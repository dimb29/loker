<x-slot name="header">
</x-slot>

<x-slot name="footer">
</x-slot>

<div class="pt-0 sm:pt-12">
    <div class="max-w-7xl mx-auto sm:px-2 lg:px-4 py-10">
        <div class="flex flex-row w-full">
            @if($kelas)
            <div class="flex flex-col bg-white w-full sm:w-3/4 mx-2 overflow-hidden shadow-xl sm:rounded-lg">
                @if($kelas->images)
                    @foreach($kelas->images as $img)
                        <img src="{{url($img->url)}}" alt="">
                    @endforeach
                @endif
                <div class="flex flex-col px-4 py-2">
                    <p class="text-lg font-bold mb-1">{{$kelas->title}}</p>
                    <div class="flex flex-row my-1">
                        <button type="button" wire:click="menuSelect(1)" class="py-1 mx-0.5 focus:outline-none border-b-2 border-solid @if($bmenu == 1) border-blue-700 text-blue-700 @else border-gray-500 text-gray-500 @endif">Deskripsi</button>
                        <button type="button" wire:click="menuSelect(2)" class="py-1 mx-0.5 focus:outline-none border-b-2 border-solid @if($bmenu == 2) border-blue-700 text-blue-700 @else border-gray-500 text-gray-500 @endif">Materi</button>
                    </div>
                    <div class="content mt-1">
                        @if($bmenu == 1)
                            <div>
                                <div class="mx-2 my-2 capitalize">
                                    @if($kelas->on_class_jenis_id == 1)
                                    <p><i class="fa-regular fa-building  mr-1"></i>{{$kelas->placename}}</p>
                                    <p><i class="fa-solid fa-location-dot mr-1"></i>{{ucwords(strtolower($kelas->alamat .', '. $city .', '.$province .' ('.$kelas->kodepos .')'))}}</p>
                                    @endif
                                    <p>
                                        <i class="fa-solid fa-calendar-days mr-1"></i>
                                        @if($date_type == 1)
                                            {{date('d F Y', strtotime($kelas->start_date))}}
                                        @elseif($date_type == 2)
                                            {{date('d F Y', strtotime($kelas->start_date))}} - {{date('d F Y', strtotime($kelas->end_date))}}
                                        @endif
                                    </p>
                                </div><style>.ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {border: 0;}</style>
                                <div id="content" class="text-gray-700 text-base m-auto" x-data 
                                    x-init="
                                    ClassicEditor
                                    .create( $refs.kelascontent)
                                    .then(function(editor){
                                        const toolbarElement = editor.ui.view.toolbar.element;
                                        toolbarElement.style.display = 'none';
                                        editor.enableReadOnlyMode('content');
                                    })
                                    .catch( error => {
                                        console.error( error );
                                    });" x-ref="kelascontent">
                                    {!! $kelas->content !!}
                                </div>
                                @if(count($kelas->benefit) > 0)
                                    <div class="mt-1 py-1 px-2 rounded border border-solid">
                                        <p class="font-bold text-lg">Benefit :</p>
                                        <div class="grid grid-flow-row grid-cols-2 gap-1">
                                            @foreach($kelas->benefit as $benefit)
                                            <div class="flex flex-row">
                                                <i class="fa-solid fa-check text-green-500 my-auto"></i>
                                                <p class="ml-2">{{$benefit->title}}</p>
                                            </div>
                                            @endforeach
                                        </div>  
                                    </div>
                                @endif
                            </div>
                        @elseif($bmenu == 2)
                            @if($getuserbook)
                                @if($materi)
                                    @foreach($materi as $materik)
                                        <div class="border border-solid border-black shadow-lg rounded m-4 py-2 px-3" x-data="{modal{{$materik->id}}: false}">
                                            <div class="inline-flex pb-2 w-full cursor-pointer" @click="modal{{$materik->id}} = ! modal{{$materik->id}}">
                                                <p class="w-11/12">{{$materik->title}}</p>
                                                <p class="w-1/12 text-right">x</p>
                                            </div>
                                            <div x-show="modal{{$materik->id}}" wire:ignore>
                                                <textarea
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="content{{$materik->id}}" x-data 
                                                    x-transition:enter="transition ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 transform scale-90"
                                                    x-transition:enter-end="opacity-100 transform scale-100"
                                                    x-transition:leave="transition ease-in duration-300"
                                                    x-transition:leave-start="opacity-100 transform scale-100"
                                                    x-transition:leave-end="opacity-0 transform scale-90"
                                                    x-init="
                                                    ClassicEditor
                                                    .create( $refs.editordescription{{$materik->id}})
                                                    .then(function(editor){
                                                        const toolbarElement = editor.ui.view.toolbar.element;
                                                        toolbarElement.style.display = 'none';
                                                        editor.enableReadOnlyMode('content{{$materik->id}}');
                                                    })
                                                    .catch( error => {
                                                        console.error( error );
                                                    });" x-ref="editordescription{{$materik->id}}">
                                                    {{$materik->content}}
                                                </textarea>
                                            </div>

                                            @php
                                                if($materik->userbook):
                                                    if($materik->userbook->user_id == $usid):
                                                        $getbook = true;
                                                    else:
                                                        $getbook = false;
                                                    endif;
                                                else:
                                                    $getbook = false;
                                                endif;
                                            @endphp
                                            @if($getbook)
                                            <div class="flex flex-row mt-2">
                                                <!-- <p class="mr-0.5">Tandai sudah dibaca!</p> -->
                                                <button type="button" class="py-1 px-2 rounded bg-gray-300 text-white">Sudah dibaca</button>
                                            </div>
                                            @else
                                            <div class="flex flex-row mt-2">
                                                <!-- <p class="mr-0.5">Tandai sudah dibaca!</p> -->
                                                <button type="button" @click="$wire.readMateri({{$materik->id}})" class="py-1 px-2 rounded bg-blue-700 text-white">Selesai dibaca</button>
                                            </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            @else
                                <div class="w-full py-2 px-3 text-center">
                                    <p>Anda belum berlangganan pada kelas ini</p>
                                    <p>Silahkan klik tombol dibawah ini untuk berlangganan</p>
                                    <button onclick="window.location=`{{url('/payment/class/'.$kelas->id)}}`" type="button" class="py-2 px-3 text-white bg-blue-700 rounded focus:outline-none">
                                        Beli Kelas
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="hidden sm:block sm:w-1/4 mx-2 overflow-hidden">
                <div class="bg-white w-full shadow-xl sm:rounded-lg px-4 py-4"></div>
            </div>
            @endif
        </div>
    </div>
</div>