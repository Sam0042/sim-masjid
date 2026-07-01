@extends('admin.layouts.app')
@section('konten')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <h1 align="center">Input Imam</h1>
    @foreach ($data as $d)
        <form method="POST" action="{{ route('imam.update', $d->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="text1" class="col-4 col-form-label">Nama</label>
                <div class="col-8">
                    <input id="text1" name="nama" type="text" class="form-control" value="{{ $d->nama }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    @endforeach
@endsection
