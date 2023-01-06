<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Regency;
use Carbon\Carbon;

class Slider extends Component
{
    public $locations;



    public function render()
    {
        $regency = Regency::where('name', 'like',$this->locations . '%')->first();

        // $posttrend = Post::leftJoin('images', 'posts.id', '=', 'images.post_id')
        //                 ->leftJoin('users as b','author_id','=','b.id') 
        //                 ->select('posts.id', 'posts.title', 'posts.content', 'posts.views', 'posts.salary_start', 'posts.salary_end', 'posts.salary_check', 'images.url','b.first_name', 'b.last_name', 'posts.created_at','posts.updated_at')
        //                 ->orderBy('posts.views', 'desc')->get();
        $posttrend = Post::with(['author','author_employer','images'])
        ->select('posts.id', 'posts.title', 'posts.content', 'posts.views','posts.author_id','posts.employer_id', 'posts.salary_start', 'posts.salary_end', 'posts.salary_check','posts.created_at','posts.updated_at')
        ->orderBy('posts.created_at', 'desc')->get();
        
        $now = Carbon::now();
        // dd($posttrend);



        return view('livewire.slider', [
            'trend' => $posttrend,
            'thistime' => $now,
        ]);
    }
}
 