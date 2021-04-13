<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use PDF;
class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$mahasiswa=Mahasiswa::all();
        // Mengambil semua isi tabel
        //$posts=Mahasiswa::orderBy('nim','asc')->paginate(5);
        //return view('mahasiswas.index',compact('mahasiswa','posts'))->with('i',(request()->input('page',1)-1)*5);
        //return view('mahasiswas.index',compact('mahasiswa','posts'))->with('i',(request()->input('page',1)-1)*5);

        //yang semula mahasiswa::all, diubah menjadi with() yang menyatakan relasi
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBY('nim', 'asc')->paginate(3);
        return view('mahasiswas.index', ['mahasiswa' => $mahasiswa, 'paginate'=>$paginate]);
    }

    /*
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('mahasiswas.create');
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswas.create',['kelas' => $kelas]);
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
        'kelas_id'=>'required',
        'jurusan'=>'required',
        'no_handphone'=>'required',
        'email'=>'required',
        'tgl_lahir'=>'required'
        ]);
        //fungsieloquentuntukmenambahdata
        $image = $request->file('foto');
         if($image)
         {
            $image_name = $request->file('foto')->store('images','public');
         }
        Mahasiswa::create([

        'nim'=>$request->nim
        ,'nama'=>$request->nama
        ,'kelas_id'=>$request->kelas_id
        ,'jurusan'=>$request->jurusan
        ,'no_handphone'=>$request->no_handphone
        ,'email'=>$request->email
        ,'tanggal_lahir'=>$request->tanggal_lahir
        ,'foto'=>$image_name

        ]);
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
        $kelas = Kelas::all();
        return view('mahasiswas.edit',compact('mahasiswa', 'kelas'));
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
        'kelas_id'=>'required',
        'jurusan'=>'required',
        'no_handphone'=>'required',
        'email'=>'required',
        'tgl_lahir'=>'required'
        ]);
        $mhs = Mahasiswa::find($nim);
        $mhs->nim = $request->nim;
        $mhs->nama = $request->nama;
        $mhs->kelas_id = $request->kelas_id;
        $mhs->jurusan = $request->jurusan;
        $mhs->no_handphone = $request->no_handphone;
        $mhs->email = $request->email;
        $mhs->tgl_lahir = $request->tgl_lahir;
         if($mhs->foto && file_exists(storage_path('app/public/'.$mhs->foto)))
        {
            Storage::delete('public/'.$mhs->foto);
        }
        $image_name = $request->file('foto')->store('images','public');
        $mhs->foto = $image_name;
        $mhs->save();
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
        return redirect()->route('mahasiswas.index')->with('success','Mahasiswa Berhasil  Dihapus');
    }

    public function cari (Request $request)
    {

        $cari = $request -> get ('cari');
        $post = DB::table('mahasiswas')->where('nama','like','%'.$cari.'%')->paginate(5);
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
    public function nilai($nim)
    {
        $mhs = Mahasiswa::find($nim);
        //$jajal = $mhs->matakuliah;
        //$kelas = $mhs->kelas->nama_kelas;
         return view('mahasiswas.nilai',compact('mhs'));
    }
    public function cetak_pdf($id)
    {
        $mhs = Mahasiswa::find($id);
        $pdf = PDF::loadview('mahasiswas.cetak_pdf',compact('mhs'));
        return $pdf->stream();
    }



}