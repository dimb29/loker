<div class="mb-72">
    <!-- <div class="w-full px-4">
        <div class="bg-white h-12 sticky overflow-hidden shadow-xl sm:rounded-lg mb-8">asdasd
        </div>
    </div> -->
    <div class="w-full px-4" id="post-frame">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                <div class="daft-job flex-auto">
                    <div class="grid grid-flow-col">
                        @if(count($post->images) != 0)
                        @foreach ($post['images'] as $image)
                            <img class="h-48 lg:h-72" src="{{ url($image->url) }}" alt="{{ $image->description }}" width="100%">
                        @endforeach
                        @else
                            <img class="h-48 lg:h-72" width="100%" src="{{ url('storage/photos/default_jobs.png') }}" alt="this is default">
                        @endif
                    </div>
                    <div class="px-4 mt-4">
                    <div>
                        @if($post->employer_id != null)
                            @if($post->author_employer->profile_photo_path != null)
                                <img class="h-20 w-20 rounded-lg object-contain my-2" src="{{url($post->author_employer->profile_photo_path)}}" alt="{{$post->author_employer->name}}" />
                            @else
                                <img class="h-20 w-20 rounded-lg object-contain my-2" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{$post->author_employer->name}}" />
                            @endif
                        @else
                            @if($post->author->profile_photo_path != null)
                                <img class="h-20 w-20 rounded-lg object-contain my-2" src="{{ url($post->author->profile_photo_path) }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                            @else
                                <img class="h-20 w-20 rounded-lg object-contain my-2" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ $post->author->first_name . ' ' . $post->author->last_name }}" />
                            @endif
                        @endif
                    </div>
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
                    <div class="flex">
                    @if($post->employer_id != null)
                            by&nbsp;<span class="italic">{{$post->author_employer->name}}</span>
                            &nbsp;on&nbsp;{{ $post->updated_at->format('F, d Y') }}
                    @else
                            by&nbsp;<span class="italic">{{ $post->author->first_name . ' ' . $post->author->last_name }}</span>
                            &nbsp;on&nbsp;{{ $post->updated_at->format('F, d Y') }}
                    @endif
                    </div>
                    <div id="content" class="ml-10 mt-6 text-gray-700 text-base m-auto" readonly="readonly">
                        <p>{!! $post->content !!}</p>
                    </div>

                    <div class="flex m-5">
                        <div class="flex flex-col">
                            <div class="flex flex-auto mt-10">
                                <div class="text-xl font-medium">Informasi Tambahan :</div>
                                
                            </div>
                            <div class="grid grid-flow-row grid-cols-2 mt-5">
                                @if(count($post->tingkatkerja) != null)
                                <div class="w-44 lg:w-96 h-24">
                                    <p class="font-bold"> Tingkat Pekerjaan </p>
                                    @php
                                    $tingkatkerja = $post->tingkatkerja;
                                    @endphp
                                    @for($i=0;$i < count($tingkatkerja);$i++)
                                        @if($i+1 == count($tingkatkerja))
                                        <a href="{{ url('/dashboard/lowongan/tk_send='.$tingkatkerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$tingkatkerja[$i]->name_tk}}
                                        </a>
                                            @else
                                        <a href="{{ url('/dashboard/lowongan/tk_send='.$tingkatkerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$tingkatkerja[$i]->name_tk}}
                                        </a>
                                        <br>
                                        @endif
                                    @endfor
                                </div>
                                @endif
                                @if(count($post->pengalamankerja) != null)
                                <div class="w-64 h-24">
                                    <p class="font-bold"> Pengalaman kerja </p>
                                    @php
                                    $pengalamankerja = $post->pengalamankerja;
                                    @endphp
                                    @for($i=0;$i < count($pengalamankerja);$i++)
                                        @if($i+1 == count($pengalamankerja))
                                        <a href="{{ url('/dashboard/lowongan/pk_send='.$pengalamankerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$pengalamankerja[$i]->name_pk}}
                                        </a>
                                            @else
                                        <a href="{{ url('/dashboard/lowongan/pk_send='.$pengalamankerja[$i]->id) }}"
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
                                <div class="w-44 lg:w-96 h-24">
                                    <p class="font-bold"> Kualifikasi </p>
                                    @php
                                    $kualifikasilulus = $post->kualifikasilulus;
                                    @endphp
                                    @for($i=0;$i < count($kualifikasilulus);$i++)
                                        @if($i+1 == count($kualifikasilulus))
                                        <a href="{{ url('/dashboard/lowongan/kl_send='.$kualifikasilulus[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$kualifikasilulus[$i]->name_kl}}
                                        </a>
                                            @else
                                        <a href="{{ url('/dashboard/lowongan/kl_send='.$kualifikasilulus[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$kualifikasilulus[$i]->name_kl}}
                                        </a>
                                        <br>
                                        @endif
                                    @endfor
                                </div>
                                @endif
                                @if(count($post->jeniskerja) != null)
                                <div class="w-64 h-24">
                                    <p class="font-bold"> Jenis Pekerjaan </p>
                                    @php
                                    $jeniskerja = $post->jeniskerja;
                                    @endphp
                                    @for($i=0;$i < count($jeniskerja);$i++)
                                        @if($i+1 == count($jeniskerja))
                                        <a href="{{ url('/dashboard/lowongan/jk_send='.$jeniskerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$jeniskerja[$i]->name_jk}}
                                        </a>
                                            @else
                                        <a href="{{ url('/dashboard/lowongan/jk_send='.$jeniskerja[$i]->id) }}"
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
                                <div class="w-44 lg:w-96 h-24">
                                    @if(count($post->spesialiskerja) != null)
                                    <p class="font-bold"> Spesialisasi pekerjaan </p>
                                    @php
                                    $spesialiskerja = $post->spesialiskerja;
                                    @endphp
                                    @for($i=0;$i < count($spesialiskerja);$i++)
                                        @if($i+1 == count($spesialiskerja))
                                        <a href="{{ url('/dashboard/lowongan/sk_send='.$spesialiskerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$spesialiskerja[$i]->name_sk}}
                                        </a>
                                            @else
                                        <a href="{{ url('/dashboard/lowongan/sk_send='.$spesialiskerja[$i]->id) }}"
                                            class="text-blue-600">
                                                {{$spesialiskerja[$i]->name_sk}}
                                        </a>
                                        <br>
                                        @endif
                                    @endfor
                                    @endif
                                </div>
                                <div class="w-64 h-24">
                                </div>
                            </div>
                            <div class="flex flex-row">
                                <div class="mb-4">
                                <input type="text" value="{{url('dashboard/posts/'.$post->id)}}" id="myInput" class="invisible">
                                <p class="mx-auto mb-3 text-2xl"> 
                                    <ion-icon class="mr-3" name="share-social-outline"></ion-icon>Bagikan
                                </p>
                                <button onclick="myFunction()" data-id="{{$post->id}}" class="mr-1 w-8 h-8 text-indigo-100 transition-colors p-1 duration-150 bg-indigo-700 rounded-3xl focus:shadow-outline hover:bg-indigo-800">
                                    <i class="fa-solid fa-link"></i>
                                </button>
                                <a href="https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Flocalhost%3A8000%2F&ref_src=twsrc%5Etfw%7Ctwcamp%5Ebuttonembed%7Ctwterm%5Eshare%7Ctwgr%5E&text=Lowongan Kerja Sebagai {{$post->title}} di &url={{url('dashboard/posts/'.$post->id)}}" target="_blank">
                                    <button class="mx-1 w-8 h-8 text-indigo-100 transition-colors p-1 duration-150 bg-indigo-700 rounded-3xl focus:shadow-outline hover:bg-indigo-800">
                                        <i class="fa-brands fa-twitter"></i>
                                    </button>
                                </a>
                                <a href="https://api.whatsapp.com/send/?text=Lowongan Kerja Sebagai {{$post->title}} di | {{url('dashboard/posts/'.$post->id)}}" data-action="share/whatsapp/share" target="_blank">
                                <button class="mx-1 w-8 h-8 text-indigo-100 transition-colors p-1 duration-150 bg-green-400 rounded-3xl focus:shadow-outline hover:bg-indigo-800">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </button>    
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u={{url('dashboard/posts/'.$post->id)}}&display=popup&ref=plugin&src=share_button" target="_blank">    
                                <button class="mx-1 w-8 h-8 text-indigo-100 transition-colors p-1 duration-150 bg-indigo-700 rounded-3xl focus:shadow-outline hover:bg-indigo-800">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </button>  
                                </a>
                                </div>
                            </div>
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
                        </div>
                    </div>
                    </div>
        </div>
    </div>
