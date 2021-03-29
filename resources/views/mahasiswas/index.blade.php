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
 <<table class="table table-bordered">

	<tr>
		<th>No</th>
		<th>Nim</th>
		<th>Nama</th>
		<th>Kelas</th>
		<th>Jurusan</th>
		<th>No_Handphone</th>
		<th>Email</th>
		<th>Tanggal Lahir</th>
		<th width="280px">Action</th>
	</tr>
	@foreach($posts as $index => $mahasiswa)
	<tr>
		<td>{{$index + $posts->firstItem()}}</td>
		<td>{{$mahasiswa->nim}}</td>
		<td>{{$mahasiswa->nama}}</td>
		<td>{{$mahasiswa->kelas}}</td>
		<td>{{$mahasiswa->jurusan}}</td>
		<td>{{$mahasiswa->no_handphone}}</td>
		<td>{
            <form action="{{ route('mahasiswa.destroy',['mahasiswa'=>$Mahasiswa->nim]) }}" method="POST">
                <a class="btn btn-info" href="{{ route('mahasiswa.show',['mahasiswa'=>$Mahasiswa->nim]) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',['mahasiswa'=>$Mahasiswa->nim]) }}">Edit</a>
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
