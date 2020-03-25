<?php

namespace App\Policies;

use App\User;
use App\Folder;//追加

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * フォルダの閲覧権限
     * @param User $user
     * @param Folder $folder
     * @return bool
     */
    public function view(User $user, Folder $folder)
    {
        //ユーザーとフォルダが紐づいているときのみ許可
        return $user->id === $folder->user_id;
    }
}
