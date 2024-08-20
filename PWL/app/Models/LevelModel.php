<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'm_level';
    protected $primaryKey = 'level_id';

    // set kolom mana saja yang boleh diisi
    protected $fillable = [
        'level_kode',
        'level_nama',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}
