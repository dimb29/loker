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
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 mb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="materi_title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" ads="tags" wire:model="materi_title" name="materi_title" id="materi_title" 
                            class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                            </input>
                                @error('materi_title') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div wire:ignore class="">
                            <label for="materi_content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="materi_content" wire:model="materi_content" x-data 
                                x-init="
                                ClassicEditor
                                .create( $refs.matericontent)
                                .then(function(editor){
                                    
                                    editor.model.document.on('change:data', () => {
                                        @this.set('materi_content', editor.getData())
                                        
                                    })
                                    
                                })
                                .catch( error => {
                                    console.error( error );
                                } );" x-ref="matericontent">
                            </textarea>
                        </div>
                        @error('materi_content') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="flex flex row sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex ml-2 mr-2 rounded-md shadow-sm sm:w-auto">
                        <!-- <button wire:click="store()" type="button" -->
                        @if($materi_id)
                        <button wire:click="updateMateri('{{$materi_id}}')" type="button"
                            class=" inline-flex items-center px-6 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Update
                        </button>
                        @else
                        <button wire:click="addMateri" type="button"
                            class=" inline-flex items-center px-6 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Save
                        </button>
                        @endif
                    </span>
                    <span class="flex rounded-md shadow-sm sm:w-auto">
                        <button wire:click="closeMateri" data-modal-toggle="modal-create" type="button"
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