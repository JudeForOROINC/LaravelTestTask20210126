@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a instruction</h1>
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
                <form method="post" action="{{ route('instructions.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description"/>
                    </div>

                    <div class="form-group">
                        <label for="text">Filename:</label>
                        <input type="text" class="form-control" name="filename"/>
                    </div>

                    <button type="submit" class="btn btn-primary">Add instruction</button>
                </form>
            </div>
        </div>
    </div>
@endsection
