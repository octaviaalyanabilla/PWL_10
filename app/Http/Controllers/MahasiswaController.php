<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$mahasiswa=Mahasiswa::all()->paginate(1);
        // Mengambil semua isi tabel
        $posts=Mahasiswa::orderBy('nim','asc')->paginate(5);
        //return view('mahasiswas.index',compact('mahasiswa','posts'))->with('i',(request()->input('page',1)-1)*5);
        return view('mahasiswas.index',compact('posts'))->with('i',(request()->input('page',1)-1)*5);
    }

    /*
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['nim'=>'required',
        'nama'=>'required',
        'kelas'=>'required',
        'jurusan'=>'required',
        'no_handphone'=>'required',
        'email'=>'required',
        'tgl_lahir'=>'required'
        ]);
        //fungsieloquentuntukmenambahdata
        Mahasiswa::create($request->all());
        //jikadataberhasilditambahkan,akankembalikehalamanutama
        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        $mahasiswa=Mahasiswa::find($nim);
        return view('mahasiswas.detail',compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        $mahasiswa=Mahasiswa::find($nim);
        return view('mahasiswas.edit',compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        $request->validate(['nim'=>'required',
        'nama'=>'required',
        'kelas'=>'required',
        'jurusan'=>'required',
        'no_handphone'=>'required',
        'email'=>'required',
        'tgl_lahir'=>'required'
        ]);
        Mahasiswa::find($nim)->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa Berhasil  Dihapus');
    }

    public function cari (Request $request)
    {

        $cari = $request -> get ('cari');
        $post = DB::table('mahasiswa')->where('nama','like','%'.$cari.'%')->paginate(5);
        return view('mahasiswas.index',['posts' => $post]);

         /*
        // 2 variabel
        $posts = Mahasiswa::when($request->keyword, function ($query) use ($request) {
            $query->where('nama', 'like', "%{$request->keyword}%")
                ->orWhere('nim', 'like', "%{$request->keyword}%");
        })->paginate(5);
        return view('mahasiswas.index',compact('posts'));
        */
    }



}