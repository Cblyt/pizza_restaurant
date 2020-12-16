<div>
    <div>Welcome!</div>                                 
    <div>
        <button type="button"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </button>
        <form id="logout-form" action="/logout" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <div>
        <button type="button" onclick="window.location='{{ route('change_password.show') }}'" 
        class="btn btn-primary">Change Password</button>
    </div>
</div>