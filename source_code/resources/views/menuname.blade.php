@if (Route::has('login'))
              
              @auth
              <a class="nav-link">          <div id="myname"><img id="human" src="images/human-icon.png">{{ Auth::user()->name }}<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
          @if(auth()->user()->role !== 'admin')  <div id="an">  <a href="{{route('profile.edit')}}">Tài khoản</a><br><a href="{{route('donhanguser')}}">Đơn hàng</a> <br><a href="{{route('logout')}}">Đăng Xuất</a></div>
          @else <div id="an"><a href="{{route('bangdieukhien')}}">Admin</a> <br>  <a href="{{route('profile.edit')}}">Tài khoản</a><br><a href="{{route('donhanguser')}}">Đơn hàng</a> <br><a href="{{route('logout')}}">Đăng Xuất</a></div>
          @endif     
        </div> 
        
            </a>
              @else
             
                  <a href="{{ route('login') }}" class="nav-link"style="color:white;" >Đăng Nhập </a>

                  @if (Route::has('register'))
                  <span>
                      <a class="nav-link"style="color:white"  >|</a>
</span>
                  <span>
                      <a href="{{ route('register') }}"class="nav-link"style="color:white"  >Đăng Ký</a>
</span>
                  @endif
              @endauth

      @endif