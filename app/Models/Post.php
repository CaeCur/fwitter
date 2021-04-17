<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id); //Laravel collection. Will check if the 'user_id' is within the likes collection t/f
    }

    // The following method is used to check if a post is owned by a certain user, however we moved this functionality to the PostPolicy
    // public function ownedBy(User $user)
    // {
    //     return $user->id === $this->user_id; //this is a different way of writing what we see above
    // }

    //Eloquent relationships with users and likes
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
