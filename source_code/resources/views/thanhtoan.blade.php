
@if($cart->count() >0)
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />  <link rel="icon" href="images/logo.png">

  <title>Hoatuoi.com</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <div class="brand_box">
      <a class="navbar-brand" href="index.html">
        <span>
        Hoatuoi.com
        </span>
      </a>
    </div>
    <!-- end header section -->
  </div>

  <!-- nav section -->

  <section class="nav_section">
    <div class="container">
      <div class="custom_nav2">
        <nav class="navbar navbar-expand custom_nav-container ">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex  flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
              <li class="nav-item active">
                  <a class="nav-link" href="index.html">Trang Chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.html">Giới thiệu </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="fruit.html">Hoa của chúng tôi </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="testimonial.html">Đánh giá</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Liên Hệ </a>
                </li>
               
                @include('menuname');
                <li class="nav-item">
               @include('hovercart');
                </li>

              </ul>
           
            </div>
          </div>
        </nav>
      </div>
    </div>
  </section>

  <!-- end nav section -->


  <!-- client section -->

  <section class="contact_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-2 col-md-10 offset-md-1">
          <div class="heading_container">
            <hr>
            <h4>
        Giỏ Hàng  > <span style="color:green">Thanh Toán</span> > Hoàn Thành
        </h4>
          </div>
        </div>
      </div>
      
      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-lg-4 offset-lg-2 col-md-5 offset-md-1">
       <h6 style="font-weight:bold">Thông tin giao hàng</h6>
        <form action="{{ route('Cart.store') }}" method="post">
        @csrf
              <div class="contact_form-container">
                <div>
                  <div>
                  <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
            
                    <input type="text" placeholder="Tên Của Bạn" name="tenkhachhang" value="{{auth()->user()->name}}" required/>
                  </div>
                  <div>
                    <input type="text" placeholder="Số điện thoại" name="sdt" value="{{auth()->user()->sdt}}" required/>
                  </div>
                  <div>
                    <input type="text" placeholder="Địa chỉ nhận hàng" name="diachi" value="{{auth()->user()->diachi}}" required/>
                  </div>
                  <div>
                    <input type="text" class="message_input" name="loinhan" placeholder="Lời nhắn" value=""/>
                  </div>
                  </div>
                  </div>
               
                  <input type="checkbox" id="check" required>
                  <label for="check">Chấp nhận đồng ý đặt hàng</label>
        
                  <div id="ftthanhtoan">       <div>
                    <button  id="btnft" type="submit"> Đặt hàng  </button>
          
                    </div>
                    <div><button  id="btnft2" name="redirect" type="submit">Thanh Toán VNPay  </button>   </div>
</div>
     <br> 
<div>
  <a href="{{ route('Cart.index') }}"> < Quay về giỏ hàng</a>
</div>

      
         
        </div>
        <div class="col-md-6 px-0">
        <h6 style="font-weight:bold">Thông tin đơn hàng</h6>
              <div class="ttdonhang">
              @php
        $total='0';
        $tongsoluong='0';
        @endphp
                @foreach($cart as $hang)
          
                @foreach($pd as $sanpham)
           
                @if($sanpham->id == $hang->id_sp)
                @if($sanpham->soluong > $hang->soluong)
                @php
                $thanhtien=intval(str_replace("." , "",$hang->gia)) * intval( $hang->soluong ) ;
                $total=$total + $thanhtien;
                $tongsoluong= $tongsoluong + intval($hang->soluong);

                @endphp
                <div>
                <img src="images/{{$hang->hinhanh}}" width="60px">  Mã {{ $hang->id_sp }} - {{ $hang->tensanpham }} - ( {{ $hang->gia }} x {{ $hang->soluong }} = @php  echo number_format($thanhtien,0, "," , "."), " ₫)"; @endphp
              </div>
              <br>  

                @endif
                @endif
                @endforeach
            

                <!--<input type="hidden" name="id_sp_{{$hang->id_sp}}" value="{{ $hang->id_sp }}"> -->

                <input type="hidden" name="tongsoluong" value="@php echo $tongsoluong; @endphp">
                <input type="hidden" name="hinhanh" value="{{ $hang->hinhanh }}">
                <input type="hidden" name="tensanpham" value="{{ $hang->tensanpham }}">
                <input type="hidden" name="gia" value="{{ $hang->gia }}">
                <input type="hidden" name="soluong" value="{{ $hang->soluong }}">
            
              @endforeach
              <BR>
              <div>
                - Phí ship : 45.000₫
              </div>
              <br>
              
              <div>
                - Tổng thanh toán :  <span style="color:green">@php  
                $tong= 45000 + $total;
                $nametong = number_format($tong,0, "," , ".");
                echo number_format($tong,0, "," , "."), " ";
            
                @endphp  </span>₫
              </div>
              <input type="hidden" name="tong" value="@php echo $nametong; @endphp">
             <br>
              </div>
            </div>
             
            </form>
            
            
        </div>
             

      </div>

    </div>
  </section>

  <!-- end client section -->

  <!-- info section -->

  <section class="info_section layout_padding">
    <div class="container">
      <div class="info_logo">
        <h2>
          Hoatuoi.com
        </h2>
      </div>
      <div class="info_contact">
        <div class="row">
          <div class="col-md-4">
            <a href="">
              <img src="images/location.png" alt="">
              <span>
              638/13B Quang Trung, Hồ Chí Minh
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="">
              <img src="images/call.png" alt="">
              <span>
                Call : 0911472518
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="">
              <img src="images/mail.png" alt="">
              <span>
                Hoatuoi@gmail.com
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-lg-9">
          <div class="info_form">
            <form action="">
              <input type="text" placeholder="Enter your email">
              <button>
              đăng ký
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-4 col-lg-3">
          <div class="info_social">
            <div>
              <a href="">
                <img src="images/facebook-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/twitter-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/linkedin.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/instagram.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- end info section -->


  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      &copy; <span id="displayYear"></span> By Hoatuoi.com
    
    </p>
  </section>
  <!-- footer section -->


  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>
@else
<script>
    window.location.href= '{{route('product.all')}}'
  </script>
@endif
