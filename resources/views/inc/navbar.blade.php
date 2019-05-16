<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="/about">O nás</a>
              </li>
              <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Zakázky
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/orders">Přehled zakázek</a>
                    <a class="dropdown-item" href="/orders/create">Vytvoř zakázku</a>
                  </div>
              </div>
              <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Opravy
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/repairs">Přehled oprav</a>
                    <a class="dropdown-item" href="/repairs/create">Zaeviduj opravu</a>
                  </div>
              </div>
              <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Evidence telefonů
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/models">Přehled telefonů</a>
                    <a class="dropdown-item" href="/models/create">Zaeviduj telefon</a>
                    <a class="dropdown-item" href="/brands">Přehled výrobců</a>
                    @auth
                    @if( Auth::user()->hasRole('admin'))
                        <a class="dropdown-item" href="/brands/create">Zaeviduj výrobce</a>
                    @endif
                    @endauth               
                  </div>
              </div>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Zakazníci
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="/customers">Přehled zákazníků</a>
                  <a class="dropdown-item" href="/customers/create">Vytvoř zákazníka</a>
                </div>
              </div>
              <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Personál
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/staff">Přehled zaměstnaců</a>
                    @auth
                    @if( Auth::user()->hasRole('admin'))                        
                        <a class="dropdown-item" href="/register">Zaeviduj zaměstnance</a>                       
                    @endif
                    @endauth     
                  </div>
              </div>
            
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
              
          </ul>
      </div>
  </div>
</nav>