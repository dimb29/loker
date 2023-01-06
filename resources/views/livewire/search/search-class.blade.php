
<div class="w-screen mx-auto sm:px-6 lg:px-8">

<div class="w-full shadow-xl p-2.5 rounded-lg bg-white">
    <div class="flex flex-col sm:flex-row m-auto">

        <div class="relative w-full sm:w-1/2 mr-1 mb-1">

                <div class="absolute flex items-center ml-2 mt-2">

                <lord-icon
                    src="https://cdn.lordicon.com/msoeawqm.json"
                    trigger="loop"
                    colors="primary:#1b1091,secondary:#1663c7"
                    style="width:30px;height:30px">
                </lord-icon>

                </div>



                <input type="search" id="search-title" list="title-list" wire:model="searchclass" type="text" placeholder="Nama kelas, kata kunci, atau nama perusahaan" 

                autocomplete="off" class="pl-11 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">


        </div>

        <div class="w-full sm:w-1/2 ml-0 sm:ml-1 mr-0 sm:mr-1 mt-1 sm:mt-0 mb-1 sm:mb-0">

                <div class="absolute flex items-center ml-2 mt-2">

                    <lord-icon
                        src="https://cdn.lordicon.com/soseozvi.json"
                        trigger="loop"
                        colors="primary:#1b1091,secondary:#66d7ee"
                        style="width:32px;height:32px">
                    </lord-icon>

                </div>

                <select wire:model="level" class="pl-10 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
                    <option value="">Tingkat Pelatihan</option>
                    <option value="1">Pemula</option>
                    <option value="2">Menengah</option>
                    <option value="3">Ahli</option>
                </select>

        </div>

        <!-- <div class="sm:w-48 ml-0 sm:ml-1 mr-0 sm:mr-1 mt-12 sm:mt-0 mb-1 sm:mb-0 grid justify-items-end">

            <button wire:click="searchClass()" data-mdb-ripple="true"

                data-mdb-ripple-color="light"

                class="w-full sm:w-48 justify-end inline-block px-6 py-2.5 my-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800">

                SEARCH

            </button>

        </div> -->

    </div>


<script>

$(document).ready(function() {

$('.sel-loc').select2();

});



function range() {

    return {

      minprice: 3, 

      maxprice: 10,

      min: 1, 

      max: 20,

      minthumb: 0,

      maxthumb: 0,

      

      mintrigger() {   

        this.minprice = Math.min(this.minprice, this.maxprice - 0.5);      

        this.minthumb = ((this.minprice - this.min) / (this.max - this.min)) * 100;

          $(".min_price").text(this.minprice+'jt');

      },

       

      maxtrigger() {

        this.maxprice = Math.max(this.maxprice, this.minprice + 0.5); 

        this.maxthumb = 100 - (((this.maxprice - this.min) / (this.max - this.min)) * 100); 

          $(".max_price").text(this.maxprice+'jt');

        // console.log(this.maxprice);

      },

    }

}

      function onclickrange(){

        var minVal1 = $('.minrange1').val()

        var maxVal1 = $('.maxrange1').val()

        window.livewire.emit('minRange',minVal1);

        window.livewire.emit('maxRange',maxVal1);

        // alert(dataVal)

      }
var route = "{{ url('dashboard/autocomplete-search') }}";
$('#search-locs').typeahead({
    source: function (query, process) {
        var dataquery = query;
        return $.get(route, {
            query: query
        }, function (data) {
            return process(data);
        });
    }
});
$('#search-locs').on('change',function(){
    console.log($(this).val())
    $sloc_val = $(this).val()
    window.livewire.emit('dataLocation',$sloc_val)
})

</script>

<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>