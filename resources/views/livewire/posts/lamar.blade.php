
<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
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
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="flex">
                                    <label for="cv"
                                        class="block text-gray-700 text-sm font-bold mb-2">Upload CV</label>
                                    {{-- <div class="px-2" wire:loading
                                        wire:target="cv">Uploading</div> --}}
                                    <div x-show="isUploading" class="px-2">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                @if($this->acv != null)
                                    <p>Anda sudah pernah melampirkan <a href="{{url($this->acv)}}" class="text-blue-500" target="_blank">CV</a>, 
                                    jika anda memiliki yang terbaru silahkan upload ulang</p>
                                @endif
                                <input type="file" multiple name="cv" id="cv"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    wire:model="cv">
                                @error('cv') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div wire:ignore class="mb-4">
                            <label for="more_info" class="block text-gray-700 text-sm font-bold mb-2">Informasi Tambahan:</label>
                            <span class="text-green-500">*jika lowongan lebih dari satu, cantumkan Lowongan pilihan anda.</span>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="more_info" wire:model="more_info" x-data 
                                x-init="
                                    CKEDITOR.replace('more_info');
                                    CKEDITOR.instances.more_info.on('change', function() {
                                        $dispatch('input', this.getData());
                                    });"></textarea>
                            @error('more_info') <span class="text-red-500">{{ $more_info }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex row sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex ml-2 mr-2 rounded-md shadow-sm sm:w-auto">
                        <!-- <button wire:click="store()" type="button" -->
                        @if(isset($post_detail))
                        <button wire:click="sendApply({{$post_detail->id}})" type="button"
                            class=" inline-flex items-center px-6 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Save
                        </button>
                        @else
                        <button wire:click="sendApply({{$post->id}})" type="button"
                            class=" inline-flex items-center px-6 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Save
                        </button>
                        @endif
                    </span>
                    <span class="flex rounded-md shadow-sm sm:w-auto">
                        <button wire:click="closeModal()" data-modal-toggle="modal-create" type="button"
                            class="inline-flex items-center px-4 py-2 my-3 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            Cancel
                        </button>
                    </span>
            </form>
        </div>

    </div>
</div>
</div>

<script>
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