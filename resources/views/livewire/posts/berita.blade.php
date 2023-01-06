
<x-slot name="header">
    <div class="bg-blue-800">
        <div class="hidden sm:flex max-w-7xl mx-auto h-56">
            <img class="object-cover h-full w-full" src="{{url('storage/photos/bnr2.jpg')}}">
        </div>
        <div class="flex sm:hidden max-w-7xl mx-auto h-56">
            <img class="object-cover h-full w-full" src="{{url('storage/photos/hp.jpg')}}">
        </div>
    </div>
</x-slot>
<x-slot name="footer">
</x-slot>

<div class="py-12 bg-yellow">
    <section class="h-52 -mt-20">
        <div class="flex sm:hidden max-w-full zind mx-auto px-4 sm:px-6 lg:px-8" id="myHeader">
            <livewire:search-index2>
        </div>
    </section>
    <section class="h-52 -mt-52">
        <div class="hidden sm:flex sticky max-w-7xl mx-auto">
            <livewire:search-index>
        </div>
    </section>
    <div wire:loading wire:target="postDetail,delSaveJob,saveJob" class="fixed z-20 inset-0 place-content-center ">
        <div class="fixed justify-center h-full w-full opacity-25 bg-slate-300"> </div>
            <div class="flex justify-center my-72">
                <div class="my-48 dots">
                </div>
            </div>
    </div> 
    <div hidden class="loadings fixed zind70 inset-0 place-content-center ">
        <div class="fixed justify-center h-full w-full opacity-25 bg-slate-300"> </div>
            <div class="flex justify-center my-72">
                <div class="my-48 dots">
                </div>
            </div>
    </div> 


                <div id="modal-gaji"class="zind1500 hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 w-full md:inset-0 h-modal md:h-full">

					<div class="mx-auto my-auto relative p-4 w-full max-w-md h-full md:h-auto">

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

												class="minrange1 absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">



										<input type="range" 

												step="0.5"

												x-bind:min="min" x-bind:max="max"

												x-on:input="maxtrigger"

												x-model="maxprice"

												class="maxrange1 absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">



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

									<button onclick="onclickrange()" data-modal-toggle="modal-gaji" type="button" class="mod-gaji text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Setuju</button>

									<button data-modal-toggle="modal-gaji" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tutup</button>

								</div>


							</div>
			
						</div>

					</div>

				</div>

