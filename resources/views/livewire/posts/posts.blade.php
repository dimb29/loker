<x-slot name="header">
    <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Upload Berita
    </h2> -->
<div class="loading-div fixed z-20 inset-0 place-content-center" hidden>
    <div class="fixed justify-center h-full w-full opacity-25 bg-gray-400"> </div>
    <div class="flex justify-center mt-12">
            <div class="dots mt-96"> </div>
    </div>
</div>
</x-slot>

<x-slot name="footer">
</x-slot>
<div class="py-40">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <button wire:click="create()"
                class="loadings inline-flex items-center px-4 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Create New Post
            </button>
            @if ($isOpen)
                @include('livewire.posts.create')
            @endif
            @if($isOpen2)
                <div class="overflow-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto top-1/4">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button wire:click="closeModal2" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Kuota upload lowongan anda sudah habis!</h3>
                                <!-- <button data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                    Yes, I'm sure
                                </button> -->
                                <button wire:click="closeModal2" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="grid grid-flow-row grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach ($posts as $post)
                    @if(Auth::guard('employer')->user() != null || Auth::user()->user_type == 'administr')
                    <div class="max-w-full sm:max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="px-6 py-4 text-more__container">
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
                            <p class="text-gray-700 text-base">
                                {!! ($post->content) !!}
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <a href="{{ url('posts', $post->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Read post
                            </a>
                            <button wire:click="edit({{ $post->id }})"
                                class="loadings inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </button>
                            <x-jet-delete-button id="{{$post->id}}" wire:click="delete({{$post->id}})" 
                            class="del-btn inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Delete
                            </x-jet-delete-button>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="py-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.loadings').click(function(){
            $('.loading-div').show();
            $('.loading-div').delay(4000).fadeOut();
        })
        $('.del-btn').click(function(){
            var dataId = $(this).attr('data-id')
            $('.sure-del').attr("wire:click", 'delete('+dataId+')')
            // alert('berhasil')
        })
    })
    
    //Once add button is clicked
    function addLocation(nameloc){
    var numb = 1;
    var maxField = 6; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('#wrapper-box'); //Input field wrapper
    // var tvalue = $('#title').val();
    var x = 1; //Initial field counter is 1
        var tvalue = nameloc;
        if(tvalue != ""){
            //Check maximum number of input fieldsconsole.log(add_div)
            if(x < maxField){ 
                var add_div = "<option selected data-id='op-"+numb+"-ch' value='"+tvalue+"'>"+tvalue+"</option>";
                var fieldHTML = "<div class='selection-choice op-"+numb+"-ch mx-1 my-1 max-w-sm w-auto' title='"+tvalue+"'>"+
                                "<span class='rounded border border-gray-300' style='background-color:#e5e7eb;'>"+
                                '<a href="javascript:void(0);" data-id="op-'+numb+'-ch" class="remove_button border-r border-gray-300 cursor-pointer text-md text-gray-400 hover:text-gray-700 px-1 my-1 hover:bg-gray-200 focus:bg-gray-100">x</a>'+
                                '<span class="text-md my-1 mx-1">'+tvalue+"</span></span></div>"; //New input field html 
                console.log(add_div)
                console.log(fieldHTML)
                x++; //Increment field counter  
                $('#multiloc').append(add_div);
                $(wrapper).append(fieldHTML); //Add field html
                numb++;
                $('#inloc').val("");
                var multval = $('#multiloc').val();
                window.livewire.emit('multiLoc',multval)
            }else{
                alert('Anda hanya dapat menambahkan 5 judul');
            }
        }
    };
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('span').parent('div').remove(); //Remove field html
        var selId = $(this).attr('data-id');
        console.log(selId);
        $("option[data-id='" + selId + "']").remove(); 
        x--; //Decrement field counter
        var multval = $('#multiloc').val();
        window.livewire.emit('multiLoc',multval)
    });
</script>
<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
