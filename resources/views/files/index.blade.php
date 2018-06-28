@extends('layouts.app')

@section('content')
    <div>
        <a href="{{route('file.create')}}">
            <button style="font-size: 20px" class="btn btn-sm btn-success">
                Create file
            </button>
        </a>
    </div>

    @include('components.tableFile')
@endsection