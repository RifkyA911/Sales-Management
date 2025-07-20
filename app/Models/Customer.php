<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'T_Customer';
    protected $primaryKey = 'Kode_Customer';
    public $incrementing = false; // Karena Kode_Customer bukan auto-increment
    protected $keyType = 'string'; // Karena Kode_Customer adalah char

    protected $fillable = ['Kode_Customer', 'Nama_Customer'];

    public $timestamps = false;

    public function juals()
    {
        return $this->hasMany(Jual::class, 'Kode_Customer', 'Kode_Customer');
    }
}
