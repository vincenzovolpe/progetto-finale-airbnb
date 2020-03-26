<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/assets/images/boolbnb-logo-text.png" width="160" height="49" alt="bool-bnb-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                {{-- Selettore della lingua --}}
                <ul class="nav">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="nav-item ">
                            <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['menu_laber'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('registration.About_us') }}</a>
                </li>
                <!-- Authentication Links -->
                @guest

                    <li class="nav-item {{Route::currentRouteName() == 'login' ? 'active' : ""}}">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('registration.Login') }}</a>


                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item {{Route::currentRouteName() == 'register' ? 'active' : ""}}">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('registration.Register') }}</a>
                        </li>
                    @endif
                @endguest
                @auth
                    <li class="nav-item {{Route::currentRouteName() == 'upr.flats.index' ? 'active' : ""}}">
                        <a class="nav-link" href="{{ route('upr.flats.index') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }} <span class="caret"></span></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
