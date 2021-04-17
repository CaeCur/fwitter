<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    //remember to assign this policy to the posts model in the AuthServiceProvider.php
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