<div class="max-w-7xl mt-16 sm:mt-0 mx-auto sm:px-6 lg:px-8 pt-8">
    <div class="flex flex-row">
        <div class="flex-auto w-1/3">
            <div class="flex flex-col">
                <div class="flex-auto m-1">
                    <div class="hidden sm:flex flex-col">
                        @if($posts != '')
                            @foreach ($posts as $post)
                            <div class="mb-8 bg-white rounded-lg shadow-xl 
                                    mt-4 transform transition duration-150 hover:scale-110 hover:-translate-y-2 
                                    text-grey-500 hover:text-blue-500 cursor-pointer transition border-b border-r" 
                                    data-mdb-ripple="true" data-mdb-ripple-color="light">
                                <div wire:click="postDetail({{ $post->id}})">
                                    <!-- @if(count($post->images) != 0)
                                    @foreach ($post['images'] as $image)
                                            <img class="object-fit h-48 w-screen rounded-lg" src="{{ url($image->url) }}" alt="{{ $image->description }}">
                                    @endforeach
                                    @else
                                            <img class="object-fit h-48 w-screen rounded-lg" src="{{ url('storage/photos/default_jobs.png') }}" alt="this is default">
                                    @endif -->
                                    <div class="flex flex-row job-search-card">
                                        <div class="w-1/4 mr-4">
                                            <div class="css-1f2quy8dp">
                                                <div class="responsive css-1eg7f6s">
                                                    <span class="responsive css-10rucli"></span>
                                                        @if($post->employer_id != null)
                                                            @if($post->author_employer->profile_photo_path != null)
                                                                <img class="css-1c345mg" src="{{url($post->author_employer->profile_photo_path)}}" alt="{{$post->author_employer->name}}" />
                                                            @else
                                                                <img class="css-1c345mg" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{$post->author_employer->name}}" />
                                                            @endif
                                                        @else
                                                            @if($post->author->profile_photo_path != null)
                                                                <img class="css-1c345mg" src="{{ url($post->author->profile_photo_path) }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                                                            @else
                                                                <img class="css-1c345mg" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                                                            @endif
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-3/4">
                                        @php
                                            $postt = $post->postTitles;
                                            $i = 1;
                                            //dd($post->postTitles);
                                        @endphp
                                        <div class="relative mb-4 w-full" 
                                            x-data="{
                                                        active: 1,
                                                        loop() {
                                                            setInterval(() => { this.active = this.active === {{count($postt)}} ? 1 : this.active+1 }, 1000)
                                                        },
                                                    }"
                                            x-init="loop()">
                                            <div class="flex flex-row overflow-x-hidden relative text-gray-900 text-xl font-semibold w-full">
                                                @foreach($post->postTitles as $potitle)
                                                    <div
                                                        class="text-blue-700 mb-2 w-full"
                                                        x-show="active == {{$i}}"
                                                        x-transition:enter="transition duration-500"
                                                        x-transition:enter-start="transform translate-x-full"
                                                        x-transition:enter-end="transform translate-x-0"
                                                    >
                                                            <p class="w-full">{{$potitle->title}}</p>
                                                    </div>
                                                @php $i= $i+1 @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                        <h5 class="text-green-500 text-md font-semibold mt-2 mb-4">
                                            @if($post->salary_check == 1)
                                            Rp {{ number_format($post->salary_start,0,',','.').' - Rp '.number_format($post->salary_end,0,',','.') }}
                                            @endif
                                        </h5>
                                        @if($post->employer_id != null)
                                            <h5 class="text-gray-900 text-md font-medium mt-2">
                                                {{ $post->author_employer->name}}
                                            </h5>
                                        @else
                                            <h5 class="text-gray-900 text-md font-medium mt-2">
                                                {{ $post->author->first_name . ' ' . $post->author->last_name }}
                                            </h5>
                                        @endif
                                        @php
                                            $regens = $post->regency;
                                            $dists = $post->district;
                                            $count_loc = count($regens)+count($dists);
                                            $ri = 1;
                                        @endphp
                                        <div class="relative mb-2 w-full" 
                                                x-data="{
                                                            active: 1,
                                                            loop() {
                                                                setInterval(() => { this.active = this.active === {{$count_loc}} ? 1 : this.active+1 }, {{$count_loc}}000)
                                                            },
                                                        }"
                                                x-init="loop">
                                            <div class="flex flex-row overflow-x-hidden relative text-gray-900 text-xs sm:text-base font-medium w-full">
                                                @if($regens != null)
                                                    @foreach($post->regency as $regen)
                                                        <div
                                                            class="textlcw-full font-semibold text-cyan-400"
                                                            x-show="active == {{$ri}}"
                                                            x-transition:enter="transition duration-1000"
                                                            x-transition:enter-start="transform translate-x-full"
                                                            x-transition:enter-end="transform translate-x-0"
                                                        >
                                                                <p class="w-full">{{$regen->name}}</p>
                                                        </div>
                                                    @php $ri= $ri+1 @endphp
                                                    @endforeach
                                                @endif
                                                @if($dists != null)
                                                    @foreach($dists as $dist)
                                                        <div
                                                            class="textl w-full font-semibold text-cyan-700"
                                                            x-show="active == {{$ri}}"
                                                            x-transition:enter="transition duration-1000"
                                                            x-transition:enter-start="transform translate-x-full"
                                                            x-transition:enter-end="transform translate-x-0"
                                                        >
                                                                <p class="w-full">{{$dist->name}}</p>
                                                        </div>
                                                    @php $ri= $ri+1 @endphp
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-gray-400 text-xs lg:text-base font-medium mt-6 mb-2"> 
                                            @php
                                            $minutes = $thistime->diffInMinutes($post->updated_at);
                                            $hours = $thistime->diffInHours($post->updated_at);
                                            $days = $thistime->diff($post->updated_at)->days;
                                            $weeks = $thistime->diffInWeeks($post->updated_at);
                                            $months = $thistime->diffInMonths($post->updated_at);
                                            $years = $thistime->diffInYears($post->updated_at);
                                            @endphp
                                            @if($minutes <= 60)
                                                {{$minutes}} menit yang lalu
                                            @elseif($hours <= 24)
                                                {{$hours}} jam yang lalu
                                            @elseif($days <= 7)
                                                {{$days}} hari yang lalu
                                            @elseif($weeks <= 4)
                                                {{$weeks}} minggu yang lalu
                                            @elseif($months <= 12)
                                                {{$months}} bulan yang lalu
                                            @else
                                                {{$years}} tahun yang lalu
                                            @endif
                                        </p>
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::user() != null)
                                @php $getpostid = null @endphp
                                @foreach($simpan_job as $simjob)
                                @if($simjob->post_id == $post->id)
                                @php $getpostid = $simjob->post_id @endphp
                                @endif
                                @endforeach
                                @if($getpostid == $post->id)
                                    <div class="mb-2 text-right z-10 px-4">
                                        <button wire:click="delSaveJob({{$post->id}})" class="w-10 h-10 focus:outline-none rounded-3xl hover:bg-gray-300">
                                            <i class="fa-solid fa-bookmark"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="mb-2 text-right z-10 px-4">
                                        <button wire:click="saveJob({{$post->id}})" class="w-10 h-10 focus:outline-none rounded-3xl hover:bg-gray-300">
                                            <i class="fa-regular fa-bookmark"></i>
                                        </button>
                                    </div>
                                @endif
                                @endif
                            </div>
                            @endforeach
                        @endif
                    </div>


                    <div class="sm:hidden" style="">
                        <div class="flex flex-row">
                            <!-- Data ODD -->
                            <div class="flex flex-col w-1/2 items-start w-auto">
                            @if($posts != '')
                                @foreach ($posts as $post)
                                @if($loop->iteration % 2 != 0)
                                <div class="w-full h-auto mb-0.5 inline-block">
                                <div class="w-auto bg-white rounded-lg shadow-md mr-1 mb-4
                                        text-grey-500 hover:text-blue-500 cursor-pointer transition border-b border-r" 
                                        data-mdb-ripple="true" data-mdb-ripple-color="light">
                                    <div x-data onclick="openJobs({{$post->id}})">
                                        
                                        <!-- @if(count($post->images) != 0)
                                        @foreach ($post['images'] as $image)
                                                <img class="object-fit h-48 w-screen rounded-lg" src="{{ url($image->url) }}" alt="{{ $image->description }}">
                                        @endforeach
                                        @else
                                                <img class="object-fit h-48 w-screen rounded-lg" src="{{ url('storage/photos/default_jobs.png') }}" alt="this is default">
                                        @endif -->
                                        
                                        <div class="css-1f2quy8">
                                            <div class="responsive css-1eg7f6s">
                                                <span class="responsive css-10rucli"></span>
                                                    @if($post->employer_id != null)
                                                        @if($post->author_employer->profile_photo_path != null)
                                                            <img class="css-1c345mg" src="{{url($post->author_employer->profile_photo_path)}}" alt="{{$post->author_employer->name}}" />
                                                        @else
                                                            <img class="css-1c345mg" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{$post->author_employer->name}}" />
                                                        @endif
                                                    @else
                                                        @if($post->author->profile_photo_path != null)
                                                            <img class="css-1c345mg" src="{{ url($post->author->profile_photo_path) }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                                                        @else
                                                            <img class="css-1c345mg" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                                                        @endif
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="px-2">
                                            @php
                                                $postt = $post->postTitles;
                                                $i = 1;
                                                //dd($post->postTitles);
                                            @endphp
                                            <div class="relative mt-2 w-full" 
                                                x-data="{
                                                            active: 1,
                                                            loop() {
                                                                setInterval(() => { this.active = this.active === {{count($postt)}} ? 1 : this.active+1 }, {{count($postt)}}000)
                                                            },
                                                        }"
                                                x-init="loop">
                                                <div class="flex flex-row overflow-x-hidden relative text-gray-900 text-md font-semibold w-full">
                                                    @foreach($postt as $potitle)
                                                        <div
                                                            class="text-blue-700 mb-2 w-full"
                                                            x-show="active == {{$i}}"
                                                            x-transition:enter="transition duration-1000"
                                                            x-transition:enter-start="transform translate-x-full"
                                                            x-transition:enter-end="transform translate-x-0"
                                                        >
                                                                <p class="w-full text-blue-900 font-semibold">{{$potitle->title}}</p>
                                                        </div>
                                                    @php $i= $i+1 @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                            <h5 class="text-green-700 text-xs sm:text-md mb-6 font-semibold">
                                                @if($post->salary_check == 1)
                                                Rp {{ number_format($post->salary_start,0,',','.').' - Rp '.number_format($post->salary_end,0,',','.') }}
                                                @endif
                                            </h5>
                                            @if($post->employer_id != null)
                                                <h5 class="text-gray-900 text-sm font-medium text-blue-600">
                                                    {{ $post->author_employer->name}}
                                                </h5>
                                            @else
                                                <h5 class="text-gray-900 text-sm font-medium text-blue-600 mt-8">
                                                    {{ $post->author->first_name . ' ' . $post->author->last_name }}
                                                </h5>
                                            @endif
                                            @php
                                                $regens = $post->regency;
                                                $ri = 1;
                                            @endphp
                                            <div class="relative mb-4 w-full" 
                                                x-data="{
                                                            active: 1,
                                                            loop() {
                                                                setInterval(() => { this.active = this.active === {{count($regens)}} ? 1 : this.active+1 }, {{count($regens)}}000)
                                                            },
                                                        }"
                                                x-init="loop">
                                                <div class="flex flex-row overflow-x-hidden relative text-gray-900 text-xs sm:text-base font-medium w-full">
                                                    @foreach($regens as $regen)
                                                        <div
                                                            class="mb-2 w-full"
                                                            x-show="active == {{$ri}}"
                                                            x-transition:enter="transition duration-1000"
                                                            x-transition:enter-start="transform translate-x-full"
                                                            x-transition:enter-end="transform translate-x-0"
                                                        >
                                                                <p class="w-full">{{$regen->name}}</p>
                                                        </div>
                                                    @php $ri= $ri+1 @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                            <p class="text-gray-400 text-xs sm:text-md font-medium mb-4"> 
                                                @php
                                                $minutes = $thistime->diffInMinutes($post->updated_at);
                                                $hours = $thistime->diffInHours($post->updated_at);
                                                $days = $thistime->diff($post->updated_at)->days;
                                                $weeks = $thistime->diffInWeeks($post->updated_at);
                                                $months = $thistime->diffInMonths($post->updated_at);
                                                $years = $thistime->diffInYears($post->updated_at);
                                                @endphp
                                                @if($minutes <= 60)
                                                    {{$minutes}} menit yang lalu
                                                @elseif($hours <= 24)
                                                    {{$hours}} jam yang lalu
                                                @elseif($days <= 7)
                                                    {{$days}} hari yang lalu
                                                @elseif($weeks <= 4)
                                                    {{$weeks}} minggu yang lalu
                                                @elseif($months <= 12)
                                                    {{$months}} bulan yang lalu
                                                @else
                                                    {{$years}} tahun yang lalu
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @if(Auth::user() != null)
                                    @php $getpostid = null @endphp
                                    @foreach($simpan_job as $simjob)
                                    @if($simjob->post_id == $post->id)
                                    @php $getpostid = $simjob->post_id @endphp
                                    @endif
                                    @endforeach
                                    @if($getpostid == $post->id)
                                        <div class="mb-2 text-right z-10 px-4">
                                            <button wire:click="delSaveJob({{$post->id}})" class="w-10 h-10 focus:outline-none rounded-3xl hover:bg-gray-300">
                                                <i class="fa-solid fa-bookmark"></i>
                                            </button>
                                        </div>
                                    @else
                                        <div class="mb-2 text-right z-10 px-4">
                                            <button wire:click="saveJob({{$post->id}})" class="w-10 h-10 focus:outline-none rounded-3xl hover:bg-gray-300">
                                                <i class="fa-regular fa-bookmark"></i>
                                            </button>
                                        </div>
                                    @endif
                                    @endif
                                </div>
                                </div>
                                @endif
                                @endforeach
                            @endif
                            </div>
                            <!-- /DATA ODD -->

                            <!-- DATA EVENT -->
                            <div class="flex flex-col w-1/2 items-start w-auto">
                            @if($posts != '')
                                @foreach ($posts as $post)
                                @if($loop->iteration % 2 == 0)
                                <div class="w-full h-auto mb-0.5 inline-block">
                                <div class="w-auto bg-white rounded-lg shadow-md mr-1 mb-4
                                        text-grey-500 hover:text-blue-500 cursor-pointer transition border-b border-r" 
                                        data-mdb-ripple="true" data-mdb-ripple-color="light">
                                    <div x-data onclick="openJobs({{$post->id}})">
                                        
                                        <!-- @if(count($post->images) != 0)
                                        @foreach ($post['images'] as $image)
                                                <img class="object-fit h-48 w-screen rounded-lg" src="{{ url($image->url) }}" alt="{{ $image->description }}">
                                        @endforeach
                                        @else
                                                <img class="object-fit h-48 w-screen rounded-lg" src="{{ url('storage/photos/default_jobs.png') }}" alt="this is default">
                                        @endif -->
                                        
                                        <div class="css-1f2quy8">
                                            <div class="responsive css-1eg7f6s">
                                                <span class="responsive css-10rucli"></span>
                                                    @if($post->employer_id != null)
                                                        @if($post->author_employer->profile_photo_path != null)
                                                            <img class="css-1c345mg" src="{{url($post->author_employer->profile_photo_path)}}" alt="{{$post->author_employer->name}}" />
                                                        @else
                                                            <img class="css-1c345mg" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{$post->author_employer->name}}" />
                                                        @endif
                                                    @else
                                                        @if($post->author->profile_photo_path != null)
                                                            <img class="css-1c345mg" src="{{ url($post->author->profile_photo_path) }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                                                        @else
                                                            <img class="css-1c345mg" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                                                        @endif
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="px-2">
                                            @php
                                                $postt = $post->postTitles;
                                                $i = 1;
                                                //dd($post->postTitles);
                                            @endphp
                                            <div class="relative mt-2 w-full" 
                                                x-data="{
                                                            active: 1,
                                                            loop() {
                                                                setInterval(() => { this.active = this.active === {{count($postt)}} ? 1 : this.active+1 }, {{count($postt)}}000)
                                                            },
                                                        }"
                                                x-init="loop">
                                                <div class="flex flex-row overflow-x-hidden relative text-gray-900 text-md font-semibold w-full">
                                                    @foreach($postt as $potitle)
                                                        <div
                                                            class="text-blue-700 mb-2 w-full"
                                                            x-show="active == {{$i}}"
                                                            x-transition:enter="transition duration-1000"
                                                            x-transition:enter-start="transform translate-x-full"
                                                            x-transition:enter-end="transform translate-x-0"
                                                        >
                                                                <p class="w-full text-blue-900 font-semibold">{{$potitle->title}}</p>
                                                        </div>
                                                    @php $i= $i+1 @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                            <h5 class="text-green-700 text-xs sm:text-md mb-6 font-semibold">
                                                @if($post->salary_check == 1)
                                                Rp {{ number_format($post->salary_start,0,',','.').' - Rp '.number_format($post->salary_end,0,',','.') }}
                                                @endif
                                            </h5>
                                            @if($post->employer_id != null)
                                                <h5 class="text-gray-900 text-sm font-medium text-blue-600">
                                                    {{ $post->author_employer->name}}
                                                </h5>
                                            @else
                                                <h5 class="text-gray-900 text-sm font-medium text-blue-600 mt-8">
                                                    {{ $post->author->first_name . ' ' . $post->author->last_name }}
                                                </h5>
                                            @endif
                                            @php
                                                $regens = $post->regency;
                                                $ri = 1;
                                            @endphp
                                            <div class="relative mb-4 w-full" 
                                                x-data="{
                                                            active: 1,
                                                            loop() {
                                                                setInterval(() => { this.active = this.active === {{count($regens)}} ? 1 : this.active+1 }, {{count($regens)}}000)
                                                            },
                                                        }"
                                                x-init="loop">
                                                <div class="flex flex-row overflow-x-hidden relative text-gray-900 text-xs sm:text-base font-medium w-full">
                                                    @foreach($regens as $regen)
                                                        <div
                                                            class="mb-2 w-full"
                                                            x-show="active == {{$ri}}"
                                                            x-transition:enter="transition duration-1000"
                                                            x-transition:enter-start="transform translate-x-full"
                                                            x-transition:enter-end="transform translate-x-0"
                                                        >
                                                                <p class="w-full">{{$regen->name}}</p>
                                                        </div>
                                                    @php $ri= $ri+1 @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                            <p class="text-gray-400 text-xs sm:text-md font-medium mb-4"> 
                                                @php
                                                $minutes = $thistime->diffInMinutes($post->updated_at);
                                                $hours = $thistime->diffInHours($post->updated_at);
                                                $days = $thistime->diff($post->updated_at)->days;
                                                $weeks = $thistime->diffInWeeks($post->updated_at);
                                                $months = $thistime->diffInMonths($post->updated_at);
                                                $years = $thistime->diffInYears($post->updated_at);
                                                @endphp
                                                @if($minutes <= 60)
                                                    {{$minutes}} menit yang lalu
                                                @elseif($hours <= 24)
                                                    {{$hours}} jam yang lalu
                                                @elseif($days <= 7)
                                                    {{$days}} hari yang lalu
                                                @elseif($weeks <= 4)
                                                    {{$weeks}} minggu yang lalu
                                                @elseif($months <= 12)
                                                    {{$months}} bulan yang lalu
                                                @else
                                                    {{$years}} tahun yang lalu
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @if(Auth::user() != null)
                                    @php $getpostid = null @endphp
                                    @foreach($simpan_job as $simjob)
                                    @if($simjob->post_id == $post->id)
                                    @php $getpostid = $simjob->post_id @endphp
                                    @endif
                                    @endforeach
                                    @if($getpostid == $post->id)
                                        <div class="mb-2 text-right z-10 px-4">
                                            <button wire:click="delSaveJob({{$post->id}})" class="w-10 h-10 focus:outline-none rounded-3xl hover:bg-gray-300">
                                                <i class="fa-solid fa-bookmark"></i>
                                            </button>
                                        </div>
                                    @else
                                        <div class="mb-2 text-right z-10 px-4">
                                            <button wire:click="saveJob({{$post->id}})" class="w-10 h-10 focus:outline-none rounded-3xl hover:bg-gray-300">
                                                <i class="fa-regular fa-bookmark"></i>
                                            </button>
                                        </div>
                                    @endif
                                    @endif
                                </div>
                                </div>
                                @endif
                                @endforeach
                            @endif
                            </div>
                            <!-- /DATA EVEN -->
                        </div>
                    </div>


                    <div class="flex py-4 place-content-center">
                        <div x-data="{
                            observe(){
                                const observer = new IntersectionObserver((jobs) =>{
                                    jobs.forEach(jobs => {
                                        if(jobs.isIntersecting){
                                            @this.loadMore()
                                        }
                                    })
                                })
                                observer.observe(this.$el)
                            }
                        }"
                        x-init="observe"></div>
                    </div>
                </div>
            </div>
        </div> 
                    @if($post_detail != null)

                        <div class="hidden flex flex-col ml-4 mr-3 sm:flex w-2/3 myframe">

                                                
                            <div class="child01 ml-4 mr-8">
                                
                                <div class="flex flex-row">

                                    <div class="shadow-lg mr-4 rounded-lg">
                                        
                                        <div class="button-container-2">
                                            <span class="mas">Lamar Sekarang</span>
                                            <button wire:click="openModal" type="button" name="Hover">Lamar Sekarang</button>
                                        </div>

                                    </div>

                                    @if(Auth::user() != null)
                                    @php $getpostid = null @endphp
                                    @foreach($simpan_job as $simjob)
                                    @if($simjob->post_id == $post_detail->id)
                                    @php $getpostid = $simjob->post_id @endphp
                                    @endif
                                    @endforeach
                                    @if($getpostid == $post_detail->id)
                                    <div wire:click="delSaveJob({{$post_detail->id}})" class="shadow-lg mr-4 rounded-lg">

                                        <div class="button-container-1">
                                            <span class="mas">Lowongan Tersimpan</span>
                                            <button id='work' type="button" name="Hover">Lowongan Tersimpan</button>
                                        </div>

                                    </div>

                                    @else

                                    <div wire:click="saveJob({{$post_detail->id}})" class="shadow-lg mr-4 rounded-lg">

                                        <div class="button-container-1">
                                            <span class="mas">Simpan Lowongan</span>
                                            <button id='work' type="button" name="Hover">Simpan Lowongan</button>
                                        </div>

                                    </div>

                                    
                                    @endif

                                    @endif

                                </div>

                            </div>
                            
                            <div class="child top-0">

                            <livewire:post-data :post="$post_detail" :key="$post_detail['id']"/>

                            </div>

                        </div>

                    @else

                        <div class="hidden flex flex-col bg-white shadow-xl sm:rounded-lg ml-4 mr-3 my-8 sm:flex w-2/3 myframe">

                            <div>

                                <img class="mx-auto mt-48 h-96 w-96" src="{{url('storage/photos/h3.svg')}}">

                                
                                <h5 class="font-bold font-serif text-xl text-center mx-auto">

                                We have {{$postall}} jobs for you

                                </h5>

                                <h5 class="font-medium font-serif text-xl text-center mx-auto">

                                Select a job to view details

                                </h5>

                            </div>

                        </div>

                    @endif

                   

        </div>

        @if ($isOpen)
    @include('livewire.posts.lamar')
