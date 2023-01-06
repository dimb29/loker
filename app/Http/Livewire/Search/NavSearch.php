<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use App\Models\User;
use App\Models\Employer;
use App\Models\Post as Loker;
use App\Models\OnClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NavSearch extends Component
{
    public $select_type=1,$search_bar,$lokers,$users,$employers,$array_select,$usid,$emid;

    public function mount(){
        $this->selectType(1);
    }

    public function render()
    {   if(Auth::user()):
            $this->usid = Auth::user()->id;
        endif;
        if(Auth::guard('employer')->user()):
            $this->emid = Auth::guard('employer')->user();
        endif;
        if($this->search_bar):
            $search_loker = Loker::orderBy('created_at', 'DESC');
            $search_user = User::where('id', '!=', $this->usid);
            $search_employer = Employer::where('id', '!=', $this->emid);
            $search_class = OnClass::with('materi')->orderBy('created_at', 'DESC');

            $searchbars = explode(' ', $this->search_bar);
            foreach($searchbars as $searchbar){
                $search_loker->where(function($q) use ($searchbar){
                    $q->where('title', 'like', '%'.$searchbar.'%');
                });
                $search_user->where(function($q) use ($searchbar){
                    $q->where('first_name', 'like', '%'.$searchbar.'%')
                    ->orWhere('last_name', 'like', '%'.$searchbar.'%');
                });
                $search_employer->where(function($q) use ($searchbar){
                    $q->where('name','like', '%'.$searchbar.'%');
                });
                $search_class->where(function($q) use ($searchbar){
                    $q->where('title', 'like', '%'.$searchbar.'%')
                    ->orWhere('content', 'like', '%'.$searchbar.'%');
                });
            }
            $search_loker = $search_loker->take(5)->get();
            $search_user = $search_user->take(5)->get();
            $search_employer = $search_employer->take(5)->get();
            $search_class = $search_class->take(5)->get();
            // dd([$search_loker, $search_user, $search_employer]);
        else:
            $search_loker = null;
            $search_user = null;
            $search_employer = null;
            $search_class = null;
        endif;
        return view('livewire.search.nav-search', [
            'search_loker' => $search_loker,
            'search_user' => $search_user,
            'search_employer' => $search_employer,
            'search_class' => $search_class,
        ]);
    }

    public function closeModal(){
        //
    }

    public function selectType($id){
        $this->select_type = $id;
        if($this->select_type == 1):
            $this->array_select = [
                ['id' => 1, 'name' => 'lowongan', 'type' => 1],
                ['id' => 2, 'name' => 'orang', 'type' => 0],
                ['id' => 3, 'name' => 'perusahaan', 'type' => 0],
                ['id' => 4, 'name' => 'kelas', 'type' => 0],
            ];
        elseif($this->select_type == 2):
            $this->array_select = [
                ['id' => 1, 'name' => 'lowongan', 'type' => 0],
                ['id' => 2, 'name' => 'orang', 'type' => 1],
                ['id' => 3, 'name' => 'perusahaan', 'type' => 0],
                ['id' => 4, 'name' => 'kelas', 'type' => 0],
            ];
        elseif($this->select_type == 3):
            $this->array_select = [
                ['id' => 1, 'name' => 'lowongan', 'type' => 0],
                ['id' => 2, 'name' => 'orang', 'type' => 0],
                ['id' => 3, 'name' => 'perusahaan', 'type' => 1],
                ['id' => 4, 'name' => 'kelas', 'type' => 0],
            ];
        elseif($this->select_type == 4):
            $this->array_select = [
                ['id' => 1, 'name' => 'lowongan', 'type' => 0],
                ['id' => 2, 'name' => 'orang', 'type' => 0],
                ['id' => 3, 'name' => 'perusahaan', 'type' => 0],
                ['id' => 4, 'name' => 'kelas', 'type' => 1],
            ];
        endif;
    }
}
