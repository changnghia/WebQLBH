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
  @php 
                        $i= ($bill->currentPage() - 1) * $bill->perPage() + 1;;
                        @endphp

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-2 col-md-10 offset-md-1">
          <div class="heading_container">
            <hr>
            <h2>
            Đơn hàng của bạn
            </h2>
          </div>
        </div>
      </div>
      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-lg-10 offset-lg-1 col-md-5 offset-md-1">
          <table class="table">
    <thead class="table-dark">
      <tr style="color:white">
        <th>STT</th>
        <th>Mã đơn hàng</th>
        <th>Ngày đặt</th>
        <th>Địa chỉ nhận hàng</th>
        <th style="text-align:center;">SĐT</th>
        <th>Số lượng</th>
        <th>Lời nhắn</th>
        <th>Hình thức</th>
        <th>Tổng</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    @if($bill->count() > 0)
    <tbody>
        @php
        $tong='0';
  
        @endphp
        @foreach($bill as $dh)
     

      <tr>
        <td style="text-align:center;">{{$i++}}</td>
        <td style="text-align:center;">#DH{{ $dh->id }}<br>
        @if($dh->trangthai == 'Hoàn thành')
        <span class="badge badge-success">{{$dh->trangthai}}</span>
        @elseif($dh->trangthai == 'Đang xử lý')
        <span class="badge badge-warning">{{$dh->trangthai}}</span>
        @elseif($dh->trangthai == 'Hủy')
        <span class="badge badge-danger">Đã {{$dh->trangthai}}</span>
        @endif
        </td>
        <td ><div style="width:100px">{{ $dh->created_at }}</div></td>
        <td ><div style="width:180px"> {{ $dh->diachi }}</div></td>
        <td> {{$dh->sdt}}</td>
        <td style="text-align:center;"> {{$dh->soluong}}</td>
        <td> {{$dh->loinhan}}</td>
        <td style="text-align:center;"> {{$dh->loai}}</td>
        <td style="color:red"> {{$dh->tong}} ₫</td>
        <td ><div style="width:80px">  <a  id="xemdon" href="{{route('chitietdonhanguser',['id'=>$dh->id])}}" >Xem</a> <br><br>  @if($dh->trangthai=='Đang xử lý')<a id="huydon" onclick="huy('{{route('huydonhang',['id'=>$dh->id])}}')" >Hủy đơn</a>@endif</div></td>
      </tr>
      @endforeach
    
    </tbody>
  </table>

<br>
     <hr>
<br>
<div style="display:flex;  justify-content: center;width:100%">
            {{ $bill ->links() }}</div>
                
        <div id="oder1buton">
<a style="font-size:15px;" href="{{ route('product.all') }}"><span style="font-size:23px;vertical-align:sub">&#8617</span> Tiếp Tục Mua Hàng</a>
     </div>
   
<br><br>
<br><br>
<br><br>
       @else
      <tbody>
            <tr>
              <td><img src="images/carttrong.png" width="200px"></td>
            

              </tr>    
              <tr>
              <td>Không có đơn hàng nào !! <a href="{{ route('product.all') }}">đặt hàng</a> ngay!</td>
              </tr>

    </tbody>
    </table>
            @endif
      </div>
    </div>
  </section>
  <script>
  function  huy(url) {
    swal({
  title: "Hủy đơn hàng?",
  icon: "warning",
  buttons: true,
})
.then((willDelete) => {

  if (willDelete) {
    window.location.href = url;
  
  }
});
}
</script>
@if(session('success'))
  <script>
    
        swal({
       
  title: "Thành Công!",

  icon: "success",
  button: "Đồng ý!",
});
    </script>
    @endif
  <!-- end contact section -->


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