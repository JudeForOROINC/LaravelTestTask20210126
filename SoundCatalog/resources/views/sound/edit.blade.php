@extends('base')


@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit a Sound</h1>

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

            <form method="post" action="{{ route('sound.update', $sound->id) }}">
                @method('PATCH')
                @csrf

                <div class="form-group">
                    <label for="title">Sound title:</label>
                    <input type="text" class="form-control" name="title" value={{ $sound->title }} />
                </div>

{{--                <div class="form-group">--}}
{{--                    <label for="email">Status:</label>--}}
{{--                    <input type="number" class="form-control" name="status" value={{ $sound->status }} />--}}
{{--                </div>--}}

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
