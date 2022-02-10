@extends('main')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">{{$company->company}} </h1>
        @if($company->logo)
            <img src="{{asset('/storage/'.$company->logo)}}" alt="">
            @endif

    </div>
@endsection
