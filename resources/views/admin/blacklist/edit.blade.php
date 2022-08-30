<x-admin-master>


@section('header')
    <section class="content-header">
        <h1>                {{trans('a_pdf.blacklist')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">  {{trans('a_pdf.blacklist')}}
                </a></li>
            <li class="active"> {{trans('a_pdf.blacklist')}}
            </li>
        </ol>
    </section>
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
      
                <br>
                <div class="row">

                    <div class="col-sm-3">


                        <form method="post" action="{{route('blackuser.update', $user->id)}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname">Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="{{old('firstname', $user->firstname)}}">
                                <small class="text-danger">{{ $errors->first('firstname') }}</small>

                            </div>
                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname">Surname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname', $user->lastname)}}">
                                <small class="text-danger">{{ $errors->first('lastname') }}</small>

                            </div>

                            <div class="form-group">
                                <label for="birth_date">Date of birth(optional)</label>
                                <div class='input-group date'>
                                                
                                                <input class="date form-control" type="text" name="birth_date" autocomplete="off" value="{{old('birth_date', $user->birth_date)}}">

                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                <small class="text-danger">{{ $errors->first('birth_date') }}</small>

                                  </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>


                        </form>
                        <br>


                    </div>
                </div>

            </div>
        </div>

    </div>

<script type="text/javascript">
    $('.date').datepicker({  
       format: 'dd-mm-yyyy'
     });  
</script> 


@endsection

        </x-admin-master>
