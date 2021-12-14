<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('movies.index') }}">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"
            ><span class="navbar-toggler-icon"></span>
        </button>
        
            <ul class="collapse navbar-collapse nav nav-pills mb-2 mb-lg-0 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link {{ setActive('movies.*') }}"
                        href="{{ route('movies.index') }}"
                    >@lang('Movies')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ setActive('contact') }}"
                        href="{{ route('contact') }}"
                    >@lang('Contact')</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link"
                            href="#"
                            style="color:crimson;"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                        >Cerrar sesión</a>
                    </li>
                    <li class="nav-item">
                        <p href="#" class="nav-link" style="color:black; margin-bottom:0;">¡Hola {{auth()->user()->name}}!</p>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="ml-2 btn btn-outline-success{{ setActive('login') }}" 
                           href="{{ route('login') }}"
                        >Login</a>
                    </li>
                @endauth

            </ul>
            
    </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

