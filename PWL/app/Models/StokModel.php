<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokModel extends Model
{
    use HasFactory;

    protected $table = 't_stock';
    protected $primaryKey = 'stock_id'; // id

    protected $fillable = [
        'barang_id',
        'user_id',
        'stock_tanggal',
        'stock_jumlah',
        'created_at',
        'updated_at'
    ];

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    public function kasir()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
