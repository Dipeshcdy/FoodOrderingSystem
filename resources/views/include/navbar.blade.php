@php

  $cartitemsno=getCartItemsNo();
@endphp

<nav class="navbar navbar-expand-lg" style="background-color:  #7149C6; ">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{asset('image/Foodlogo3.png')}}" style="background: transparent" alt="Food Logo" height="50" width="50">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justifiy-content-between" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active text-white fs-4" style=" font-weight: bold;" aria-current="page" href="{{route('main')}}"">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fs-4" href="{{route('restaurant')}}" style=" font-weight: bold;">Restaurants</a>
          </li>
          
        </ul>

        <form action="{{route('search')}}" class="d-flex w-50 container" method="GET">
          <input type="search" class="form-control me-2" placeholder="search" name="search" aria-label="search" value="{{$key ?? ''}}">
          <button  class=" btn text-white" type="submit"><i class="fas fa-search"></i></button>
        </form>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
          <li>
            <a href="{{route('cartItem')}}" >
              <i class="fas fa-shopping-cart mt-3 me-5" style="color: #56f014; font-size: 25px;">
                <span id="cart_badge" class="badge bg-danger top-0 position-absolute rounded-pill">
                  {{$cartitemsno}}
                  <span class="visually-hidden">unread messages</span>
                </span>
              </i>
            </a>
          </li>
          
            
          
         
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link fs-4 text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-white fs-4" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle fs-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                      @if(Auth::user()->role->role==="customer")
                      <a href="{{route('client.profile')}}" class="dropdown-item text-black" style="text-decoration:none; color:black;">
                        Profile Setting
                      </a>
                      <a href="{{route('user.detail')}}" class="dropdown-item text-black" style="text-decoration:none; color:black;">
                        User Details
                      </a>
                      @elseif (Auth::user()->role->role==="admin")
                      <a href="{{route('dashboard')}}" class="dropdown-item text-black" style="text-decoration:none; color:black;">
                        Dashboard
                      </a>
                      @elseif (Auth::user()->role->role==="vendor")
                      <a href="{{route('vendor.dashboard')}}" class="dropdown-item text-black" style="text-decoration:none; color:black;">
                        Dashboard
                      </a>
                      @endif
                        <a class="dropdown-item text-black" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>
