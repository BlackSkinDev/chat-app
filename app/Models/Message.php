<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','message'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get the message time
     *
     * @return Attribute
     */

}
