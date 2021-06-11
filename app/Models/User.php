<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function sentMessages($userToChatId) {
        return $this->hasMany(Message::class, "sender_id")->where("receiver_id", $userToChatId)->get();
    }

    public function receivedMessages($userToChatId) {
        return $this->hasMany(Message::class, "receiver_id")->where("sender_id", $userToChatId)->get();
    }

    public function messages($userToChatId) {
        return Message::whereIn("sender_id", [Auth::id(), $userToChatId])->whereIn("receiver_id", [Auth::id(), $userToChatId])->oldest()->get();
    }

//    public function get($column) {
//        return User::all();
//    }

//    public function

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
