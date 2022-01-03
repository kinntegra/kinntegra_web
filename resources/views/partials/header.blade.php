<div class="header-wrap">
    <header>
        <a class="brand-image" href="#">
            <img src="{{URL::asset('assets/images/logo.svg')}}">
            <span>Kinntegra</span>
        </a>
        <nav>
            <ul>
                <li class="@if(request()->url() == route('dashboard')) {{ 'active' }} @endif">
                    <a href="{{route('dashboard')}}">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#dashboard" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#analytics" />
                        </svg>
                        <span>Analytics</span>
                    </a>
                </li>
                <li class="@if(request()->url() == route('transaction.index')) {{ 'active' }} @endif">
                    <a href="{{ route('transaction.index') }}">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#transactions" />
                        </svg>
                        <span>Transactions</span>
                    </a>
                </li>
                <li class="@if(request()->url() == route('tradelog.index')) {{ 'active' }} @endif">
                    <a href="#">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#logs" />
                        </svg>
                        <span>Trade Logs</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#client" />
                        </svg>
                        <span>Client</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#messenger" />
                        </svg>
                        <span>Messenger</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#calendar" />
                        </svg>
                        <span>Calendar</span>
                    </a>
                </li>
                <li class="@if(request()->url() == route('leads.index')) {{ 'active' }} @endif">
                    <a href="{{ route('leads.index') }}">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#lead" />
                        </svg>
                        <span>Lead Management</span>
                    </a>
                </li>
                <li class="parent @if(request()->url() == route('employee.index')) {{ 'active' }} @endif">
                    <a href="javascript:void(0)">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#admin" />
                        </svg>
                        <span>Admin</span>
                    </a>

                    <ul class="children">
                        @if(Auth::user()->hasRole('superadmin'))
                        <li>
                            <a href="{{ route('associate.index') }}">Accounts</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('employee.index') }}">Employee</a>
                        </li>
                        @endif
                        <li>
                            <a href="#">Universal Reports</a>
                        </li>
                        <li>
                            <a href="#">Data Modification</a>
                        </li>
                    </ul>

                </li>
                <li>
                    <a href="#">
                        <svg width="60" height="60" viewBox="0 0 60 60">
                            <use xlink:href="#query" />
                        </svg>
                        <span>Query Management</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
</div>

