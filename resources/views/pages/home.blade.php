@extends('main')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Visos įmonės </h1>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Įmonės pavadinimas</th>
            <th>Kodas</th>
            <th>PVM kodas</th>
            <th>Platesnė informacija</th>
            <th>Veiksmai</th>
        </tr>
        @foreach($companies as $company)
            <tr>
                <th>{{$company->company}}</th>
                <th>{{$company->code}}</th>
                <th>{{$company->vat}}</th>
                <th><a href="/company/{{$company->id}}">Plačiau...</a></th>
                <th>
                    <ul>
                        <li><a href="/delete/company/{{$company->id}}">Šalinti</a></li>
                        <li><a href="/update/company/{{$company->id}}">Keisti</a></li>
                    </ul>
                </th>
            </tr>
        @endforeach
    </table>
    {{$companies->links()}}
</div>
@endsection
