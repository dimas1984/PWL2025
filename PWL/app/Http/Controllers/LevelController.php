<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    //
    public function index()
    {
        $activeMenu = 'level';
        $breadcrumb = (object) [
            'title' => 'Level User',
            'list' => ['Home', 'Level']
        ];

        return view('level.index')
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb);
    }


    public function list(Request $request)
    {
        $level = LevelModel::select('level_id','level_kode','level_nama');
        return DataTables::of($level)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.
                    url('/level/'.$level->level_id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // ada teks html
            ->make(true);
    }


    public  function create()
    {
        $activeMenu = 'level';
        $breadcrumb = (object) [
            'title' => 'Level User',
            'list' => ['Home', 'Level', 'Create']
        ];

        return view('level.create')
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb);
    }

    public function store(Request $request)
    {
        // proses validasi
        $request->validate([
            'level_kode' => [
                'required',       // wajib diisi
                'unique:m_level', // nilai ini harus unik di tabel m_level kolom level_kode
                'max:10',         // maksimal 10 karakter
                'alpha'           // hanya boleh huruf
            ],
            'level_nama' => [
                'required',       // wajib diisi
                'max:100'         // maksimal 100 karakter
            ]
        ]);

        LevelModel::create($request->all());
        return redirect('level')
            ->with('success', 'Level created successfully.');
    }


    public function edit($id)
    {
        $activeMenu = 'level';
        $breadcrumb = (object) [
            'title' => 'Level User',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $level = LevelModel::find($id);
        return view('level.edit')
            ->with('level', $level)
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb);
    }
    
    public function update(Request $request, $id)
    {
        // proses validasi
        $request->validate([
            'level_kode' => [
                'required',       // wajib diisi
                // nilai ini harus unik di tabel m_level kolom level_kode kecuali id = $id
                'unique:m_level,level_kode,'.$id.',level_id', 
                'max:10',         // maksimal 10 karakter
                'alpha'           // hanya boleh huruf
            ],
            'level_nama' => [
                'required',       // wajib diisi
                'max:100'         // maksimal 100 karakter
            ]
        ]);

        LevelModel::find($id)->update($request->all());
        return redirect('level')
            ->with('success', 'Level updated successfully');
    }

    public function destroy($id)
    {
        $level = LevelModel::find($id);
        if($level){ // jika data ditemukan maka hapus
            $level->delete();
            
            return redirect('level')
                ->with('success', 'Level deleted successfully');
        }else{
            return redirect('level')
                ->with('error', 'Level not found');
        }
    }
    


    public function LevelInsert()
    {
        DB::insert('insert into m_level (level_kode, level_nama, created_at) values (?, ?, ?)', ['PL', 'Pelanggan', now()]);
        echo "data berhasil ditambah";
    }


    public function LevelUpdate(){
        $row=DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer','cus']);
        return "update data berhasil, jumlah data yang terupdate ".$row." baris";
    }

    public function LevelDelete(){
        $row = DB::delete('delete from m_level where level_kode = ?',['cus']);
        return "delete data berhasil, jumlah data yang terhapus ".$row." baris";
    }

    public function LevelTampilData(){
        $data=DB::select('select * from m_level');
        return view ('level',['data'=>$data]);
    }
}
