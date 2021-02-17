@extends('base')


@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Show a Sound Complaint</h1>

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
                    <th>CreatedAt</th>
                    <th>UpdatedAt</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>{{$complaint->id}}</td>
                    <td>{{$userName}}</td>
                    <td>{{$complaint->created_at}}</td>
                    <td>{{$complaint->updated_at}}</td>
                </tr>
                </tbody>
            </table>
            <div>{{$complaint->description}}</div>

            <a href=" {{ redirect()->back()->getTargetUrl() }}" class="btn btn-primary">Back to list</a>
        </div>
    </div>
@endsection
