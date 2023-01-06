<?php

namespace App\Http\Livewire\Profile;

use App\Models\Post;
use App\Models\PostSave;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SimpanLoker extends Component
{
    public function render()
    {
        $posts = PostSave::leftJoin('posts', 'post_save.post_id','posts.id')
        ->leftJoin('images', 'post_save.post_id', '=', 'images.post_id')
        ->leftJoin('users', 'post_save.user_id', '=', 'users.id')
        ->orderBy('posts.id', 'desc')->paginate();
        // dd($posts);
        return view('livewire.profile.simpan-loker',['posts'=>$posts]);
    }
    public function delSaveJob($id){
        DB::table('post_save')->where('post_id', $id)->delete();
    }
}
