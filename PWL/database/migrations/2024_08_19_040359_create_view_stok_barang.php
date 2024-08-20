<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $view = 'create or replace view view_stok_barang as
select 	ts.stock_id, ts.barang_id, mb.barang_kode, mb.barang_nama,
		ts.user_id, mu.username, mu.nama,
		ts.stock_tanggal, ts.stock_jumlah
from 	t_stock ts
join 	m_barang mb on mb.barang_id = ts.barang_id
join 	m_user mu on mu.user_id = ts.user_id;';
        DB::unprepared($view);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
