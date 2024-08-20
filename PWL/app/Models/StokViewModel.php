<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokViewModel extends Model
{
    use HasFactory;

    protected $table = 'view_stok_barang';
    protected $primaryKey = 'stock_id';

    // set kolom mana saja yang boleh diisi
    protected $fillable = [];
}
