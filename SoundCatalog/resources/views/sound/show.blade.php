@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Show a sound</h1>

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

            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Filename</th>
                    {{--  <th>Status</th>--}}
                    <th>AuthorId</th>
                    <th>CreatedAt</th>
                    <th>UpdatedAt</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>{{ $sound->id }}</td>
                    <td>{{ $sound->title }}</td>
                    <td>{{ $sound->filename }}</td>
{{--                    <td>{{  $sound->status }}</td>--}}
                    <td>{{ $userName }} ({{ $sound->author_id }})</td>
                    <td>{{ $sound->created_at }}</td>
                    <td>{{ $sound->updated_at }}</td>
                </tr>
                </tbody>
            </table>

{{--            Плеер здесь --}}
{{--            {{ $fileContent }}--}}

            <audio controls="controls">
                <source src="{{ $fileLink }}" type="audio/mpeg" />
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
@endsection
