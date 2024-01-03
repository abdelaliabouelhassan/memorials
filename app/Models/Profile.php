<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function qrcode(){
        return $this->belongsTo(QrCode::class);
    }

    public function media(){
        return $this->hasMany(Media::class);
    }
}