</div>

<div class="mb-12 mt-12">
    <div class="w-full px-4" id="post-frame">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <div class="flex flex-col sm:w-full overflow-x-auto sm:overflow-hidden">
                    <div class="flex flex-auto my-4">
                        <p class="text-xl font-medium ml-4">Kirim Lamaran</p>                
                    </div>
                    <div class="flex flex-row ml-4 sm:w-full">
                         @if($post->email != null)
                        <a href="mailto:{{$post->email}}?subject=Lamaran Pekerjaan di " target="_blank">
                            <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none 
                            bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 
                            focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 
                            dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <i class="fa-regular fa-envelope"></i> {{$post->email}}
                            </button>
                        </a>
                        @endif
                        @if($post->wa != null)
                        <a href="https://api.whatsapp.com/send/?text=Lowongan Kerja Sebagai {{$post->title}} di | {{url('dashboard/posts/'.$post->id)}}" data-action="share/whatsapp/share" target="_blank">
                            <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none 
                            bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 
                            focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 
                            dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <i class="fa-brands fa-whatsapp"></i> {{$post->wa}}
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
<script>
    $(document).ready(function(){
        $('#salilink').click(function(){
            var dataId = $(this).attr('data-id');
            var posturl = 'https://sayarajin.com/dashboard/posts/'+dataId
            alert(posturl);
            copyText.select();
            alert("Tautan Berhasil Disalin");
            copyText.setSelectionRange(0, 99999); 
            navigator.clipboard.writeText(copyText.value);
        })
    })
</script>
</div>
</div>
</div>
</div>
</div>
</div>


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

// $(document).ready(function(){
//     $('#copy_notif').hide();
//     $('#comment_like').on('click',function(){
//         $('#comment_like').removeClass('fa-regular');
//         $('#comment_like').addClass('fa-solid');
//         console.log(<?php $post->comment ?> + 'bisa yok');
//     });
//     $('#copy_link').on('click',function(){
//         var copyText = $(this).attr('data-link')
//         navigator.clipboard.writeText(copyText);
//         $('#copy_notif').fadeIn();
//         $('#copy_notif').delay(1000).fadeOut();

//     })
// });

function myFunction() {
  var copyText = document.getElementById("myInput");

  copyText.select();
  copyText.setSelectionRange(0, 99999);

  navigator.clipboard.writeText(copyText.value);
  
  alert("Tautan Berhasil Disalin");
}
</script>