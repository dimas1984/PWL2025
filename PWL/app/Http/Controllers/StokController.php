<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\LevelModel;
use App\Models\StokModel;
use App\Models\StokViewModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    //
    public function index (){

        $activeMenu = 'stok';
        $breadcrumb = (object) [
            'title' => 'Data Stok',
            'list' => ['Home', 'Stok']
        ];

        $stok = StokModel::all();
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $kasir  = UserModel::select('user_id', 'nama')->get();

        return view('stok.index', [
            'data' => $stok,
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'barang' => $barang,
            'kasir' => $kasir
        ]);
    }

public function list(Request $request)
{
    $stok = StokViewModel::select('stock_id','barang_nama','username','stock_tanggal','stock_jumlah');

    $barang_id = $request->input('filter_barang');
    if(!empty($barang_id)){
        $stok->where('barang_id', $barang_id);
    }

    $user_id = $request->input('filter_user');
    if(!empty($user_id)){
        $stok->where('user_id', $user_id);
    }


    return DataTables::of($stok)
        ->addIndexColumn()
        ->addColumn('aksi', function ($stok) { // menambahkan kolom aksi
            /*$btn = '<a href="'.url('/stok/' . $stok->stok_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/stok/' . $stok->stok_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.
                url('/stok/'.$stok->stok_id).'">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';*/
            $btn = '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi']) // ada teks html
        ->make(true);
}

    public function create()
    {
        $activeMenu = 'stok';
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Create']
        ];

        $barang = LevelModel::select('barang_id', 'barang_nama')->get();

        return  view('stok.create')
            ->with('barang', $barang)
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => [
                'required',
                'integer',
                'exists:m_barang,barang_id'
            ],
            'stokname' => [
                'required',
                'max:20',
                'unique:m_stok,stokname'
            ],
            'nama' => [
                'required',
                'max:100'
            ],
            'password' => [
                'required',
                'min:5'
            ]
        ]);

        StokModel::create($request->all());

        return redirect('/stok')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $activeMenu = 'stok';
        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $stok  = StokModel::find($id);
        $barang = LevelModel::select('barang_id', 'barang_nama')->get();

        return  view('stok.edit')
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb)
            ->with('stok', $stok)
            ->with('barang', $barang);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => [
                'required',
                'integer',
                'exists:m_barang,barang_id'
            ],
            'stokname' => [
                'required',
                'max:20',
                //Rule::unique('m_stok')->ignore($id, 'stok_id')
                'unique:m_stok,stokname,'.$id.',stok_id'
            ],
            'nama' => [
                'required',
                'max:100',
                'min:3'
            ]
        ]);

        StokModel::find($id)->update($request->all());

        return redirect('/stok')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $cek = StokModel::find($id);
        if($cek){
            $cek->delete();
            return redirect('/stok')->with('success', 'Data berhasil dihapus');

        }else{
            return redirect('/stok')->with('error', 'Data tidak ditemukan');
        }
    }

    public function create_ajax()
    {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user   = UserModel::select('user_id', 'nama')->get();
        return view('stok.create_ajax', [
            'barang' => $barang,
            'user' => $user
        ]);
    }

    public function store_ajax(Request $request)
    {

        if($request->ajax() || $request->wantsJson()){
            $rules = [
                'barang_id' => ['required', 'integer', 'exists:m_barang,barang_id'],
                'stock_tanggal' => ['required', 'date'],
                'stock_jumlah' => ['required', 'integer', 'min:1', 'max:100'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            StokModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax($id)
    {
        $stok = StokModel::find($id);
        $barang = LevelModel::select('barang_id', 'barang_nama')->get();
        return view('stok.edit_ajax', [
            'stok' => $stok,
            'barang' => $barang
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id' => ['required', 'integer', 'exists:m_barang,barang_id'],
                'stokname' => ['required', 'min:4', 'max:20', 'unique:m_stok,stokname,'.$id.',stok_id'],
                'nama' => ['required', 'max:100'],
                'password' => [
                    'nullable', // boleh tidak diisi
                    'min:6',
                    'max:20'
                ]
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }

            $check = StokModel::find($id);
            if ($check) {
                if(!$request->filled('password') ){ // jika password tidak diisi, maka hapus dari request
                    $request->request->remove('password');
                }else{
                    $request->merge(['password' => Hash::make($request->password)]);
                }

                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax($id)
    {
        $stok = StokModel::find($id);
        return view('stok.confirm_ajax', [
            'stok' => $stok
        ]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if($request->ajax() || $request->wantsJson()){
            $stok = StokModel::find($id);
            if($stok){ // jika sudah ditemuikan
                $stok->delete(); // stok di hapus
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}

