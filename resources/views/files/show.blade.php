@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">url</th>
            <th scope="col">size</th>
            <th scope="col">cost</th>
            <th scope="col">created_at</th>
            <th scope="col">action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($files as $file)
            <tr>
                <th scope="row">{{$file->id}}</th>
                <td>{{$file->url}}</td>
                <td>{{$file->size}}</td>
                <td>{{$file->cost}}</td>
                <td>{{$file->created_at}}</td>
                <td>
                    <div class="btn btn-sm btn-info">
                        <a href="{{route('file.show', $file->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </div>
                    <div class="btn btn-sm btn-primary">
                        <a href="#">
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>
                    <div class="btn btn-sm btn-danger">
                        <a href="#">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
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