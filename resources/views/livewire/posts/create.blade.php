<style>
    .select2-container{
        width:100%;
        height:50px;
    }
    .select2-selection{
        height:45px;
        border: 1px solid #f8fafc;
        padding: 3px;
        box-shadow: 1px 1px 2px 1px #e2e8f0;
    }
    .selection{
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
                                <input type="file" multiple name="photos" id="photos"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    wire:model="photos">
                                @error('photos') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        
                        <div class="flex flex-col">
                            <label for="minrange" class="block text-gray-700 text-sm font-bold mb-2">Jangka Gaji:</label>
                            <div class="flex flex-row">
                                <div class="w-1/2 mr-1 mb-4">
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="minrange" name="minrange" wire:model.defer="minrange" 
                                        placeholder="minimal gaji, contoh: 2.000.000"></input>
                                    @error('minrange') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="w-1/2 mr-1 mb-4">
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="maxrange" name="maxrange" wire:model.defer="maxrange" 
                                        placeholder="maksimal gaji, contoh: 5.000.000"></input>
                                    @error('maxrange') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="flex flex-row">
                                @if($this->checkgaji == 1)
                                <input wire:model="checkgaji" type="checkbox" id="rangecek" name="rangecek" value="1" checked>
                                @else
                                <input wire:model="checkgaji" type="checkbox" id="rangecek" name="rangecek" value="1">
                                @endif
                                <label for="rangecek">&nbsp Tampilkan jangka gaji.</label><br>
                            </div>
                        </div>
                        
                        <div class="flex flex-row">
                            <!-- <div class="w-1/2 mr-1 mb-4">
                                <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Lokasi:</label>
                                <x-jet-select2 multiple name="location" id="location" wire:model="location"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </x-jet-select2>
                               @error('location') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div> -->
                            <div class="w-1/2 mr-1 mb-4" x-data="{idloc:null,nameloc:null,open:false}">
                                <label for="locinput" class="block text-gray-700 text-sm font-bold mb-2">Lokasi:</label>
                                <div @click="open=true" class="shadow appearance-none w-full whitespace overflow-y-auto h-12 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    <div wire:ignore>
                                        <div id="wrapper-box"class="flex flex-wrap max-w-xl">
                                            <!-- sad -->
                                            @if($this->location_regency != null)
                                            @foreach($this->location_regency as $location)
                                            <div class='selection-choice op-"+numb+"-ch mx-1 my-1 max-w-sm w-auto' title='{{$location->name}}'>
                                                <span class='rounded border border-gray-300' style='background-color:#e5e7eb;'>
                                                    <a href="javascript:void(0);" data-id="{{$location->id}}" class="remove_button border-r border-gray-300 cursor-pointer text-md text-gray-400 hover:text-gray-700 px-1 my-1 hover:bg-gray-200 focus:bg-gray-100">x</a>
                                                    <span class="text-md my-1 mx-1">
                                                        {{$location->name}}
                                                    </span>
                                                </span>
                                            </div>
                                            @endforeach
                                            @endif
                                            @if($this->location_district != null)
                                            @foreach($this->location_district as $location)
                                            <div class='selection-choice op-"+numb+"-ch mx-1 my-1 max-w-sm w-auto' title='{{$location->name}}'>
                                                <span class='rounded border border-gray-300' style='background-color:#e5e7eb;'>
                                                    <a href="javascript:void(0);" data-id="{{$location->id}}" class="remove_button border-r border-gray-300 cursor-pointer text-md text-gray-400 hover:text-gray-700 px-1 my-1 hover:bg-gray-200 focus:bg-gray-100">x</a>
                                                    <span class="text-md my-1 mx-1">
                                                        {{$location->name}}
                                                    </span>
                                                </span>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <select hidden name="multiloc" id="multiloc" multiple>
                                            @if($this->location_regency != null)
                                                @foreach($this->location_regency as $location)
                                                    <option selected data-id='{{$location->id}}' value='{{$location->name}}'>{{$location->name}}</option>
                                                @endforeach
                                            @endif
                                            @if($this->location_district != null)
                                                @foreach($this->location_district as $location)
                                                    <option selected data-id='{{$location->id}}' value='{{$location->name}}'>{{$location->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="absolute w-96 bg-white rounded-b-lg shadow z-10 p-2 max-h-48 overflow-auto" x-show="open" x-on:click.away="open = false">
                                    <input type="text" @keyup="$wire.locationSearch()" wire:model="inloc" id="inloc" name="inloc"
                                        class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 mb-2 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    @error('location') <span class="text-red-500">{{ $message }}</span>@enderror
                                    @if($this->listloc)
                                    @foreach($this->listloc as $listloc)
                                        <div class="cursor-pointer hover:bg-gray-300 focus:bg-gray-500">
                                            @if($loop->last)
                                                <p @click="open=false" onclick="addLocation('{{ucwords(strtolower($listloc->name))}}')" class="py-2">{{ucwords(strtolower($listloc->name))}}</p>
                                            @else
                                                <p @click="open=false" onclick="addLocation('{{ucwords(strtolower($listloc->name))}}')" class="py-2">{{ucwords(strtolower($listloc->name))}}</p><hr>
                                                @endif
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="w-1/2 ml-1 mb-4">
                                <label for="jenker" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kerja:</label>
                                <x-jet-select2 multiple name="jenker" id="jenker" wire:model="jenker"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    
                                    @foreach ($jenkers as $jenker)
                                        <option value="{{ $jenker->id }}">{{ $jenker->name_jk }}</option>
                                    @endforeach
                                </x-jet-select2>
                                @error('jenker') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="flex flex-row">
                            <div class="w-1/2 mr-1 mb-4" wire:ignore>
                                <label for="kualif" class="block text-gray-700 text-sm font-bold mb-2">Kualifikasi Lulusan:</label>
                                <x-jet-select2 multiple name="kualif" id="kualif" wire:model="kualif"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    
                                    @foreach ($kualifs as $kualif)
                                        <option value="{{ $kualif->id }}">{{ $kualif->name_kl }}</option>
                                    @endforeach
                                </x-jet-select2>
                                @error('kualif') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="w-1/2 ml-1 mb-4" wire:ignore>
                                <label for="pengkerja" class="block text-gray-700 text-sm font-bold mb-2">Pengalaman Kerja:</label>
                                <x-jet-select2 multiple name="pengkerja" id="pengkerja" wire:model="pengkerja"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    
                                    @foreach ($pengkerjas as $pengkerja)
                                        <option value="{{ $pengkerja->id }}">{{ $pengkerja->name_pk }}</option>
                                    @endforeach
                                </x-jet-select2>
                                @error('pengkerja') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="flex flex-row">
                            <div class="w-1/2 mr-1 mb-4" wire:ignore>
                                <label for="spesialis" class="block text-gray-700 text-sm font-bold mb-2">Spesialis Pekerjaan:</label>
                                <x-jet-select2 multiple name="spesialis" id="spesialis" wire:model="spesialis"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    
                                    @foreach ($spesialises as $spesialis)
                                        <option value="{{ $spesialis->id }}">{{ $spesialis->name_sk }}</option>
                                    @endforeach
                                </x-jet-select2>
                                @error('spesialis') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="w-1/2 ml-1 mb-4" wire:ignore>
                                <label for="tingker" class="block text-gray-700 text-sm font-bold mb-2">Tingkat Kerja:</label>
                                <x-jet-select2 multiple name="tingker" id="tingker" wire:model="tingker"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    
                                    @foreach ($tingkers as $tingker)
                                        <option value="{{ $tingker->id }}">{{ $tingker->name_tk }}</option>
                                    @endforeach
                                </x-jet-select2>
                                @error('tingker') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="formulir" class="block text-gray-700 text-sm font-bold mb-2">Tautan Formulir:</label>
                            <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="formulir" placeholder="Enter Title" wire:model.defer="formulir">
                            @error('formulir') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="flex flex-row">
                            <div class="w-1/2 mr-1 mb-4">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email" placeholder="Enter Title" wire:model.defer="email">
                                @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="w-1/2 ml-1 mb-4">
                                <label for="wa" class="block text-gray-700 text-sm font-bold mb-2">Whatsapp:</label>
                                <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="wa" placeholder="Enter Title" wire:model.defer="wa">
                                @error('wa') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
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
$('#select2-multitle-results').hide()
$(document).ready(function(){
    var route = "{{ url('dashboard/autocomplete-search') }}";
    $('#search-loc').typeahead({
        source: function (query, process) {
            var dataquery = query;
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
})
</script>