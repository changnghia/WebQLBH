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
  <meta name="author" content="" />
  <link rel="icon" href="images/logo.png">
  <title>Hoatuoi.com</title>
  <link rel="stylesheet" href="assets/css/main.css" />
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

<!-- Wrapper -->
<div id="wrapper">

<!-- Main -->
  <div id="main">
    <div class="inner">

      <!-- Header -->
        <header id="header">
          <a href="index.html" class="logo"><strong>Hoatuoi.com</strong></a>
          <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
          
          </ul>
        </header>

      <!-- Section -->
        <section>
          <header class="major">
            @if(isset($nhanbiet))
            <h2><a id="quaylai" onclick="history.back()">&#x21A9</a>    &nbsp {{$nhanbiet}}</h2>
            @else(isset($timkiem))
            <h2><a id="quaylai" onclick="history.back()">&#x21A9</a>    &nbspTìm Kiếm "<span style="color:red;font-size:26px">{{$timkiem}}</span>"</h2>
            @endif
          </header><div>
          {{ $sp ->links() }}</div>
          <div class="posts">
  

  @if(count($sp)>0)
          @foreach($sp as $sanpham)
            <article >
              <div>
              <a href="#" class="image"><img src="images/{{ $sanpham -> hinhanh }}" alt="" id="imglist"/></a>
              <a href="{{route('chitietsp',['#SP'=>$sanpham->id])}}"><h4>{{ $sanpham -> tensanpham }}</h4></a>
            
              <p style="color:#f56a6a">{{ $sanpham -> gia }} ₫</p>
              <ul class="actions">
                <li><a href="{{ route('Cart.create',['add'=>$sanpham->id]) }}"  class="button">Thêm Vào Giỏ Hàng</a></li>
              </ul>
</div>
            </article>
         
          @endforeach      
    
@else
<article>
  <p style="color:black">Mặt Hàng Tạm Hết</p>
  </article>
@endif


         
          
       
          </div>
          @if(session('success'))
    <script>
    
        swal({
       
  title: "Thành Công!",
  text: '{{ session('success') }}',
  icon: "success",
  button: "Đồng ý!",
});
    </script>
@endif
          <div>
            <br><Br>
          {{ $sp ->links() }}</div>
        </section>

    </div>
  </div>

<!-- Sidebar -->
  <div id="sidebar">
    <div class="inner">

      <!-- Search -->
        <section id="search" class="alt">
          <form method="post" action="{{ route('product.search') }}">
            @csrf
            <input type="text" name="tukhoa" id="query" placeholder="Nhập từ khóa" />
          </form>
        </section>

      <!-- Menu -->
        <nav id="menu">
          <header class="major">
         <h2>Danh Mục Sản Phẩm</h2>
          </header>
          <ul>
            
<li><a href="{{ route('product.all') }}">Tất cả</a></li> 
          @foreach($tenmang as $dm)


<li> <a href="{{ route('product.dm', ['Category' =>$dm -> tendanhmuc ]) }}">{{ $dm -> tendanhmuc }} </a></li> 


@endforeach</ul>
          
        </nav>

      <!-- Section -->
        <section>
          <header class="major">
            <h2>Sản Phẩm Bán Chạy</h2>
          </header>
          <div class="mini-posts">
            <article>
              <a href="#" class="image"><img src="images/hoahongdo.png" style="width:200px;height:210px" alt="" /></a>
              <p>Hoa Hồng Đỏ</p>
              <ul class="actions">
            <li><a href="#" class="button">Xem Thêm</a></li>
          </ul>
            </article>
            <article>
              <a href="#" class="image"><img src="images/labachkim.png"  style="width:200px;height:210px"alt="" /></a>
              <p>Hoa Hồng Đỏ Lá Bạch Kim</p>
              <ul class="actions">
            <li><a href="#" class="button">Xem Thêm</a></li>
          </ul>
            </article>
            <article>
              <a href="#" class="image"><img src="images/babytrang.png"  style="width:200px;height:210px"alt="" /></a>
              <p>Hoa Baby Trắng Cổ Điển</p>
              
            </article>
          </div>
          <ul class="actions">
            <li><a href="#" class="button">Xem Thêm</a></li>
          </ul>
        </section>

      <!-- Section -->
      

      <!-- Footer -->
    

    </div>
  </div>

</div>

<!-- Scripts -->

<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

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