@endif
@if ($isSuccess)
   @include('livewire.posts.lkirim')
@endif
    </div>

</div>


<div class="banner sm:hidden flex flex-row fixed justify-center z-50 left-0 right-0 bottom-0">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylee.css') }}">
</head>

<body class="bodyy">

    <ul class="nav">
        <span class="nav-indicator2"></span>
        <li>
            <a class="animate-bounce" href="{{ url('account') }}">
                <ion-icon name="people-circle-outline"></ion-icon>
                <span class="title">About Us</span>
            </a>
        </li>
        <li>
            <a href="{{ url('lowongan/sj_send=') }}" class="nav-item-active">
                <ion-icon name="search-outline"></ion-icon>
                <span class="title">Search</span>
            </a>
        </li>
        <li>
            <a href="{{ url('') }}">
                <ion-icon name="home-outline"></ion-icon>
                <span class="title">Homepage</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user/saveloker') }}">
                <ion-icon name="bookmarks-outline"></ion-icon>
                <span class="title">Bookmark</span>
            </a>
        </li>
        <li>
            <a class="open-side">
                <ion-icon name="person-outline"></ion-icon>
                <span class="title">Account</span>
            </a>
        </li>
    </ul>


    <!-- https://css-tricks.com/gooey-effect/ -->

    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="filter-svg">
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                <feBlend in="SourceGraphic" in2="goo" />
            </filter>
        </defs>
    </svg>
    

