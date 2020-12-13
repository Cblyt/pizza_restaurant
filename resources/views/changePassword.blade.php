<form method="POST" action="/changepassword">
    @csrf

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Current Password :</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
        name="password" autofocus>
    </div>

    <div class="form-group row">
        <label for="newpassword" class="col-md-4 col-form-label text-md-right">New Password :</label>
        <input id="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" 
        name="newpassword" autofocus>
    </div>
    
    <div class="form-group row">
        <label for="confnewpassword" class="col-md-4 col-form-label text-md-right">Confirm New Password :</label>
        <input id="confnewpassword" type="password" class="form-control @error('confnewpassword') is-invalid @enderror" 
        name="confnewpassword" autofocus>
    </div>

    @isset($errormsg)
        <div style="color:red">
            {{ $errormsg }}
        </div>
    @endisset

    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
    
</form>