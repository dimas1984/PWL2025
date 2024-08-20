<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $activeMenu = 'kategori';
        $breadcrumb = (object) [
            'title' => 'Kategori',
            'list' => ['Home', 'Kategori']
        ];

        return  view('kategori.index')
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb);
    }

    public function list(Request $request)
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                $btn = '<a href="'.url('/kategori/' . $kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/kategori/' . $kategori->kategori_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.
                    url('/kategori/'.$kategori->kategori_id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        $activeMenu = 'kategori';
        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $kategori = KategoriModel::find($id);

        return  view('kategori.show')
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb)
            ->with('kategori', $kategori);
    }

    public function create()
    {
        $activeMenu = 'kategori';
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Create']
        ];

        return  view('kategori.create')
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => [
                'required',
                'max:10',
                'unique:m_kategori,kategori_kode'
            ],
            'kategori_nama' => [
                'required',
                'max:100',
                'min:3'
            ]
        ]);
        
        KategoriModel::create($request->all());

        return redirect('/kategori')->with('success', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        $activeMenu = 'kategori';
        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $kategori = KategoriModel::find($id);

        return  view('kategori.edit')
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb)
            ->with('kategori', $kategori);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_kode' => [
                'required',
                'max:10',
                //'unique:m_kategori,kategori_kode,'.$id.',kategori_id'
                Rule::unique('m_kategori')->ignore($id, 'kategori_id')
            ],
            'kategori_nama' => [
                'required',
                'max:100',
                'min:3'
            ]
        ]);
        
        KategoriModel::find($id)->update($request->all());

        return redirect('/kategori')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $check = KategoriModel::find($id);
        if($check){
            $check->delete();
            return redirect('/kategori')->with('success', 'Data berhasil dihapus');
        }else {
            return redirect('/kategori')->with('error', 'Data tidak ditemukan');
        }
    }
}
