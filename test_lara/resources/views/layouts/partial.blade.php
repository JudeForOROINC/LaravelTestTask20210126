@foreach($instructions as $instruction)
<tr>
    <td>{{$instruction->id}}</td>
    <td>{{$instruction->name}}</td>
    <td>{{$instruction->description}}</td>
    <td>{{$instruction->status}}</td>
    <td>a
        @if( Auth::user() && Auth::user()->id == $instruction->authorId )
        <a href="{{ route('instructions.edit',$instruction->id)}}" class="btn btn-primary">Edit</a>
        @endif
    </td>
    <td>
        <a href="{{ route('instructions.show',$instruction->id)}}" class="btn btn-primary">View</a>
    </td>
    <td>
        @if( Auth::user() && Auth::user()->id == $instruction->authorId )
        <form action="{{ route('instructions.destroy', $instruction->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
        @endif
    </td>
</tr>
@endforeach