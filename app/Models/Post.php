<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;


class Post extends Model
{
    use HasFactory;

    protected $fillable =  [
        "body",
    ];

    //create Elequent Relation that post belong to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //check if the user like the post or not
    public function isLiked(User $user)
    {
        return $this->likes->contains('user_id', $user->id); //conatsins is a laravel collection method
    }

    public function ownedBy(User $user)
    {
        return $user->id === $this->user_id;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
