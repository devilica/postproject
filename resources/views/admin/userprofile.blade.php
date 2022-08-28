<x-admin-master>

@section('content')

<form method="post" action="{{route('update.profile')}}" enctype="multipart/form-data">
    @csrf

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{asset('uploads/profilepic.jpg')}}"><span class="font-weight-bold">{{Auth::user()->userprofile->firstname}} {{Auth::user()->userprofile->lastname}}</span><span class="text-black-50">{{Auth::user()->email}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Name</label><input type="text"  class="form-control" name="firstname" id="firstname"  value="{{old('firstname', Auth::user()->userprofile->firstname)}}">
                    <small class="text-danger">{{ $errors->first('firstname') }}</small>
                    </div>
                    <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" name="lastname" id="lastname" value="{{old('lastname', Auth::user()->userprofile->lastname)}}">
                    <small class="text-danger">{{ $errors->first('lastname') }}</small>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" name="mobile" id="mobile" value="{{old('mobile', Auth::user()->userprofile->mobile)}}"></div>
                    <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" name="address1" id="address1"  value="{{old('address1', Auth::user()->userprofile->address1)}}"></div>
                    <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" class="form-control"name="address2" id="address2"  value="{{old('address2', Auth::user()->userprofile->address2)}}"></div>
                    <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" name="postcode" id="postcode"  value="{{old('postcode', Auth::user()->userprofile->postcode)}}"></div>
                    <div class="col-md-12"><label class="labels">City</label><input type="text" class="form-control" name="city" id="city"  value="{{old('city', Auth::user()->userprofile->city)}}"></div>
                    <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" name="country" id="country"  value="{{old('country', Auth::user()->userprofile->country)}}"></div>
                    <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" name="education" id="education"  value="{{old('education', Auth::user()->userprofile->education)}}"></div>
                </div>
                <div class="row mt-3">
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text-area" class="form-control" name="details" id="details"  value="{{old('details', Auth::user()->userprofile->details)}}"></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

</form>
<style>
    body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>

@endsection

</x-admin-master>