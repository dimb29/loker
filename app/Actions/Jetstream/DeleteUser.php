<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;
use Illuminate\Support\Facades\DB;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $simpanloker = DB::table('post_save')->where('user_id',$user->id)->delete();
        $pengUser = DB::table('pengalaman_users')->where('user_id',$user->id)->delete();
        $pendUser = DB::table('pendidikan_users')->where('user_id',$user->id)->delete();
        $ketUser = DB::table('keterampilan_users')->where('user_id',$user->id)->delete();
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
