<table class="table table-bordered table-striped dataTable">

<thead>
                <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Date of birth</th>
                        <th>Added</th>
                        <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @if(count($lists)>0)
                @foreach($lists as $list)
                <tr>
                    <td>{{$list->firstname}}</td>
                    <td>{{$list->lastname}}</td>

                    <td>@if($list->birth_date!=null)
                            {{$list->birth_date->format('d.m.Y.')}}
                        @else
                                {{$list->birth_date}}
                        @endif
                    </td>
                    <td>{{$list->created_at->format('d.m.Y. H:i:s')}}</td>
                    <td><a href="{{url('/blacklist/user/'.$list->id)}}" type="button" class="btn btn-info btn-xs">Edit</a>
                        <a href="{{url('/blacklist/'.$list->id)}}" type="button" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
                @endforeach
                @else
                <td>No data found.</td>

                @endif

                </tbody>
        </table>
{{$lists->links()}}
