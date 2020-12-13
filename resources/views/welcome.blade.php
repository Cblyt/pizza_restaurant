<div>
    <div>Welcome!</div>                                 
    <div>
        <a class="dropdown-item" href="/logout"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="/logout" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <div>
        <a class="dropdown-item" href="/changepassword" 
        onclick="event.preventDefault(); document.getElementById('change-password-form').submit();">
            Change Password
        </a>
        <form id="change-password-form" action="/changepassword" method="Get" class="d-none">
            @csrf
        </form>
    </div>
</div>