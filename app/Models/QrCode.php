<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrCode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->BelongsTo(User::class);
    }

    public function profile(){
        return $this->hasOne(Profile::class,'qrcode_id');
    }
}
