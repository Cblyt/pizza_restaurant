<form method="POST" action="/register">
    @csrf
    <div class="form-group row">
        <label for="fname" class="col-md-4 col-form-label text-md-right">First Name :</label>
        <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" 
            name="fname" autofocus>
    </div>

    <div class="form-group row">
        <label for="lname" class="col-md-4 col-form-label text-md-right">Last Name :</label>
        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" 
        name="lname" autofocus>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">Email Address :</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
        name="email" autofocus>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password :</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
        name="password" autofocus>
    </div>

    <div class="form-group row">
        <label for="confpassword" class="col-md-4 col-form-label text-md-right">Confirm Password :</label>
        <input id="confpassword" type="password" class="form-control @error('confpassword') is-invalid @enderror" 
        name="confpassword" autofocus>
    </div>

    <div class="form-group row">
        <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth :</label>
        <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" 
        name="dob" autofocus>
    </div>

    <div class="form-group row">
        <label for="address_houseno" class="col-md-4 col-form-label text-md-right">House Number</label>
        <input id="address_houseno" type="text" class="form-control @error('address_houseno') is-invalid @enderror" 
        name="address_houseno" autofocus>
    </div>
    <div class="form-group row">
        <label for="address_streetname" class="col-md-4 col-form-label text-md-right">Street Name</label>
        <input id="address_streetname" type="text" class="form-control @error('address_streetname') is-invalid @enderror" 
        name="address_streetname" autofocus>
    </div>
    <div class="form-group row">
        <label for="address_postcode" class="col-md-4 col-form-label text-md-right">Postcode</label>
        <input id="address_postcode" type="text" class="form-control @error('address_postcode') is-invalid @enderror" 
        name="address_postcode" autofocus>
    </div>

    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
    
</form>

@if($errors->any())
<div style='color:red'>{{$errors->first()}}</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif