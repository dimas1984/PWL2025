<?php

namespace App\Http\Controllers;

use App\Models\ContohNama;
use App\Models\LevelModel;
use App\Models\StokModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //
    public function index (){

        $activeMenu = 'user';
        $breadcrumb = (object) [
            'title' => 'Data User',
            'list' => ['Home', 'User']
        ];

        $user = UserModel::all();
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.index', [
            'data' => $user,
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'level' => $level
        ]);
    }

public function list(Request $request)
{
    $user = StokModel::select('user_id', 'username', 'nama', 'level_id')->with('level');

    $level_id = $request->input('filter_level');
    if(!empty($level_id)){
        $user->where('level_id', $level_id);
    }

    return DataTables::of($user)
        ->addIndexColumn()
        ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
            /*$btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.
                url('/user/'.$user->user_id).'">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';*/
            $btn = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi']) // ada teks html
        ->make(true);
}

    public function create()
    {
        $activeMenu = 'user';
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Create']
        ];

        $level = LevelModel::select('level_id', 'level_nama')->get();

        return  view('user.create')
            ->with('level', $level)
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb);
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_id' => [
                'required',
                'integer',
                'exists:m_level,level_id'
            ],
            'username' => [
                'required',
                'max:20',
                'unique:m_user,username'
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

        UserModel::create($request->all());

        return redirect('/user')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $activeMenu = 'user';
        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $user  = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return  view('user.edit')
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb)
            ->with('user', $user)
            ->with('level', $level);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'level_id' => [
                'required',
                'integer',
                'exists:m_level,level_id'
            ],
            'username' => [
                'required',
                'max:20',
                //Rule::unique('m_user')->ignore($id, 'user_id')
                'unique:m_user,username,'.$id.',user_id'
            ],
            'nama' => [
                'required',
                'max:100',
                'min:3'
            ]
        ]);

        UserModel::find($id)->update($request->all());

        return redirect('/user')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $cek = UserModel::find($id);
        if($cek){
            $cek->delete();
            return redirect('/user')->with('success', 'Data berhasil dihapus');

        }else{
            return redirect('/user')->with('error', 'Data tidak ditemukan');
        }
    }

    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.create_ajax', [
            'level' => $level
        ]);
    }

    public function store_ajax(Request $request)
    {

        if($request->ajax() || $request->wantsJson()){
            $rules = [
                'level_id' => ['required', 'integer', 'exists:m_level,level_id'],
                'username' => ['required', 'min:4', 'max:20', 'unique:m_user,username'],
                'nama' => ['required', 'min:3', 'max:100'],
                'password' => ['required', 'min:6']
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            UserModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax($id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.edit_ajax', [
            'user' => $user,
            'level' => $level
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => ['required', 'integer', 'exists:m_level,level_id'],
                'username' => ['required', 'min:4', 'max:20', 'unique:m_user,username,'.$id.',user_id'],
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

            $check = UserModel::find($id);
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
        $user = UserModel::find($id);
        return view('user.confirm_ajax', [
            'user' => $user
        ]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if($request->ajax() || $request->wantsJson()){
            $user = UserModel::find($id);
            if($user){ // jika sudah ditemuikan
                $user->delete(); // user di hapus
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

