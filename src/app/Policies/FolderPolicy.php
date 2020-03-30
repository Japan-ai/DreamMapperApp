<?php

namespace App\Policies;

use App\User;
use App\Folder;//追加
use Illuminate\Auth\Access\HandlesAuthorization;//追加

class FolderPolicy
{
   use HandlesAuthorization; 

    //ジャンルの閲覧権限
    /**
     * @param Usewebr $user
     * @param Folder $folder
     * @return bool
     */
    public function view(User $user, Folder $folder)
    {
        //ユーザーとジャンルが紐づいているときのみ許可
        return $user->id === $folder->user_id;
    }
}
