<?php

namespace App\Http\Livewire\OnClass;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\OnClass;

class Classes extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $classes, $searchclass, $level;

    public function mount($data){
        $splitdata = explode('=', $data);
        $this->searchclass = $splitdata[1];
    }
    public function render()
    {
        if(Auth::user()):
            $usid = $this->usid = Auth::user()->id;
        elseif(Auth::guard('employer')->user()):
            $usid = $this->usid = Auth::guard('employer')->user()->id;
        endif;
        $class = OnClass::with('materi')->orderBy('created_at', 'DESC');
        if($this->searchclass){
            $searchdata = explode(' ', $this->searchclass);
            foreach($searchdata as $searchdt){
                $class->where(function($q) use ($searchdt){
                    $q->where('title', 'like', '%'.$searchdt.'%')
                    ->orWhere('content', 'like', '%'.$searchdt.'%');
                });
            }
        }
        if($this->level){
            $class->where('level', $this->level);
        }
        $class = $class->paginate();
        return view('livewire.on-class.classes', [
            'class' => $class
        ]);
    }
}
