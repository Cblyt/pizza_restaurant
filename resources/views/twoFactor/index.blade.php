<div>
    Please enter your two factor code.

    If you didn't receive a code please click resend to a resend a new code.
</div>
<form method="POST" action="/twoFactor/verify">
    @csrf
    <div class="form-group row">
        <label for="two_factor_code" class="col-md-4 col-form-label text-md-right">Two Factor Code:</label>
        <input id="two_factor_code" type="text" name="two_factor_code" autofocus>
    </div>
    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<form method="POST" action="/twoFactor/resend">
    @csrf
    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary">Resend</button>
    </div>

    <input type="hidden" name="email" id="email" value="{{ session('email')}}">
</form>

@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
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