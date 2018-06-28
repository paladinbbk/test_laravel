<table class="table">

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
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">url</th>
        <th scope="col">name file</th>
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
            <td><a style="color: #000" href="{{route('show.file.by.name', substr($file->patch, strpos($file->patch, '/') + 1, strlen($file->patch)))}}">{{substr($file->patch, strpos($file->patch, '/') + 1, strlen($file->patch))}}</a></td>
            <td>{{$file->size}}</td>
            <td>{{$file->cost}}</td>
            <td>{{$file->created_at}}</td>
            <td>
                <a href="{{route('file.show', $file) }}">
                    <div class="btn btn-sm btn-info">
                        <i class="fa fa-eye"></i>
                    </div>
                </a>
                <a href="{{route('file.edit', $file)}}">
                    <div class="btn btn-sm btn-primary">
                        <i class="fa fa-edit"></i>
                    </div>
                </a>
                @if(if_route_pattern('file.*'))
                    {{ Form::open(array('url' => route('file.delete', $file), 'method' => 'DELETE', 'class' => 'delete-form')) }}
                @else
                    {{ Form::open(array('url' => route('collection.delete.file', [$collection,$file]), 'method' => 'DELETE', 'class' => 'delete-form')) }}
                @endif
                    <button class="btn-sm btn-danger fa fa-trash"></button>
                    {{ Form::close() }}
            </td>
        </tr>

    @empty
        <tr>
            <th>empty</th>
        </tr>
    @endforelse
        </thead>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$sum }}</td>
            <td></td>
            <td></td>
        </tr>
        </tfoot>
    </tbody>
</table>