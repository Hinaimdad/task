@extends('dashboard')
@section('content')
    
    <div class="content">
        <div class="table-container" id="user-table">
            <h2>FeedBack Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content</th>
                        <th>User Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comment as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td> {!! $data->content !!}</td>
                        <td>{{$data->user->name}}</td>
                        <td>
                            <form method="POST" action="{{ route('comment.approve', $data->id) }}">
                                @csrf
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('comment.approve', $data->id) }}">
                                @csrf
                                <input type="hidden" name="action" value="disapprove">
                                <button type="submit" class="btn btn-danger">Disapprove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Add more user rows here -->
                </tbody>
            </table>
            {{  $comment->links() }}
        </div>
       
    </div>
@endsection

