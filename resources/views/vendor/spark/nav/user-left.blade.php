<!-- Left Side Of Navbar -->
<li @if(Request::is('dashboard')) class="active" @endif><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li @if(Request::is('docs*')) class="active" @endif><a href="{{ route('documentation') }}">Documentation</a></li>