<x-slot name="header">
    <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Post
    </h2> -->
</x-slot>

<x-slot name="footer">
</x-slot>
<div class="pt-0 sm:pt-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="post-frame">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                    role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($isOpen)
                @include('livewire.posts.lamar')
            @endif
            @if ($isSuccess)
                @include('livewire.posts.lkirim')
            @endif
                <div class="flex-auto m-1">
                    <div class="grid grid-flow-col">
                        <div class="py-4">
                        @if(count($post->images) != 0)
                        @foreach ($post['images'] as $image)
                            <img class="h-40 sm:h-96" src="{{ url($image->url) }}" alt="{{ $image->description }}" width="100%">
                        @endforeach
                        @else
                            <img class="h-40 sm:h-72" width="100%" src="{{ url('storage/photos/default_jobs.png') }}" alt="this is default">
                        @endif
                        </div>
                    </div>

                                    <div>
                                        @if($post->employer_id != null)
                                            @if($post->author_employer->profile_photo_path != null)
                                                <img class="h-15 sm:h-20 w-15 sm:w-20 rounded-lg object-contain my-4" src="{{url($post->author_employer->profile_photo_path)}}" alt="{{$post->author_employer->name}}" />
                                            @else
                                                <img class="h-15 sm:h-20 w-15 sm:w-20 rounded-lg object-contain" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{$post->author_employer->name}}" />
                                            @endif
                                        @else
                                            @if($post->author->profile_photo_path != null)
                                                <img class="h-15 sm:h-20 w-15 sm:w-20 rounded-lg object-contain my-4" src="{{ $post->author->profile_photo_path }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                                            @else
                                                <img class="h-15 sm:h-20 w-15 sm:w-20 rounded-lg object-contain" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                                            @endif
                                        @endif
                                    </div>

                                <div class="hidden sm:flex flex-row" id="myHeader">

                                    <div class="marginstick">
                                    
                                        <div class="font-bold text-xl mb-2">
                                            @php
                                            $postt = $post->postTitles;
                                            for($i=0;$i < count($postt);$i++){
                                                if($i+1 == count($postt)){
                                                    echo $postt[$i]->title;
                                                }else{
                                                    echo $postt[$i]->title." - ";
                                                }
                                            }
                                            @endphp
                                        </div>
                                        <h5 class="text-lg font-medium">
                                            @php
                                            $regens = $post->regency;
                                            $dists = $post->district;
                                            for($i=0;$i < count($regens);$i++){
                                            if($i+1 == count($regens)){
                                                echo ucwords(strtolower($regens[$i]->name));
                                            }else{
                                                echo ucwords(strtolower($regens[$i]->name.", "));
                                                }
                                            }
                                            for($i=0;$i < count($dists);$i++){
                                            if($i+1 == count($dists)){
                                                echo ucwords(strtolower(", ".$dists[$i]->name));
                                            }else{
                                                echo ucwords(strtolower($dists[$i]->name.", "));
                                                }
                                            }
                                            @endphp
                                        </h5>
                                        <div class="text-md">
                                            @if($post->salary_check == 1)
                                            Rp {{ number_format($post->salary_start,0,',','.').' - Rp '.number_format($post->salary_end,0,',','.') }}
                                            @endif
                                        </div>
                                        @if($post->employer_id != null)
                                            <div class="flex flex-col sm:flex-row my-2">
                                                <p>by&nbsp;<span class="italic">{{$post->author_employer->name}}</span></p>
                                                &nbsp;on&nbsp;{{ $post->updated_at->format('F, d Y') }}
                                            </div>
                                        @else
                                            <div class="flex flex-col sm:flex-row mb-4 sm:mb-0">
                                                <p>by&nbsp;<span class="italic">{{ $post->author->first_name . ' ' . $post->author->last_name }}</span></p>
                                                &nbsp;on&nbsp;{{ $post->updated_at->format('F, d Y') }}
                                            </div>
                                        @endif
                                        <div id="location" data-id="{{$post->location_id}}"></div>
                                    </div>

                                    <div class="flex flex-row ml-auto marginstick1">

                                        <div class="flex w-44 sm:w-full mt-0 sm:mt-6 mb-4 sm:mb-0 mr-4 rounded-lg">
                                            
                                            <div class="shadow-lg button-container-2">
                                                <span class="mas">Lamar Sekarang</span>
                                                <button wire:click="openModal" type="button" name="Hover">Lamar Sekarang</button>
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
                                        <div wire:click="delSaveJob({{$post->id}})" class="marginstick1 flex w-44 sm:w-full mt-0 sm:mt-6 mb-4 sm:mb-0 rounded-lg">

                                            <div class="shadow-lg button-container-1">
                                                <span class="mas">Lowongan Tersimpan</span>
                                                <button id='work' type="button" name="Hover">Lowongan Tersimpan</button>
                                            </div>

                                        </div>

                                        @else

                                        <div wire:click="saveJob({{$post->id}})" class="marginstick1 flex w-44 sm:w-full mt-0 sm:mt-6 mb-4 sm:mb-0 rounded-lg">

                                            <div class="shadow-lg button-container-1">
                                                <span class="mas">Simpan Lowongan</span>
                                                <button id='work' type="button" name="Hover">Simpan Lowongan</button>
                                            </div>

                                        </div>

                                        @endif

                                        @endif

                                    </div>

                                </div>


                                <div class="stickyy flex-col sm:hidden">

                                    <div class="fixt">
                                    
                                        <div class="font-bold text-xl mb-2">
                                            @php
                                            $postt = $post->postTitles;
                                            for($i=0;$i < count($postt);$i++){
                                                if($i+1 == count($postt)){
                                                    echo $postt[$i]->title;
                                                }else{
                                                    echo $postt[$i]->title." - ";
                                                }
                                            }
                                            @endphp
                                        </div>
                                        <h5 class="text-lg font-medium">
                                            @php
                                            $regens = $post->regency;
                                            for($i=0;$i < count($regens);$i++){
                                            if($i+1 == count($regens)){
                                                echo ucwords(strtolower($regens[$i]->name));
                                            }else{
                                                echo ucwords(strtolower($regens[$i]->name.", "));
                                                }
                                            }
                                            @endphp
                                        </h5>
                                        <div class="text-md">
                                            @if($post->salary_check == 1)
                                            Rp {{ number_format($post->salary_start,0,',','.').' - Rp '.number_format($post->salary_end,0,',','.') }}
                                            @endif
                                        </div>
                                        @if($post->employer_id != null)
                                            <div class="flex flex-col sm:flex-row mb-4">
                                                <p>by&nbsp;<span class="italic">{{$post->author_employer->name}}</span></p>
                                                &nbsp;on&nbsp;{{ $post->updated_at->format('F, d Y') }}
                                            </div>
                                        @else
                                            <div class="flex flex-col sm:flex-row mb-4">
                                                <p>by&nbsp;<span class="italic">{{ $post->author->first_name . ' ' . $post->author->last_name }}</span></p>
                                                &nbsp;on&nbsp;{{ $post->updated_at->format('F, d Y') }}
                                            </div>
                                        @endif
                                        <div id="location" data-id="{{$post->location_id}}"></div>
                                    </div>

                                    <div class="flex flex-row ml-auto fixt">

                                        <div class="flex w-44 sm:w-full mt-0 sm:mt-6 mb-4 sm:mb-0 mr-4 rounded-lg">
                                            
                                            <div class="shadow-lg button-container-2">
                                                <span class="mas">Lamar Sekarang</span>
                                                <button wire:click="openModal" type="button" name="Hover">Lamar Sekarang</button>
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
                                        <div wire:click="delSaveJob({{$post->id}})" class="marginstick1 flex w-44 sm:w-full mt-0 sm:mt-6 mb-4 sm:mb-0 rounded-lg">

                                            <div class="shadow-lg button-container-1">
                                                <span class="mas">Lowongan Tersimpan</span>
                                                <button id='work' type="button" name="Hover">Lowongan Tersimpan</button>
                                            </div>

                                        </div>

                                        @else

                                        <div wire:click="saveJob({{$post->id}})" class="marginstick1 flex w-44 sm:w-full mt-0 sm:mt-6 mb-4 sm:mb-0 rounded-lg">

                                            <div class="shadow-lg button-container-1">
                                                <span class="mas">Simpan Lowongan</span>
                                                <button id='work' type="button" name="Hover">Simpan Lowongan</button>
                                            </div>

                                        </div>

                                        @endif

                                        @endif

                                    </div>

                                </div>
                    
                    
                
                    <div id="content{{$post->id}}" class="text-gray-700 text-base m-auto mt-10" readonly="readonly" x-data
                        x-init="
                        ClassicEditor
                        .create( $refs.editordescription{{$post->id}})
                        .then(function(editor){
                            const toolbarElement = editor.ui.view.toolbar.element;
                            toolbarElement.style.display = 'none';
                            editor.enableReadOnlyMode('content{{$post->id}}');
                        })
                        .catch( error => {
                            console.error( error );
                        });" x-ref="editordescription{{$post->id}}">
                        <p>{!! $post->content !!}</p>
                    </div>

                <div class="flex flex-col">
                    <div class="flex sm:flex-col mt-10">
                        <div class="text-xl font-medium">Informasi Tambahan :</div>                
                    </div>
                            <div class="grid grid-flow-row grid-cols-2 mt-5">
                                @if(count($post->tingkatkerja) != null)
                                <div class="w-44 sm:w-full h-24 mb-3 sm:mb-0">
                                    <p class="font-bold"> Tingkat Pekerjaan </p>
                                    @php
                                    $tingkatkerja = $post->tingkatkerja;
                                    @endphp
                                    @for($i=0;$i < count($tingkatkerja);$i++)
                                        @if($i+1 == count($tingkatkerja))
                                        <a href="{{ url('/lowongan/tk_send='.$tingkatkerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$tingkatkerja[$i]->name_tk}}
                                        </a>
                                            @else
                                        <a href="{{ url('/lowongan/tk_send='.$tingkatkerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$tingkatkerja[$i]->name_tk}}
                                        </a>
                                        <br>
                                        @endif
                                    @endfor
                                </div>
                                @endif
                                @if(count($post->pengalamankerja) != null)
                                <div class="w-44 sm:w-full h-24 mb-3 sm:mb-0">
                                    <p class="font-bold"> Pengalaman kerja </p>
                                    @php
                                    $pengalamankerja = $post->pengalamankerja;
                                    @endphp
                                    @for($i=0;$i < count($pengalamankerja);$i++)
                                        @if($i+1 == count($pengalamankerja))
                                        <a href="{{ url('/lowongan/pk_send='.$pengalamankerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$pengalamankerja[$i]->name_pk}}
                                        </a>
                                            @else
                                        <a href="{{ url('/lowongan/pk_send='.$pengalamankerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$pengalamankerja[$i]->name_pk}}
                                        </a>
                                        <br>
                                        @endif
                                    @endfor
                                </div>
                                @endif
                                <!-- </div>
                                <div class="flex flex-row"> -->
                                @if(count($post->kualifikasilulus) != null)
                                <div class="w-44 sm:w-full h-24 mb-3 sm:mb-0">
                                    <p class="font-bold"> Kualifikasi </p>
                                    @php
                                    $kualifikasilulus = $post->kualifikasilulus;
                                    @endphp
                                    @for($i=0;$i < count($kualifikasilulus);$i++)
                                        @if($i+1 == count($kualifikasilulus))
                                        <a href="{{ url('/lowongan/kl_send='.$kualifikasilulus[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$kualifikasilulus[$i]->name_kl}}
                                        </a>
                                            @else
                                        <a href="{{ url('/lowongan/kl_send='.$kualifikasilulus[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$kualifikasilulus[$i]->name_kl}}
                                        </a>
                                        <br>
                                        @endif
                                    @endfor
                                </div>
                                @endif
                                @if(count($post->jeniskerja) != null)
                                <div class="w-44 sm:w-full h-24 mb-3 sm:mb-0">
                                    <p class="font-bold"> Jenis Pekerjaan </p>
                                    @php
                                    $jeniskerja = $post->jeniskerja;
                                    @endphp
                                    @for($i=0;$i < count($jeniskerja);$i++)
                                        @if($i+1 == count($jeniskerja))
                                        <a href="{{ url('/lowongan/jk_send='.$jeniskerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$jeniskerja[$i]->name_jk}}
                                        </a>
                                            @else
                                        <a href="{{ url('/lowongan/jk_send='.$jeniskerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$jeniskerja[$i]->name_jk}}
                                        </a>
                                        <br>
                                        @endif
                                    </a>
                                    @endfor
                                </div>
                                 @endif
                                <!-- </div>
                                <div class="flex flex-row mt-4"> -->
                                <div class="w-44 sm:w-full h-24 mb-3 sm:mb-0">
                                    @if(count($post->spesialiskerja) != null)
                                    <p class="font-bold"> Spesialisasi pekerjaan </p>
                                    @php
                                    $spesialiskerja = $post->spesialiskerja;
                                    @endphp
                                    @for($i=0;$i < count($spesialiskerja);$i++)
                                        @if($i+1 == count($spesialiskerja))
                                        <a href="{{ url('/lowongan/sk_send='.$spesialiskerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$spesialiskerja[$i]->name_sk}}
                                        </a>
                                            @else
                                        <a href="{{ url('/lowongan/sk_send='.$spesialiskerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$spesialiskerja[$i]->name_sk}}
                                        </a>
                                        <br>
                                        @endif
                                    @endfor
                                    @endif
                                </div>
                                <div class="w-44 sm:w-full h-24 mb-3 sm:mb-0">
                                </div>
                            </div>


                            <div class="flex flex-row">
                                <div class="mb-4">
                                <input type="text" value="{{url('posts/'.$post->id)}}" id="myInput" class="invisible">
                                <p class="mb-3 text-2xl"> 
                                    <ion-icon class="z-0 mr-3 mt-2" name="share-social-outline"></ion-icon>Bagikan
                                </p>
                                <button onclick="copyLink()" data-id="{{$post->id}}" class="mr-1 w-8 h-8 text-indigo-100 transition-colors p-1 duration-150 bg-indigo-700 rounded-3xl focus:shadow-outline hover:bg-indigo-800">
                                    <i class="fa-solid fa-link"></i>
                                </button>
                                <a href="https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Flocalhost%3A8000%2F&ref_src=twsrc%5Etfw%7Ctwcamp%5Ebuttonembed%7Ctwterm%5Eshare%7Ctwgr%5E&text=Lowongan Kerja Sebagai {{$post->title}} di {{$post->author_employer->name}}&url={{url('posts/'.$post->id)}}" target="_blank">
                                    <button class="mx-1 w-8 h-8 text-indigo-100 transition-colors p-1 duration-150 bg-indigo-700 rounded-3xl focus:shadow-outline hover:bg-indigo-800">
                                        <i class="fa-brands fa-twitter"></i>
                                    </button>
                                </a>
                                <a href="https://api.whatsapp.com/send/?text=Lowongan Kerja Sebagai {{$post->title}} di {{$post->author_employer->name}} | {{url('posts/'.$post->id)}}" data-action="share/whatsapp/share" target="_blank">
                                <button class="mx-1 w-8 h-8 text-indigo-100 transition-colors p-1 duration-150 bg-green-400 rounded-3xl focus:shadow-outline hover:bg-indigo-800">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </button>    
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u={{url('posts/'.$post->id)}}&display=popup&ref=plugin&src=share_button" target="_blank">    
                                <button class="mx-1 w-8 h-8 text-indigo-100 transition-colors p-1 duration-150 bg-indigo-700 rounded-3xl focus:shadow-outline hover:bg-indigo-800">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </button>  
                                </a>
                                </div>
                            </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="post-frame">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <div class="flex flex-col sm:w-full">
                    <div class="flex flex-auto my-4">
                        <p class="text-xl font-medium ml-4">Kirim Lamaran</p>                
                    </div>
                    <div class="overflow-x-auto sm:overflow-hidden">
                    <div class="flex flex-row ml-4 w-full sm:w-full">
                         @if($post->email != null)
                        <a href="mailto:{{$post->email}}?subject=Lamaran Pekerjaan di {{$post->author_employer->name}} sebagai  {{$post->title}}" target="_blank">
                            <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none 
                            bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 
                            focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 
                            dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <i class="fa-regular fa-envelope"></i> <br/> {{$post->email}}
                            </button>
                        </a>
                        @endif
                        @if($post->wa != null)
                        <a href="https://api.whatsapp.com/send/?text=Lowongan Kerja Sebagai {{$post->title}} di {{$post->author_employer->name}} | {{url('posts/'.$post->id)}}" data-action="share/whatsapp/share" target="_blank">
                            <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none 
                            bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 
                            focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 
                            dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <i class="fa-brands fa-whatsapp"></i> <br/> {{$post->wa}}
                            </button>
                        </a>
                        @endif
                        @if($post->formulir != null)
                        <a href="{{$post->formulir}}" target="_blank">
                            <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none 
                            bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 
                            focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 
                            dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <i class="fa-brands fa-wpforms"></i> formulir
                            </button>
                        </a>
                        @endif
                    </div>
                    </div>
                </div>
        </div>
    </div>
</div>
            
<style>
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border: 0;
    }
</style>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .then( editor => {
            const toolbarElement = editor.ui.view.toolbar.element;
            toolbarElement.style.display = "none";
            editor.enableReadOnlyMode( '#content' );
        } )
        .catch(error => {
            console.error(error);
        });

function copyLink() {
  var copyText = document.getElementById("myInput");

  copyText.select();
  copyText.setSelectionRange(0, 99999); 

  navigator.clipboard.writeText(copyText.value);
  
  alert("Tautan Berhasil Disalin");
}

</script>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky1");
  } else {
    header.classList.remove("sticky1");
  }
}
</script>


<script>
var stickyOffset = $('.stickyy').offset().top;

$(window).scroll(function(){
  var sticky = $('.stickyy'),
      scroll = $(window).scrollTop();

  if (scroll >= stickyOffset) sticky.addClass('fixme');
  else sticky.removeClass('fixme');
});
</script>