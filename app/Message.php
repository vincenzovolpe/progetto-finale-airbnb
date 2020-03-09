<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'msg_email', 'text_msg',
    ];

    // Funzione che collega 1 flat a molti message
    public function flat() {
        return $this->belongsTo("App\Flat");
    };

}
