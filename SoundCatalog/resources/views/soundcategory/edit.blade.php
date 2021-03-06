@extends('base')


@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit a Sound Category</h1>

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

            <form method="post" action="{{ route('soundcategory.update', $soundcategory->id) }}">
                @method('PATCH')
                @csrf

                <div class="form-group">
                    <label for="first_name">Sound Category Title:</label>
                    <input type="text" class="form-control" name="title" value={{ $soundcategory->title }} />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
