@extends('dashboard')
@section('content')
    
    <div class="content">
        <div class="table-container" id="user-table">
            <h2>FeedBack Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>
                            <form action="{{ route('user.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Add more user rows here -->
                </tbody>
            </table>
        {{ $user->links() }}
        </div>
        
       
    </div>
@endsection

