@extends('base')


@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Show a Sound Category</h1>

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
                    <td>{{$soundcategory->id}}</td>
                    <td>{{$soundcategory->title}}</td>
                    <td>{{$soundcategory->created_at}}</td>
                    <td>{{$soundcategory->updated_at}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
