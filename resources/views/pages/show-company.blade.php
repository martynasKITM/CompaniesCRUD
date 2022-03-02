@extends('main')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">{{$company->company}} </h1>
        @if($company->logo)
            <img src="{{asset('/storage/'.$company->logo)}}" alt="">
            @endif
        <form action="/company/{{$company->id}}/comment" method="post">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="Jusu komentaras"></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Komentuoti</button>
            </div>
        </form>
        @if(count($company->comments))
        <div>
            <h3>Komentarai</h3>
            <ul>
            @foreach($company->comments as $comment)
                <li>{{$comment->body}}</li>
            @endforeach
            </ul>
        </div>
            @endif
    </div>
@endsection
