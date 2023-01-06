<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if(Auth::guard('employer')->user() != null)
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                @if(Auth::guard('employer')->user()->profile_photo_path != null)
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ url(Auth::guard('employer')->user()->profile_photo_path) }}" alt="{{ Auth::guard('employer')->user()->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>
                @endif

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>


                <x-jet-input-error for="photo" class="mt-2" />
            </div>

            <!-- First Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Nama Perusahaan') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <!-- Tagline -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="tagline" value="{{ __('Tagline') }}" />
                <x-jet-input id="tagline" type="text" class="mt-1 block w-full" wire:model.defer="state.tagline" autocomplete="tagline" />
                <x-jet-input-error for="tagline" class="mt-2" />
            </div>

            <!-- Deskripsi -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="desc" value="{{ __('Tentang Perusahaan') }}" />
                <x-jet-input id="desc" type="text" class="mt-1 block w-full" wire:model.defer="state.desc" autocomplete="desc" />
                <x-jet-input-error for="desc" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>

            <!-- Telepon -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="telepon" value="{{ __('Nomor Telepon') }}" />
                <x-jet-input id="telepon" type="text" class="mt-1 block w-full" wire:model.defer="state.telepon" autocomplete="telepon" />
                <x-jet-input-error for="telepon" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="flex flex-row">
                    <!-- Alamat -->
                    <div class="w-3/4 mr-2">
                        <x-jet-label for="alamat" value="{{ __('Alamat Perusahaan') }}" />
                        <x-jet-input id="alamat" type="text" class="mt-1 block w-full" wire:model.defer="state.alamat" autocomplete="alamat" />
                        <x-jet-input-error for="alamat" class="mt-2" />
                    </div>

                    <!-- Kode Pos -->
                    <div class="w-1/4">
                        <x-jet-label for="kodepos" value="{{ __('Kode Pos') }}" />
                        <x-jet-input id="kodepos" type="text" class="mt-1 block w-full" wire:model.defer="state.kodepos" autocomplete="kodepos" />
                        <x-jet-input-error for="kodepos" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="flex flex-row">
                    <!-- Provinsi -->
                    <div class="w-1/2 mr-2">
                        <x-jet-label for="provinsi" value="{{ __('Provinsi') }}" />
                        <input type="hidden" wire:model.defer="state.provinsi" autocomplete="off" id="provinsi">
                        <x-jet-input id="province_name" type="text" class="mt-1 block w-full" autocomplete="off" wire:model.defer="province_name" @keydown="$wire.getProvince(); modalProvince=true" />
                        <x-jet-input-error for="provinsi" class="mt-2" />
                        <div class="static w-full bg-white rounded-b border border-solid border-gray-400 py-1" x-show="modalProvince" @click.away="modalProvince=false">
                            @if($provinces)
                                @foreach($provinces as $province)
                                <div wire:click="setProvince({{$province->id}},'{{$province->name}}')" @click="modalProvince=false" class="py-1 px-2 w-full text-left cursor-pointer hover:bg-gray-400">{{$province->name}}</div>
                                <hr>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="w-1/2">
                        <x-jet-label for="kota" value="{{ __('Kota') }}" />
                        <input type="hidden" wire:model.defer="state.kota" autocomplete="off" id="kota">
                        <x-jet-input id="city_name" type="text" class="mt-1 block w-full" autocomplete="off" wire:model.defer="city_name" @keydown="$wire.getCity(); modalDistrict=true" />
                        @if(session()->has('message_kota'))
                        <p class="text-sm text-red-600">{{session('message_kota')}}</p>
                        @endif
                        <x-jet-input-error for="kota" class="mt-2" />
                        <div class="static w-full bg-white rounded-b border border-solid border-gray-400 py-1" x-show="modalDistrict" @click.away="modalDistrict=false">
                            @if($cities)
                                @foreach($cities as $city)
                                <div wire:click="setCity({{$city->id}},'{{$city->name}}')" @click="modalDistrict=false" class="py-1 px-2 w-full text-left cursor-pointer hover:bg-gray-400">{{$city->name}}</div>
                                <hr>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                                wire:model="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />

                    <x-jet-label for="photo" value="{{ __('Photo') }}" />

                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        @if($this->user->profile_photo_path != null)
                        <img src="{{ url($this->user->profile_photo_path) }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                        @else
                        <img src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                        @endif
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        <span class="block rounded-full w-20 h-20"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-jet-secondary-button>


                    <x-jet-input-error for="photo" class="mt-2" />
                </div>

            <!-- Referral Link -->
            @if(Auth::user()->user_type == 'administr' || Auth::user()->user_type == 'afiliator')
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="input_link" value="{{ __('Tautan Referal') }}" />
                <div class="flex flex-row">
                    <div class="w-1/2 mr-1">
                        <x-jet-label for="input_link1" value="{{ __('Referal Untuk User') }}" />
                        <div class="flex">
                            <x-jet-input readonly id="input_link1" type="text" class="mt-1 block w-full text-gray-300 rounded-tl rounded-bl" value="{{url('join/'.$state['referral'])}}" autocomplete="input_link1" />
                            <button type="button" onclick="copyInputLink(1)" class="mt-1 p-4 bg-gray-100 border-b border-t border-r rounded-tr rounded-br border-solid border-gray-300">
                                <i class="fa-solid fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <div class="w-1/2 mr-1">
                        <x-jet-label for="input_link2" value="{{ __('Referal Untuk Perusahaan') }}" />
                        <div class="flex">
                            <x-jet-input readonly id="input_link2" type="text" class="mt-1 block w-full text-gray-300 rounded-tl rounded-bl" value="{{url('employer/join/'.$state['referral'])}}" autocomplete="input_link2" />
                            <button type="button" onclick="copyInputLink(2)" class="mt-1 p-4 bg-gray-100 border-b border-t border-r rounded-tr rounded-br border-solid border-gray-300">
                                <i class="fa-solid fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <x-jet-input-error for="input_link" class="mt-2" />
            </div>
            @endif

            <!-- First Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="state.first_name" autocomplete="first_name" />
                <x-jet-input-error for="first_name" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="state.last_name" autocomplete="last_name" />
                <x-jet-input-error for="last_name" class="mt-2" />
            </div>

            <!-- Profesi -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="profesi" value="{{ __('Profesi') }}" />
                <x-jet-input id="profesi" type="text" class="mt-1 block w-full" wire:model.defer="state.profesi" autocomplete="profesi" />
                <x-jet-input-error for="profesi" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>

            <!-- Telepon -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="telepon" value="{{ __('Nomor Telepon') }}" />
                <x-jet-input id="telepon" type="text" class="mt-1 block w-full border-gray-300 border-t border-b border-l" wire:model.defer="state.telepon" autocomplete="telepon" />
                <x-jet-input-error for="telepon" class="mt-2" />
            </div>

            <!-- Birth Date -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="mb-1" for="birth_date" value="{{ __('Ulang Tahun') }}" />
                <x-jet-date-picker class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="birth_date" name="birth_date" wire:model.defer="state.birth_date" placeholder="0000-00-00">
                </x-jet-date-picker>
                <x-jet-input-error for="birth_date" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="flex flex-row">
                    <!-- Alamat -->
                    <div class="w-3/4 mr-2">
                        <x-jet-label for="alamat" value="{{ __('Alamat') }}" />
                        <x-jet-input id="alamat" type="text" class="mt-1 block w-full" wire:model.defer="state.alamat" autocomplete="alamat" />
                        <x-jet-input-error for="alamat" class="mt-2" />
                    </div>

                    <!-- Kode Pos -->
                    <div class="w-1/4">
                        <x-jet-label for="kodepos" value="{{ __('Kode Pos') }}" />
                        <x-jet-input id="kodepos" type="text" class="mt-1 block w-full" wire:model.defer="state.kodepos" autocomplete="kodepos" />
                        <x-jet-input-error for="kodepos" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4" x-data="{ modalCity:false, modalProvince:false }">
                <div class="flex flex-row">
                    <!-- Provinsi -->
                    <div class="w-1/2 mr-2">
                        <x-jet-label for="provinsi" value="{{ __('Provinsi') }}" />
                        <input type="hidden" wire:model.defer="state.provinsi" autocomplete="off" id="provinsi">
                        <x-jet-input id="province_name" type="text" class="mt-1 block w-full" autocomplete="off" wire:model.defer="province_name" @keydown="$wire.getProvince(); modalProvince=true" />
                        <x-jet-input-error for="provinsi" class="mt-2" />
                        <div class="static w-full bg-white rounded-b border border-solid border-gray-400 py-1" x-show="modalProvince" @click.away="modalProvince=false">
                            @if($provinces)
                                @foreach($provinces as $province)
                                <div wire:click="setProvince({{$province->id}},'{{$province->name}}')" @click="modalProvince=false" class="py-1 px-2 w-full text-left cursor-pointer hover:bg-gray-400">{{$province->name}}</div>
                                <hr>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="w-1/2">
                        <x-jet-label for="kota" value="{{ __('Kota') }}" />
                        <input type="hidden" wire:model.defer="state.kota" autocomplete="off" id="kota">
                        <x-jet-input id="city_name" type="text" class="mt-1 block w-full" autocomplete="off" wire:model.defer="city_name" @keydown="$wire.getCity(); modalCity=true" />
                        @if(session()->has('message_kota'))
                        <p class="text-sm text-red-600">{{session('message_kota')}}</p>
                        @endif
                        <x-jet-input-error for="kota" class="mt-2" />
                        <div class="static w-full bg-white rounded-b border border-solid border-gray-400 py-1" x-show="modalCity" @click.away="modalDimodalCitystrict=false">
                            @if($cities)
                                @foreach($cities as $city)
                                <div wire:click="setCity({{$city->id}},'{{$city->name}}')" @click="modalCity=false" class="py-1 px-2 w-full text-left cursor-pointer hover:bg-gray-400">{{$city->name}}</div>
                                <hr>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
<script>
    function copyInputLink(id){
    // Get the text field
    var copyText = document.getElementById("input_link"+id);
  
    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
  
     // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
  
    // Alert the copied text
    alert("Tautan berhasil disalin");
    
}
</script>