</body>
</div>
<script>
function openJobs(dataId){
    window.open("{{url('posts/')}}/"+dataId,'_blank');
}


if('{{$this->search1}}' != ''){
    alert('cek emit')
    window.livewire.emit('searchJob', ['{{$this->search0}}','{{$this->search1}}','{{$this->search2}}','{{$this->search3}}','{{$this->search4}}','{{$this->search5}}']);
}
    $(document).ready(function(){
        // alert('{{$this->search1}}')

        // $('.daft-job').click(function(){

        //     var dataId = $(this).attr("data-id");

        //     console.log(dataId);

        //     var url = "{{url('dashboard/posts/')}}/"+dataId+" #post-frame";

        //     console.log(url);

        //     if($('.myframe').is(":visible")){

        //         // $('.myframe').load("{{url('dashboard/posts/')}}/"+dataId+" #post-frame");
        //         window.livewire.on('postDetail', () => {
        //             // alert('A post was added with the id of: ');
        //             $('.loadings').show();
        //         })
        //         window.livewire.emit('postDetail', dataId);

        //     } else{

        //         window.open("{{url('dashboard/posts/')}}/"+dataId,'_blank');

        //     }

        // })

    

    });



var stickyOffset = $('.sticky').offset().top;

$(window).scroll(function(){
  var sticky = $('.sticky'),
      scroll = $(window).scrollTop();
    
  if (scroll >= stickyOffset) sticky.addClass('fixeddd');
  else sticky.removeClass('fixeddd');
});

