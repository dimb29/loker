

<div class="create-modals fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <form>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="">
            @if($cektype == 'ibk')
                <div class="mb-4">
                    <label for="bidker" class="block text-gray-700 text-sm font-bold mb-2">Bidang Kerja:</label>
                    <select multiple type="text" id="bidker" wire:model.defer="bidker" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Pilih Jenis</option>
                    @foreach($bidkers as $bidker)
                    <option value="{{$bidker->id}}">{{$bidker->name}}</option>
                    @endforeach
                    </select>
                    @error('bidker') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            @else
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                    <input type="text" class="input-filter shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" placeholder="Enter Title" wire:model.defer="title">
                    @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                @if($cektype == 'bk')
                <div class="mb-4">
                    <label for="parent" class="block text-gray-700 text-sm font-bold mb-2">Parent:</label>
                    <select multiple type="text" id="parent" wire:model.defer="parent" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Pilih Jenis</option>
                    @foreach($spesialises as $spesialis)
                    <option value="{{$spesialis->id}}">{{$spesialis->name_sk}}</option>
                    @endforeach
                    </select>
                    @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                @endif
            @endif
          </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button
                type="button"
                class="save-create-modal btn-save inline-flex items-center px-4 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
              Save
            </button>
          </span>
          <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button
                type="button" wire:click="closeCreate()"
                class="close-create-modal inline-flex items-center px-4 py-2 my-3 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
              Cancel
            </button>
          </span>
          </form>
        </div>

      </div>
    </div>
  </div>
<script>
  $('#parent').select2();
  $('#bidker').select2();
  $('.save-create-modal').click(function(){
    if($('#bidker')[0]){
      var bidker_val = $('#bidker').val();
        window.livewire.emit('dataBidKer',bidker_val);
      // vae bidker_id = $('#bidker').attr('data-id');
    }else{
      var title_val = $('#title').val();
      if($('#parent')[0]){
        var parent_val = $('#parent').val();
        window.livewire.emit('dataFillArray',[title_val,parent_val]);
      }else{
        window.livewire.emit('dataFillArray',[title_val]);
      }
    }
  })
</script>