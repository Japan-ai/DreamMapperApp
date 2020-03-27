<?php

namespace App\Providers;

use App\Folder; //追加
use App\Policies\FolderPolicy; //追加
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    //モデルクラスとポリシークラスを紐づけ
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //Folderモデルに対する処理への認可には FolderPolicyポリシーを使用
        Folder::class => FolderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