$(window).scroll(function() {

if ($(this).scrollTop()>250)
 {
    $('.a').fadeOut();
    $('.case').each(function() {
    var link = $(this).html();
    $(this).wrap('<a href="#"></a>');
    });
 }
else
 {
  $('.a').fadeIn();
 }
});


let nav = document.querySelector('.nav')

nav.querySelectorAll('li a').forEach((a, i) => {
a.onclick = (e) => {
if (a.classList.contains('nav-item-active')) return

nav.querySelectorAll('li a').forEach(el => {
    el.classList.remove('nav-item-active')
})

a.classList.add('nav-item-active')

let nav_indicator = nav.querySelector('.nav-indicator2')

nav_indicator.style.left = `calc(${(i * 80) + 40}px - 45px)`
}
})

var lastScrollTop = 0;
$(window).scroll(function(){
  var st = $(this).scrollTop();
  var banner = $('.banner');
  setTimeout(function(){
    if (st > lastScrollTop){
      banner.addClass('hide');
    } else {
      banner.removeClass('hide');
    }
    lastScrollTop = st;
  }, 100);
});


function myFunction() {
  var copyText = document.getElementById("myInput");

  copyText.select();
  copyText.setSelectionRange(0, 99999);

  navigator.clipboard.writeText(copyText.value);
  
  alert("Tautan Berhasil Disalin");
}
</script>

<script>
window.onscroll = function() {scrollTop()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function scrollTop() {
  if (window.pageYOffset > sticky) {
    header.classList.add("fixeddd");
  } else {
    header.classList.remove("fixeddd");
  }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

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
    var route = "{{ url('autocomplete-search') }}";
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