@if(isset($kiemtralogin))
<div id="giohanghover">
                  <a class="nav-link" href="{{ Route('Cart.index') }}"><img src="images/cart-icon.png" style="width:35px;height:40px;position:absolute;top:0px;">
                 
                  </a>
                  
                  <div id="hoverhere">
                    
                    <div id="khungcarrt">

                  
                    
                    
                    </div>
                  <div  style="position: relative;padding-left:15px;padding-right:15px;margin-top:10px;
  display: flex;justify-content: space-between;">
                   <p> Tổng cộng:</p> <p style="color:Red"></p>
                  </div>
                  <div id="buttoncarrt">
                    <a href="{{ route('Cart.index') }}" id="btnone" type="button">GIỎ HÀNG</a>
                    <a href="{{ route('thanhtoan') }}" id="btntwo" type="button">THANH TOÁN</a>
                  </div>
                 
                  </div>

                </div>

@else
<div id="giohanghover">
                  <a class="nav-link" href="{{ Route('Cart.index') }}"><img src="images/cart-icon.png" style="width:35px;height:40px;position:absolute;top:0px;">
                   <p style="position:absolute;color:black;display:flex;justify-content: center;width:35px;align-items:flex-end;height:30px;  font-weight: bold;">
                  @php 
                  $totalcart=0;
                  @endphp
                   
                   @if($hover->count() > 0)
                   @foreach($hover as $hv)
                 
                   @php   $totalcart=$totalcart + intval($hv->soluong);  @endphp 
              
                    @endforeach
                    <span>@php echo $totalcart @endphp</span>
                    @else
                    0
                   @endif
               
                  </p>
                  </a>
                  
                  <div id="hoverhere">
                    
                    <div id="khungcarrt">

                        @php
                        $total='0';
                        @endphp

                        @foreach($hover as $hv)
                      <div id="spcart">
                   
                           <div style="width: 25%; box-sizing: border-box;"><img src="images/{{ $hv->hinhanh}}" style="width:80px;height:80px"></div>
                           <div style="width: 65%; box-sizing: border-box;display:flex;flex-direction: column;justify-content: space-between;">
                              <div ><span>Mã: {{ $hv->id_sp}} </span>- <a href="#">{{ $hv->tensanpham}}</a></div>
                              <div style="display:flex;justify-content: space-between;"><p>{{ $hv->gia}}</p><p>{{ $hv->soluong}}</p><a href="{{route('tanggiam',['xoa'=>$hv->id])}}">xóa</a> </div>
                           </div>
                      </div>
                      @php
                      $sluong=intval($hv->soluong)*intval(str_replace(".","",$hv->gia));
                      $total=$total+ $sluong;
                      @endphp
                      @endforeach
                    </div>
                  <div  style="position: relative;padding-left:15px;padding-right:15px;margin-top:10px;
  display: flex;justify-content: space-between;">
                   <p> Tổng cộng:</p> <p style="color:Red">@php echo number_format($total,0, "," , "."), " ₫";  @endphp</p>
                  </div>
                  <div id="buttoncarrt">
                    <a href="{{ route('Cart.index') }}" id="btnone" type="button">GIỎ HÀNG</a>
                    <a href="{{ route('thanhtoan') }}" id="btntwo" type="button">THANH TOÁN</a>
                  </div>
                 
                  </div>

                </div>

                @endif