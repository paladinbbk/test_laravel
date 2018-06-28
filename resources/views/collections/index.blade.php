@extends('layouts.app')

@section('content')
    @if(session()->get('flash_success'))
        <div class="alert alert-success">
            {{session()->get('flash_success')}}
        </div>
    @endif
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach

    <div>
        <a href="{{route('collection.create')}}">
        <button style="font-size: 20px" class="btn btn-sm btn-success">
            Create collection
        </button>
        </a>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">created_at</th>
            <th scope="col">action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($collections as $collection)
            <tr>
                <th scope="row">{{$collection->id}}</th>
                <td>{{$collection->name}}</td>
                <td>{{$collection->created_at}}</td>
                <td>
                    <a href="{{route('collection.edit', $collection) }}">
                        <div class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                        </div>
                    </a>
                    <a href="{{route('collection.show', $collection) }}">
                        <div class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i>
                        </div>
                    </a>


                    {{ Form::open(array('url' => route('collection.delete', $collection), 'method' => 'DELETE', 'class' => 'delete-form')) }}
                    <button class="btn-sm btn-danger fa fa-trash"></button>
                    {{ Form::close() }}


                </td>
            </tr>
        @empty
            <tr>
                <th>empty</th>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection