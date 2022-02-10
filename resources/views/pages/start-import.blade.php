@extends('main')
@section('content')
    <h2>Įmonių duomenų importas</h2>
    @include('_partials/errors')
    <form action="/dataFile" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Pasirinkite duomenų faila (.csv)</label>
            <input type="file" name="data" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Saugoti</button>
    </form>
@endsection
