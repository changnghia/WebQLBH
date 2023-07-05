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
                  <a class="nav-link" href="index.html">Trang chủ <span class="sr-only">(current)</span></a>
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
                  <a class="nav-link" href="contact.html">Liên hệ </a>
                </li>
               
                @include('menuname')
                <li class="nav-item">
               @include('hovercart')
                </li>

              </ul>
              
            </div>
          </div>
        </nav>
      </div>
    </div>
  </section>

  <!-- end nav section -->
  @if(session('success'))
  <script>
    
        swal({
       
  title: "Thành Công!",

  icon: "success",
  button: "Đồng ý!",
});
    </script>
    @endif
  <section class="contact_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-2 col-md-10 offset-md-1">
          <div class="heading_container">
            <hr>
            <h2>
                    Giỏ Hàng Của Bạn
            </h2>
          </div>
        </div>
      </div>

      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-lg-8 offset-lg-2 col-md-5 offset-md-1">
          <table class="table">
    <thead class="table-dark">
      <tr style="color:white">
        <th>Ảnh</th>
        <th>Tên Sản Phẩm</th>
        <th>Đơn Giá</th>
        <th>Số Lượng</th>
        <th>Thành Tiền</th>
        <th>Xóa</th>
      </tr>
    </thead>
    @if($cart->count() > 0)
    <tbody>
        @php
        $tong='0';
        @endphp
        @foreach($cart as $cartview)
     
        @foreach($pd as $sanpham)
        @if($cartview->id_sp == $sanpham->id)
        @if($cartview->soluong > $sanpham->soluong && $sanpham->soluong > 0)
        <tr>
        <td><div class="bannerhethang">

<img src="images/{{ $cartview->hinhanh }}" width="85px"height="80px"></div></td>
        <td style="color:gray">{{ $cartview->tensanpham }}</td>
        <td style="color:gray">{{ $cartview->gia }}</td>
        <td style="text-align:center;display:flex;"><a style="color:gray"  class="tanggiam">-  </a> &nbsp{{ $cartview->soluong }} &nbsp <a style="color:gray" class="tanggiam" > +</a></td>
        <td style="color:gray"> 
         @php $gia=$cartview->gia;
             $soluong=$cartview->soluong;
             $thanhtien=intval(str_replace("." , "",$gia))*intval($soluong);
         
            $tong=$tong+$thanhtien;
             echo number_format($thanhtien,0, "," , "."), " ₫";
             
        @endphp</td>
        <td ><a onclick="xoa('{{ route('tanggiam',['xoa'=> $cartview->id]) }}');"  id="cartdeletehover" ><svg xmlns="http://www.w3.org/2000/svg" fill="gray" viewBox="0 0 900 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a></td>
      </tr>
      @elseif($sanpham->soluong == '0')
      <tr>
        <td><div class="bannerhethangkhong">

<img src="images/{{ $cartview->hinhanh }}" width="85px"height="80px"></div></td>
        <td style="color:gray">{{ $cartview->tensanpham }}</td>
        <td style="color:gray">{{ $cartview->gia }}</td>
        <td style="text-align:center;display:flex;"><a style="color:gray"  class="tanggiam">-  </a> &nbsp{{ $cartview->soluong }} &nbsp <a style="color:gray" class="tanggiam" > +</a></td>
        <td style="color:gray"> 
         @php $gia=$cartview->gia;
             $soluong=$cartview->soluong;
             $thanhtien=intval(str_replace("." , "",$gia))*intval($soluong);
         
            $tong=$tong+$thanhtien;
             echo number_format($thanhtien,0, "," , "."), " ₫";
             
        @endphp</td>
        <td ><a onclick="xoa('{{ route('tanggiam',['xoa'=> $cartview->id]) }}');"  id="cartdeletehover" ><svg xmlns="http://www.w3.org/2000/svg" fill="gray" viewBox="0 0 900 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a></td>
      </tr>
      @else
      <tr>
        <td><img src="images/{{ $cartview->hinhanh }}" width="85px"height="80px"></td>
        <td>{{ $cartview->tensanpham }}</td>
        <td style="color:red">{{ $cartview->gia }}</td>
        <td style="text-align:center;display:flex;"><a href="{{ route('tanggiam',['gio-hang-cua-ban'=>$cartview->id]) }}" class="tanggiam">-  </a> &nbsp{{ $cartview->soluong }} &nbsp <a href="{{ route('tanggiam',['tang'=>$cartview->id]) }}" class="tanggiam" > +</a></td>
        <td style="color:red"> 
         @php $gia=$cartview->gia;
             $soluong=$cartview->soluong;
             $thanhtien=intval(str_replace("." , "",$gia))*intval($soluong);
         
            $tong=$tong+$thanhtien;
             echo number_format($thanhtien,0, "," , "."), " ₫";
             
        @endphp</td>
        <td ><a onclick="xoa('{{ route('tanggiam',['xoa'=> $cartview->id]) }}');"  id="cartdeletehover" ><svg xmlns="http://www.w3.org/2000/svg" fill="gray" viewBox="0 0 900 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a></td>
      </tr>
      @endif
        @endif
     @endforeach
    
      @endforeach
    
    </tbody>
  </table>
<script>
  function  xoa(url) {
    swal({
  title: "Bạn chắc chắn muốn xóa?",
  text: "Khi xóa sẽ không thể phục hồi!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {

  if (willDelete) {
    window.location.href = url;
  
  }
});
}
</script>
     <hr>
     <div id="bottomcart">
        <div id="oder1buton">
     <a onclick="xoarong('{{ route('tanggiam',['xoarong'=> 1]) }}')" class="btn btn-outline-secondary">Xóa Rỗng</a>&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp<a style="font-size:15px;" href="{{ route('product.all') }}"><span style="font-size:23px;vertical-align:sub">&#8617</span> Tiếp Tục Mua Hàng</a>
     </div>
     <script>
  function  xoarong(url) {
    swal({
  title: "Xóa tất cả giỏ hàng?",
  text: "Bạn có chắc chắn muốn xóa!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {

  if (willDelete) {
    window.location.href = url;
  
  }
});
}
</script>
     <table style="width:50%"  class="table table-striped">
       
    <thead>
      <tr>
        <th>Giá</th>
        <td>@php 
            echo number_format($tong,0, "," , "."), " ₫";
            @endphp
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Phí giao hàng toàn quốc</th>
        <td>45.000 ₫</td>
      </tr>
      <tr>
        <th>Tổng giỏ hàng</th>
        <td>@php 
            $tongdonhang='0';
            $phi=45000;
            $tongdonhang=$phi+$tong;
        echo number_format($tongdonhang,0, "," , "."), " ₫";
            @endphp
        </td>
      </tr>
   
    </tbody>
    


            
            
  </table>

  </div>
        
        <a  href="{{ route('thanhtoan') }}"id="btnttoan" class="btn btn-outline-success">Thanh Toán</a>  
    
       </div>
       @else
      <tbody>
            <tr>
              <td><img src="images/carttrong.png" width="200px"></td>
            

              </tr>    
              <tr>
              <td>Không có sản phẩm đi <a href="{{ route('product.all') }}">đặt hàng</a> ngay!</td>
              </tr>

    </tbody>
    </table>
            @endif
      </div>
    </div>
  </section>

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
                Số điện thoại : 0911472518
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