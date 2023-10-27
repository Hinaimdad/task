@extends('dashboard')
@section('content')
    
    <div class="content">
        <div class="table-container" id="user-table">
            <h2>FeedBack Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Vote</th>
                        <th>User Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedback as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->title}}</td>
                        <td>{{ Str::limit($data->description, $limit = 10, $end = '...') }}</td>
                        <td>{{$data->vote_count}}</td>
                        <td>{{$data->user->name}}</td>
                        <td>
                            <form method="POST" action="{{ route('feedback.destroy', $data->id) }}">
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
            {{  $feedback->links() }}
        </div>
       
    </div>
@endsection

