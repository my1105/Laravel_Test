@extends('layouts.default')

@section('title','画像アップロード')
@section('content')

    @if(session()->has('success'))
      <p>{{session('success')}}</p>
    @endif
    <form action="{{route('photos.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label><input type="file" name="image"></label>
        <button type="submit">アップロード</button>
    </form>
@endsection

















