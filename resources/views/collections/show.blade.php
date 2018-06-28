@extends('layouts.app')

@section('content')

    {{ Form::open(array('route' => ['collection.add.file', $collection], 'method' => 'Post')) }}

    {!! Form::select('id', $filesNotInCollection->pluck('url', 'id')->toArray(),null, ['class'=> 'form-control']) !!}
    {!! Form::button('Add to collection', ['class'=> 'btn btn-sm btn-success', 'type' => 'submit']) !!}

    {{ Form::close() }}
    @include('components.tableFile')
@endsection