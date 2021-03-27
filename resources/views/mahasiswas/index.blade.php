@extends('mahasiswas.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2" style="text-align: center">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-left my-2">
                {{ $posts->links() }}
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
            </div>
            <form method="get" action="/search" id="myForm">
                <div class="float-right my-2" style="margin-right:20px;">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                <div class="float-right my-2">
                    <input type="cari" name="cari" class="form-control" id="cari" aria-describedby="cari" >
                </div>
            </form>
            <div class="float-right my-3" style="margin-right:20px;><label for="cari">Cari</label></div>
        </div>
    </div>
 @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
 @endif
 <table class="table table-bordered">
    <tr>
        <th>Nim</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>No_Handphone</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($posts as $Mahasiswa)
    <tr>
        <td>{{ $Mahasiswa->nim }}</td>
        <td>{{ $Mahasiswa->nama }}</td>
        <td>{{ $Mahasiswa->kelas }}</td>
        <td>{{ $Mahasiswa->jurusan }}</td>
        <td>{{ $Mahasiswa->no_handphone }}</td>
        <td>
            <form action="{{ route('mahasiswa.destroy',$Mahasiswa->nim) }}" method="POST">
                <a class="btn btn-info" href="{{ route('mahasiswa.show',$Mahasiswa->nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$Mahasiswa->nim) }}">Edit</a>
        @csrf
        @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
 @endforeach
 <div>
</div>
 </table>
@endsection
