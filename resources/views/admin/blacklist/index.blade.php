<x-admin-master>


@section('header')


@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">
                       Blacklist
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        


                        <div class="row">
                            <div class="col-md-12">

                            <div class="row">
                                            <div class="col-sm-12">

                                                <form method="POST" action="{{route('file.upload')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group row">

                                                            <div class="col-sm-3">

                                                                <input
                                                                        type="file"
                                                                        class="form-control form-control-user @error('file') is-invalid @enderror"
                                                                        id="uploaded_file"
                                                                        name="uploaded_file"
                                                                        value="{{ old('file') }}">

                                                                @error('file')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <button type="submit" class="btn btn-danger btn-xs" style="margin: 1px">Import</button>
                                                            <a href="{{url('/export/blacklist')}}" type="button" class="btn btn-success btn-xs" style="margin: 1px">Export</a>

                                                        </div>
                                                    </div>
                                                 

                                                </form>
                                            </div>
                                        </div>

                                    <div class="row">

                                        <div class="col-sm-3">


                                            <form method="post" action="{{route('blacklist.store')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="firstname">Firstname</label>
                                                    <input type="text" class="form-control" id="firstname" name="firstname">
                                                    <small class="text-danger">{{ $errors->first('firstname') }}</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastname">Lastname</label>
                                                    <input type="text" class="form-control" id="lastname" name="lastname">
                                                    <small class="text-danger">{{ $errors->first('lastname') }}</small>

                                                </div>

                                                <div class="form-group">
                                                    <label for="birth_date">Date of birth(optional)</label>
                                                    <div class='input-group date'>
                                                
                                                        <input class="date form-control" type="text" name="birth_date" autocomplete="off">

                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                        <small class="text-danger">{{ $errors->first('birth_date') }}</small>

                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>


                                            </form>
                                            <br>
                                        </div>



                                       
                                         @include('admin.blacklist.show_list')
                                      




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




