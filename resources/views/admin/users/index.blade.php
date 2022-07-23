<x-admin-master>

@section('content')
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


<h1 class="h3 mb-4 text-gray-800">Users</h1>


@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif


            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Usertype</th>
                <th scope="col">Join</th>
                <th scope="col">Send email</th>


                </tr>
            </thead>
            <tbody>

            @if(count($users)>0)
                @foreach($users as $user)
                <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->firstname}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->user_type}} <a href="{{url('/change/usertype/'.$user->id)}}" ><i class="fa fa-pencil" aria-hidden="true"></i></a> </td>
                <td>{{$user->created_at}}</td>
                <td><a href="{{route('sendmail', $user->id)}}" class="btn btn-primary">Email</a></td>
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