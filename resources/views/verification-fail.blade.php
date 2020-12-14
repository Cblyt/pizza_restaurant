<div>
    Verification failed :(

    Request new verification email here
</div>
<form method="POST" action="/newVerificationEmail">
    @csrf
    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary">Request</button>
    </div>

    <input type="hidden" name="email" id="email" value={{$request->email}}>

</form>

@if($errors->any())
<div style='color:red'>{{$errors->first()}}</div>
@endif