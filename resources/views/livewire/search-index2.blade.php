
<div class="w-full zind mx-auto sm:px-6 lg:px-8">

<div class="max-w-7xl shadow-xl p-5 rounded-lg bg-blue-800">
    <div class="flex flex-col">

        <div class="relative w-full sm:w-80 mr-1 mb-1">

                <div class="absolute flex items-center ml-2 mt-2">

                <lord-icon
                    src="https://cdn.lordicon.com/msoeawqm.json"
                    trigger="loop"
                    colors="primary:#1b1091,secondary:#1663c7"
                    style="width:30px;height:30px">
                </lord-icon>

                </div>



                <input type="search" id="search-title" list="title-list" wire:model="searchjob" type="text" placeholder="Pekerjaan, kata kunci, atau nama perusahaan" 

                    autocomplete="off" class="case pl-11 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">


                </input>

        </div>

        <div class="a w-full mt-1 mb-1">

                <div class="absolute flex items-center ml-2 mt-2 ">

                    <lord-icon
                        src="https://cdn.lordicon.com/zzcjjxew.json"
                        trigger="loop"
                        colors="primary:#2516c7,secondary:#30c9e8"
                        style="width:32px;height:32px">
                    </lord-icon>

                </div>

                <input type="text" id="search-loc" wire:model.defer="locations" type="search" placeholder="Lokasi" autocomplete="off"
                class="pl-11 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
        </div>

        <div class="a w-full mt-1 mb-1">

                <div class="absolute flex items-center ml-2 mt-2">

                    <lord-icon
                        src="https://cdn.lordicon.com/soseozvi.json"
                        trigger="loop"
                        colors="primary:#1b1091,secondary:#66d7ee"
                        style="width:32px;height:32px">
                    </lord-icon>

                </div>

                <select wire:model.defer="jenis_kerja"
                style="text-indent:39px;"
                class="py-3 w-full h-11 rounded-lg bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">

                    <option value="" class="py-3 px-11 pl-11 ml-11">Jenis Pekerjaan</option>

                    @foreach ($jenkers as $jenker)

                    <option value="{{$jenker->id}}" class="py-3 pl-11 px-11 ml-11">{{$jenker->name_jk}}</option>

                    @endforeach

                </select>

        </div>

        <div class="a flex flex-row">

            <div class="w-full sm:w-1/4 ml-0 sm:ml-0 mr-1 sm:mr-1 mt-1 mb-1 sm:mb-0">
                <select wire:model.defer="kualif_lulus"

                style="text-indent:15px;" class="py-3 w-full h-11 rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">

                    <option value="">Lulusan</option>

                    @foreach ($kualifs as $kualif)

                        <option value="{{$kualif->id}}">{{$kualif->name_kl}}</option>

                    @endforeach

                </select>
            </div>

            @if(is_null($this->minrange) || is_null($this->maxrange))
            <div class="w-full sm:w-1/4 ml-1 sm:ml-1 mr-0 sm:mr-0 mt-1 mb-1 sm:mb-0">

                <button data-modal-toggle="modal-gaji1"

                type="button"

                data-mdb-ripple="true"

                data-mdb-ripple-color="light"

                class="px-4 py-3.5 w-full rounded-md border-transparent focus:border-gray-500 focus:ring-0 text-sm inline-block bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md

                hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"

                >Gaji</button>

            </div>
            @else
            <div class="w-full sm:w-1/4 ml-1 sm:ml-1 mr-0 sm:mr-0 mt-1 mb-1 sm:mb-0">

                <button data-modal-toggle="modal-gaji1"

                type="button"

                data-mdb-ripple="true"

                data-mdb-ripple-color="light"

                class="px-4 py-3.5 w-full rounded-md border-transparent focus:border-gray-500 focus:ring-0 text-sm inline-block bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md

                hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"

                >
					@php
					$minrange_s = $this->minrange/1000000;
					$maxrange_s = $this->maxrange/1000000;
					@endphp
					{{$minrange_s.'jt - '.$maxrange_s.'jt'}}
                </button>

            </div>

            @endif

            <div id="modal-gaji1"class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 w-full md:inset-0 h-modal md:h-full">

            <div class="relative p-4 w-full max-w-md h-full md:h-auto">

                <!-- Modal content -->

                <style>

                input[type=range]::-webkit-slider-thumb {

                    pointer-events: all;

                    width: 24px;

                    height: 24px;

                    -webkit-appearance: none;

                /* @apply w-6 h-6 appearance-none pointer-events-auto; */

                }

                </style> 

                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <!-- Modal body -->

                    <div class="p-6 space-y-6">

                        <div x-data="range()" x-init="mintrigger(); maxtrigger()" class="relative max-w-xl w-full">

                            <div>

                                <div class="flex flex-col text-center items-center py-5">

                                    <div>

                                        <p>Rentang gaji per bulan</p>

                                        <b class="min_price"></b> sampai <b class="max_price"></b>

                                    </div>

                                    <div class="flex justify-between items-center py-5">

                                        <div>

                                            <input type="hidden" maxlength="5" x-on:input="mintrigger" x-model="minprice" class="px-3 py-2 border border-gray-200 rounded w-24 text-center">

                                        </div>

                                        <div>

                                            <input type="hidden" maxlength="5" x-on:input="maxtrigger" x-model="maxprice" class="px-3 py-2 border border-gray-200 rounded w-24 text-center">

                                        </div>

                                    </div>

                                </div>

                                <input type="range"

                                        step="0.5"

                                        x-bind:min="min" x-bind:max="max"

                                        x-on:input="mintrigger"

                                        x-model="minprice"

                                        class="minrange absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">



                                <input type="range" 

                                        step="0.5"

                                        x-bind:min="min" x-bind:max="max"

                                        x-on:input="maxtrigger"

                                        x-model="maxprice"

                                        class="maxrange absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">



                                <div class="relative z-10 h-2">



                                    <div class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200"></div>

                                    <div class="absolute z-20 top-0 bottom-0 rounded-md bg-green-300" x-bind:style="'right:'+maxthumb+'%; left:'+minthumb+'%'"></div>

                                    <div class="absolute z-30 w-6 h-6 top-0 left-0 bg-green-300 rounded-full -mt-2 -ml-1" x-bind:style="'left: '+minthumb+'%'"></div>

                                    <div class="absolute z-30 w-6 h-6 top-0 right-0 bg-green-300 rounded-full -mt-2 -mr-3" x-bind:style="'right: '+maxthumb+'%'"></div>

                                </div>

                            </div>

                        </div>

                        <!-- Modal footer -->

                        <div class="flex justify-center items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">

                            <button onclick="onclickrange1()" data-modal-toggle="modal-gaji1" type="button" class="mod-gaji text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Setuju</button>

                            <button data-modal-toggle="modal-gaji1" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tutup</button>

                        </div>

                    </div>
    
                </div>

            </div>
      
        </div>

    </div>
                
        @if(is_null($this->minrange) || is_null($this->maxrange))
        @else
        <div class="a sm:w-48 ml-0 sm:ml-1 mr-0 sm:mr-1 mb-1 sm:mb-0 grid justify-items-end">

            <button wire:click="resetGaji()" data-mdb-ripple="true"

                data-mdb-ripple-color="light"

                class="w-full sm:w-48 zind inline-block px-6 py-2.5 my-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800">

                Reset Gaji

            </button>
        </div>
        @endif

        <div class="a sm:w-48 ml-0 sm:ml-1 mr-0 sm:mr-1 mb-1 sm:mb-0 grid justify-items-end">

            <button wire:click="searchJob()" data-mdb-ripple="true"

                data-mdb-ripple-color="light"

                class="w-full sm:w-48 zind inline-block px-6 py-2.5 my-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800">

                SEARCH

            </button>

        </div>

    </div>

        

<div wire:loading.delay.longest class="fixed z-20 inset-0 place-content-center">

    <div class="fixed justify-center h-full w-full opacity-25 bg-gray-400"> </div>

        <div class="flex justify-center mt-56">

                <img class="object-cover w-36" src="http://localhost:8000/storage/loaders/rings.svg">

        </div>

    </div>

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

      function onclickrange1(){

        var minVal = $('.minrange').val()

        var maxVal = $('.maxrange').val()

        window.livewire.emit('minRange',minVal);

        window.livewire.emit('maxRange',maxVal);

        // alert(dataVal)

      }
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
$('#search-loc').on('change',function(){
    console.log($(this).val())
    $sloc_val = $(this).val()
    window.livewire.emit('dataLocation',$sloc_val)
})

</script>

<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>