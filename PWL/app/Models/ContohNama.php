<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContohNama extends Model
{
    use HasFactory;

    protected $table = 'm_user'; // default nama tabel mengikuti nama file contoh_namas
    protected $primaryKey = 'user_id';
}
