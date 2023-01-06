<style>
    .select2-container .select2-selection--multiple{
        width:100%;
        height:45px;
    }
    .select2-container .select2-selection--single{
        width:100%;
        height:45px;
    }
    .select2-selection{
        width:100%;
        height:45px;
        border: 1px solid #f8fafc;
        box-shadow: 1px 1px 2px 1px #e2e8f0;
    }
    .select2-selection--multiple{
        padding: 3px;
    }
    .select2-container--default .select2-selection--single{
        padding:8px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        top:8px;
    }
</style>
<div class="fixed z-50 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden 
        shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                <x-jet-select2 ads="tags" wire:model="multitle" name="multitle" id="multitle" multiple 
                                class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    @if($this->multitles != null)
                                    @foreach($this->multitles as $multitles)
                                        <option data-id="{{$multitles->id}}" value="{{$multitles->title}}">{{$multitles->title}}</option>
                                    @endforeach
                                    @endif
                                </x-jet-select2>
                        </div>
                        <div wire:ignore class="mb-4">
                            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="content" wire:model="content" x-data 
                                x-init="
                                ClassicEditor
                                .create( $refs.editordescription)
                                .then(function(editor){
                                    
                                    editor.model.document.on('change:data', () => {
                                        @this.set('content', editor.getData())
                                        
                                    })
                                    
                                })
                                .catch( error => {
                                    console.error( error );
                                } );" x-ref="editordescription">
                            </textarea>
                        </div>

                        <div class="mb-4">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="flex">
                                    <label for="photos"
                                        class="block text-gray-700 text-sm font-bold mb-2">Header - ( Rekomendasi Ukuran : Ratio 2,5:1 / 25x10cm )</label>
                                    {{-- <div class="px-2" wire:loading
                                        wire:target="photos">Uploading</div> --}}
                                    <div x-show="isUploading" class="px-2">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                <input type="file" name="photos" id="photos"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    wire:model="photos">
                                @error('photos') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                                        
                        <div class="flex flex-col mb-4">
                            <label for="materi" class="block text-gray-700 text-sm font-bold mb-2">Materi :</label>
                            <div>
                                <button wire:click="openMateri()" type="button" class="my-1 mx-0.5 py-1 px-2 rounded bg-blue-700 text-white focus:outline-none">Tambah Materi</button>
                            </div>
                            @if(session('addmateries'))
                            @foreach(session('addmateries') as $id => $materi)
                            <div class="flex flex-row my-1">
                                <input type="text" readonly="readonly" value="{{$materi['title']}}"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 mr-1 rounded leading-tight focus:outline-none focus:shadow-outline">
                                <button type="button" wire:click="editMateri('{{$id}}')" class="p-2 mx-1 bg-blue-700 text-white rounded-lg">Edit</button>
                                <x-jet-delete-button id="delmateri{{$id}}" wire:click="deleteMateri('{{$id}}')" class="p-2 ml-1 bg-red-600 text-white rounded-lg">Delete</x-jet-delete-button>
                            </div>
                            @endforeach
                            @endif

                            @if(session('materidb'))
                            @foreach(session('materidb') as $id => $materi)
                            <div class="flex flex-row my-1">
                                <input type="text" readonly="readonly" value="{{$materi['title']}}"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 mr-1 rounded leading-tight focus:outline-none focus:shadow-outline">
                                <button type="button" wire:click="editMateri('{{$id}}')" class="p-2 mx-1 bg-blue-700 text-white rounded-lg">Edit</button>
                                <x-jet-delete-button id="delmateriDB{{$id}}" wire:click="delmateriDB('{{$id}}')" class="p-2 ml-1 bg-red-600 text-white rounded-lg">Delete</x-jet-delete-button>
                            </div>
                            @endforeach
                            @endif
                        </div>
                                        
                        <div class="flex flex-col mb-4">
                            <label for="benefit" class="block text-gray-700 text-sm font-bold mb-2">Benefit :</label>
                            <div>
                                <button wire:click="openBenefit()" type="button" class="my-1 mx-0.5 py-1 px-2 rounded bg-blue-700 text-white focus:outline-none">Tambah Benefit</button>
                            </div>
                            @if(session('addbenefit'))
                            @foreach(session('addbenefit') as $id => $benefit)
                            <div class="flex flex-row my-1">
                                <input type="text" readonly="readonly" value="{{$benefit['title']}}"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 mr-1 rounded leading-tight focus:outline-none focus:shadow-outline">
                                <button type="button" wire:click="editBenefit('{{$id}}')" class="p-2 mx-1 bg-blue-700 text-white rounded-lg">Edit</button>
                                <x-jet-delete-button id="delbenefit{{$id}}" wire:click="deleteBenefit('{{$id}}')" class="p-2 ml-1 bg-red-600 text-white rounded-lg">Delete</x-jet-delete-button>
                            </div>
                            @endforeach
                            @endif

                            @if(session('benefitdb'))
                            @foreach(session('benefitdb') as $id => $benefit)
                            <div class="flex flex-row my-1">
                                <input type="text" readonly="readonly" value="{{$benefit['title']}}"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 mr-1 rounded leading-tight focus:outline-none focus:shadow-outline">
                                <button type="button" wire:click="editBenefit('{{$id}}')" class="p-2 mx-1 bg-blue-700 text-white rounded-lg">Edit</button>
                                <x-jet-delete-button id="delbenefitDB{{$id}}" wire:click="delbenefitDB('{{$id}}')" class="p-2 ml-1 bg-red-600 text-white rounded-lg">Delete</x-jet-delete-button>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="flex flex-col sm:flex-row">
                            <div class="w-full sm:w-1/2 mr-1 mb-4" wire:ignore>
                                <label for="jenis" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelas :</label>
                                <x-jet-select2 name="jenis" id="jenis" wire:model="jenis"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Pilih jenis kelas</option>
                                    @foreach ($jns_materi as $jenis_materi)
                                        <option value="{{ $jenis_materi->id }}">{{ $jenis_materi->name }}</option>
                                    @endforeach
                                </x-jet-select2>
                                @error('jenis') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="w-full sm:w-1/2 ml-1 mb-4" wire:ignore>
                                <label for="spesialis" class="block text-gray-700 text-sm font-bold mb-2">Kategori Pelatihan :</label>
                                <x-jet-select2 multiple name="spesialis" id="spesialis" wire:model="spesialis"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    
                                    @foreach ($spesialises as $spesialis)
                                        <option value="{{ $spesialis->id }}">{{ $spesialis->name_sk }}</option>
                                    @endforeach
                                </x-jet-select2>
                                @error('spesialis') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @if($jenis == 1)
                        <div class="flex flex-col sm:flex-row">
                            <div class="w-full mr-1 mb-4">
                                <label for="placename" class="block text-gray-700 text-sm font-bold mb-2">Tempat :</label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="placename" name="placename" wire:model="placename" 
                                    placeholder="Contoh: Gedung A, Lantai 2, Ruang ABC"></input>
                                @error('placename') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row">
                            <!-- Alamat -->
                            <div class="w-full sm:w-3/4 mr-1 mb-4 mb-4">
                                <x-jet-label for="alamat" class="block text-gray-700 text-sm font-bold mb-2" value="{{ __('Alamat') }}" />
                                <input type="text" wire:model="alamat" autocomplete="off" id="alamat"
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('alamat') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <!-- Kode Pos -->
                            <div class="w-full sm:w-1/4 ml-1 mb-4">
                                <x-jet-label for="kodepos" class="block text-gray-700 text-sm font-bold mb-2" value="{{ __('Kode Pos') }}" />
                                <input type="text" wire:model="kodepos" autocomplete="off" id="kodepos"
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('kodepos') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row" x-data="{ modalCity:false, modalProvince:false }">
                            <!-- Provinsi -->
                            <div class="w-full sm:w-1/2 mr-1 mb-4">
                                <x-jet-label for="province" class="block text-gray-700 text-sm font-bold mb-2" value="{{ __('Provinsi') }}" />
                                <input type="hidden" wire:model="province" autocomplete="off" id="province">
                                <x-jet-input id="province_name" type="text" class="mt-1 block w-full" autocomplete="off" wire:model="province_name" @keydown="$wire.getProvince(); modalProvince=true" />
                                <x-jet-input-error for="province" class="mt-2" />
                                <div class="absolute w-96 max-h-48 overflow-auto bg-white rounded-b border border-solid border-gray-400 py-1" x-show="modalProvince" @click.away="modalProvince=false">
                                    @if($provinces)
                                        @foreach($provinces as $province)
                                        <div wire:click="setProvince({{$province->id}},'{{$province->name}}')" @click="modalProvince=false" class="py-1 px-2 w-full text-left cursor-pointer hover:bg-gray-400">{{$province->name}}</div>
                                        <hr>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- Kota -->
                            <div class="w-full sm:w-1/2 ml-1 mb-4">
                                <x-jet-label for="city" class="block text-gray-700 text-sm font-bold mb-2" value="{{ __('Kota') }}" />
                                <input type="hidden" wire:model="city" autocomplete="off" id="city">
                                <x-jet-input id="city_name" type="text" class="mt-1 block w-full" autocomplete="off" wire:model="city_name" @keydown="$wire.getCity(); modalCity=true" />
                                <x-jet-input-error for="city" class="mt-2" />
                                @if(session()->has('message_kota'))
                                    <p class="text-red-500">{{session('message_kota')}}</p>
                                @endif
                                <div class="absolute w-96 max-h-48 overflow-auto bg-white rounded-b border border-solid border-gray-400 py-1" x-show="modalCity" @click.away="modalCity=false">
                                    @if($cities)
                                        @foreach($cities as $city)
                                        <div wire:click="setCity({{$city->id}},'{{$city->name}}')" @click="modalCity=false" class="py-1 px-2 w-full text-left cursor-pointer hover:bg-gray-400">{{$city->name}}</div>
                                        <hr>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @elseif($jenis == 2)
                        @elseif($jenis == 3)
                        @endif
                        
                        <div class="flex flex-col sm:flex-row">
                            <div class="w-full sm:w-1/2 mr-1 mb-4">
                                <label for="date_type" class="block text-gray-700 text-sm font-bold mb-2">Jadwal :</label>
                                <select name="date_type" id="date_type" wire:model="date_type"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Pilih jenis jadwal</option>
                                        <option value="1">Jadwal Tunggal</option>
                                        <option value="2">Jadwal Berjangka</option>
                                </select>
                                @error('date_type') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="w-full sm:w-1/2 mr-1 mb-4">
                                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Biaya :</label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="price" name="price" wire:model="price" 
                                    placeholder="isi 0 jika gratis"></input>
                                @error('price') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @if($date_type)
                        <div class="flex flex-col sm:flex-row">
                            <div class="w-full sm:w-1/2 mr-1 mb-4">
                                @if($date_type == 1)
                                    <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal :</label>
                                    <div>
                                        <x-jet-date-picker id="date" name="date" wire:model="date" placeholder="0000-00-00"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        </x-jet-date-picker>
                                        <x-jet-input-error for="date" class="mt-2" />
                                    </div>
                                @elseif($date_type == 2)
                                    <label for="daterange" class="block text-gray-700 text-sm font-bold mb-2">Tanggal :</label>
                                    <div>
                                        <x-jet-daterange-picker id="daterange" name="daterange" wire:model="daterange" placeholder="0000-00-00 to 0000-00-00"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        </x-jet-daterange-picker>
                                        <x-jet-input-error for="daterange" class="mt-2" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex flex row sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex ml-2 mr-2 rounded-md shadow-sm sm:w-auto">
                        <!-- <button wire:click="store()" type="button" -->
                        <button wire:click="store" type="button"
                            class=" inline-flex items-center px-6 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Save
                        </button>
                    </span>
                    <span class="flex rounded-md shadow-sm sm:w-auto">
                        <button wire:click="closeModal()" data-modal-toggle="modal-create" type="button"
                            class="inline-flex items-center px-4 py-2 my-3 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            Cancel
                        </button>
                    </span>
                    <!-- <span class="flex rounded-md shadow-sm sm:w-auto">
                        <button data-modal-toggle="modal-create" type="button"
                            class="savepost inline-flex items-center px-4 py-2 my-3 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            generate
                        </button>
                    </span> -->
            </form>
        </div>

    </div>
</div>
</div>

<script>
// CKEDITOR.replace( 'content' );
// ClassicEditor.create( document.querySelector( '#content' ) ).then(editor => {
//         editor.model.document.on('change:data', () => {
//             @this.set('content', editor.getData());
//         })
//     }).catch( error => {
//         console.error( error );
//     } );
    $('#select2-multitle-results').hide()

    //MultiTitle
</script>