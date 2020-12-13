<form method="POST" action="/login">
    @csrf
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
    
    @isset($loginfail)
    <div style='color:red'>{{ $loginfail }}</div>
    @endisset
    
    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary">Sign In</button>
    </div>

    <input type="hidden" name="recaptcha" id="recaptcha">
</form>

<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.sitekey') }}"></script>
<script>
         grecaptcha.ready(function() {
             grecaptcha.execute('{{ config('services.recaptcha.sitekey') }}', {action: '/login'}).then(function(token) {
                if (token) {
                  document.getElementById('recaptcha').value = token;
                }
             });
         });
</script>