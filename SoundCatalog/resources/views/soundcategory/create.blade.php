@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Add a Sound Category</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <form enctype="multipart/form-data" method="post" action="{{ route('soundcategory.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control" name="title"/>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Sound Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection
