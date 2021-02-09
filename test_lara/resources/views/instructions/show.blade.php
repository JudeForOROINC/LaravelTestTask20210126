@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Show a instruction</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <a href="{{ route('instructions.download', $instruction->id) }}">Download</a>
            <a href="{{ route('instructions.preview', $instruction->id) }}">Preview</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Filename</th>
                        <th>Status</th>
                        <th>AuthorId</th>
                        <th>CreatedAt</th>
                        <th>UpdatedAt</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{$instruction->id}}</td>
                        <td>{{$instruction->name}}</td>
                        <td>{{$instruction->description}}</td>
                        <td>{{$instruction->filename}}</td>
                        <td>{{$instruction->status}}</td>
                        <td>{{$instruction->authorId}}</td>
                        <td>{{$instruction->created_at}}</td>
                        <td>{{$instruction->updated_at}}</td>
                    </tr>
                </tbody>
            </table>

            <pre>
                {{$fileContent}}
            </pre>
        </div>
    </div>
@endsection
