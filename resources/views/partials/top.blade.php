<div class="dropdown text-right">
    <a class="dropdown-toggle profile-img" type="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <img src="{{URL::asset('/assets/images/analytics.svg')}}">
        <span>{{Auth::user()->name}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="#">View Profile</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Logout') }}
        </a>
        </form>

    </div>
</div>
<button class="btn btn-icon outline-dark notification-bell">
    <span class="count">2</span>
    <svg width="30" height="30" viewBox="0 -1 17 25">
        <use xlink:href="#notification" />
    </svg>
</button>
