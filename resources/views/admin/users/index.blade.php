<x-admin-master>

@section('content')

<h1 class="h3 mb-4 text-gray-800">Users</h1>


            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Usertype</th>
                <th scope="col">Join</th>

                </tr>
            </thead>
            <tbody>

            @if(count($users)>0)
                @foreach($users as $user)
                <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->firstname}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->user_type}}</td>
                <td>{{$user->created_at}}</td>
                </tr>
                @endforeach

            @else
                <td>No users found.</td>    
            @endif    

            </tbody>
            </table>

            {{ $users->links() }}



@endsection

</x-admin-master>