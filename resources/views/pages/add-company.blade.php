@extends('main')
@section('content')
    <h2>Pridėti naują įmonę</h2>
    @include('_partials/errors')
    <form action="/store" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" name="company" class="form-control" placeholder="Įmonės pavadinimas">
        </div>
        <div class="form-group">
            <input type="text" name="code" class="form-control" placeholder="Įmonės kodas">
        </div>
        <div class="form-group">
            <input type="text" name="vat" class="form-control" placeholder="PVM kodas">
        </div>
        <div class="form-group">
            <input type="text" name="address" class="form-control" placeholder="Adresas">
        </div>
        <div class="form-group">
            <input type="text" name="director" class="form-control" placeholder="Vadovas">
        </div>
        <div class="form-group">
            <textarea name="description"  id="" cols="30" rows="10" placeholder="Įmonės aprašymas" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Logotipas</label>
            <input type="file" name="logo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Saugoti</button>
    </form>
@endsection
