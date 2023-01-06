
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="max-w-7xl shadow-xl p-5 rounded-lg bg-white">
    <div class="flex flex-col sm:flex-row">

        <div class="relative w-full sm:w-80 mr-1 mb-1">

                <div class="absolute flex items-center ml-2 mt-2">

                <lord-icon
                    src="https://cdn.lordicon.com/msoeawqm.json"
                    trigger="loop"
                    colors="primary:#1b1091,secondary:#1663c7"
                    style="width:30px;height:30px">
                </lord-icon>

                </div>



                <input type="search" id="search-title" list="title-list" wire:model="searchjob" name="searchjob" type="text" placeholder="Pekerjaan, kata kunci, atau nama perusahaan" 

                class="pl-11 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">

                <datalist id="title-list">

                            @foreach ($postsearch as $post)

                            <option value="{{$post->title}}">{{$post->title}}</option>

                            @endforeach

                </datalist>

        </div>

        <div class="w-full sm:w-80 ml-0 sm:ml-1 mr-0 sm:mr-1 mt-1 sm:mt-0 mb-1 sm:mb-0">

                <div class="absolute flex items-center ml-2 mt-2 ">

                    <lord-icon
                        src="https://cdn.lordicon.com/zzcjjxew.json"
                        trigger="loop"
                        colors="primary:#2516c7,secondary:#30c9e8"
                        style="width:32px;height:32px">
                    </lord-icon>

                </div>

                <input id="search-locs" wire:model.defer="locations" type="search" placeholder="Lokasi" 
                class="pl-11 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
        </div>

        <div class="w-full sm:w-80 ml-0 sm:ml-1 mr-0 sm:mr-1 mt-1 sm:mt-0 mb-1 sm:mb-0">

                <div class="absolute flex items-center ml-2 mt-2">

                    <lord-icon
                        src="https://cdn.lordicon.com/soseozvi.json"
                        trigger="loop"
                        colors="primary:#1b1091,secondary:#66d7ee"
                        style="width:32px;height:32px">
                    </lord-icon>

                </div>

                <select wire:model.defer="jenis_kerja" class="pl-10 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">

                    <option value="">Jenis Pekerjaan</option>

                    @foreach ($jenkers as $jenker)

                    <option value="{{$jenker->id}}">{{$jenker->name_jk}}</option>

                    @endforeach

                </select>

        </div>

        <div class="sm:w-48 ml-0 sm:ml-1 mr-0 sm:mr-1 mt-12 sm:mt-0 mb-1 sm:mb-0 grid justify-items-end">

            <button wire:click="searchJob()" data-mdb-ripple="true"

                data-mdb-ripple-color="light"

                class="w-full sm:w-48 justify-end inline-block px-6 py-2.5 my-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800">

                SEARCH

            </button>

        </div>

    </div>

        <div class="flex flex-row sm:flex-row">

            <div class="w-full sm:w-40 ml-0 sm:ml-0 mr-1 sm:mr-1 -mt-24 sm:mt-1 mb-1 sm:mb-0">
                <select wire:model.defer="kualif_lulus"

                    class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">

                    <option value="">Lulusan</option>

                    @foreach ($kualifs as $kualif)

                        <option value="{{$kualif->id}}">{{$kualif->name_kl}}</option>

                    @endforeach

                </select>
            </div>

            <div class="w-full sm:w-40 ml-1 sm:ml-1 mr-0 sm:mr-0 -mt-24 sm:mt-1 mb-1 sm:mb-0">

                <button data-modal-toggle="modal-gaji"

                type="button"

                data-mdb-ripple="true"

                data-mdb-ripple-color="light"

                class="px-4 py-3.5 w-full rounded-md border-transparent focus:border-gray-500 focus:ring-0 text-sm inline-block bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md

                hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"

                >Gaji</button>

            </div>

            <div class="w-full sm:w-40 ml-1 sm:ml-1 mr-0 sm:mr-0 -mt-24 sm:mt-1 mb-1 sm:mb-0">

                <button wire:click="resetGaji()"

                type="button"

                data-mdb-ripple="true"

                data-mdb-ripple-color="light"

                class="px-4 py-3.5 w-full rounded-md border-transparent focus:border-gray-500 focus:ring-0 text-sm inline-block bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md

                hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"

                >Reset Gaji</button>

            </div>

        </div>

