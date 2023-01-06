

            <div class="p-6 -mx-9 sm:mx-0 -mt-12 sm:-mt-8">

                <div class="slider">

                    @foreach ($trend as $postrend)

                        <div data-mdb-ripple="true"
				data-mdb-ripple-color="light" class="max-w-sm h-auto sm:h-1/2 mx-0 sm:mx-0 rounded overflow-hidden shadow-xl hover:bg-gray-300 mt-12 m-8
                        rounded-lg hover:text-blue-600 transition duration-150 transform hover:scale-110 hover:-translate-y-2 ">
                                <a  href="{{ url('posts', $postrend->id) }}">
                        
                                <!-- @if(count($postrend->images) != 0)
                                    @foreach ($postrend['images'] as $image)
                                            <img class="object-fit h-48 w-screen rounded-lg" src="{{ url($image->url) }}" alt="{{ $image->description }}">
                                    @endforeach
                                    @else
                                            <img class="object-fit h-48 w-screen rounded-lg" src="{{ url('storage/photos/default_jobs.png') }}" alt="this is default">
                                    @endif -->
                                    
                                    <div class="css-1f2quy8">
                                        <div class="responsive css-1eg7f6s">
                                            <span class="responsive css-10rucli"></span>
                                            @if($postrend->employer_id != null)
                                                @if($postrend->author_employer->profile_photo_path != null)
                                                    <img class="css-1c345mg" src="{{url($postrend->author_employer->profile_photo_path)}}" alt="{{$postrend->author_employer->name}}" />
                                                @else
                                                    <img class="css-1c345mg" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{$postrend->author_employer->name}}" />
                                                @endif
                                            @else
                                                @if($postrend->author->profile_photo_path != null)
                                                    <img class="css-1c345mg" src="{{ url($postrend->author->profile_photo_path) }}" alt="{{ $postrend->author->first_name . ' ' . $postrend->author->last_name }}" />
                                                @else
                                                    <img class="css-1c345mg" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ $postrend->author->first_name . ' ' . $postrend->author->last_name }}" />
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="p-0 sm:p-6">

                                        <div class="px-2 sm:p-0">
                                        @php
                                            $postt = $postrend->postTitles;
                                            $i = 1;
                                            //dd($post->postTitles);
                                        @endphp
                                            <div class="relative mb-4 mt-6 w-full" 
                                            x-data="{
                                                        active: 1,
                                                        loop() {
                                                            setInterval(() => { this.active = this.active === {{count($postt)}} ? 1 : this.active+1 }, 1000)
                                                        },
                                                    }"
                                            x-init="loop">
                                            <div class="flex flex-row overflow-x-hidden relative text-gray-900 text-xl font-semibold w-full">
                                                @foreach($postrend->postTitles as $potitle)
                                                    <div
                                                        class="textl text-blue-700 mb-2 w-full"
                                                        x-show="active == {{$i}}"
                                                        x-transition:enter="transition duration-1000"
                                                        x-transition:enter-start="transform translate-x-full"
                                                        x-transition:enter-end="transform translate-x-0"
                                                    >
                                                            <p class="w-full text-blue-900 text-base sm:text-lg">{{$potitle->title}}</p>
                                                    </div>
                                                @php $i= $i+1 @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                        <h5 class="text-gray-900 text-xs sm:text-sm -ml-1 mb-4 font-semibold">
                                            @if($postrend->salary_check == 1)
                                            Rp {{ number_format($postrend->salary_start,0,',','.').' - Rp '.number_format($postrend->salary_end,0,',','.') }}
                                            @endif
                                        </h5>
                                        @if($postrend->employer_id != null)
                                            <h5 class="textl text-gray-900 text-xs sm:text-base text-blue-600 font-medium">
                                                {{ $postrend->author_employer->name}}
                                            </h5>
                                        @else
                                            <h5 class="textl text-gray-900 text-xs sm:text-base text-blue-600 font-medium">
                                                {{ $postrend->author->first_name . ' ' . $postrend->author->last_name }}
                                            </h5>
                                        @endif
                                        @php
                                            $regens = $postrend->regency;
                                            $dists = $postrend->district;
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
                                                    @foreach($postrend->regency as $regen)
                                                        <div
                                                            class="textlcw-full"
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
                                                            class="textl w-full"
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

                                        <div class="font-medium text-xs sm:text-base text-gray-400 mb-2 mt-4">

                                        <p>
                                            @php
                                            $minutes = $thistime->diffInMinutes($postrend->updated_at);
                                            $hours = $thistime->diffInHours($postrend->updated_at);
                                            $days = $thistime->diff($postrend->updated_at)->days;
                                            $weeks = $thistime->diffInWeeks($postrend->updated_at);
                                            $months = $thistime->diffInMonths($postrend->updated_at);
                                            $years = $thistime->diffInYears($postrend->updated_at);
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

                                </a>

                            

                        </div>

                @endforeach

                </div>

            </div>