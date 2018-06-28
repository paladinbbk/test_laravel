@extends('layouts.app')

@section('content')
    <div class="bd-example" style="width: 50%; margin: auto">
        @if(session()->get('flash_success'))
            <div class="alert alert-success">
                {{session()->get('flash_success')}}
            </div>
        @endif
        {!! form($form) !!}
    </div>
@endsection