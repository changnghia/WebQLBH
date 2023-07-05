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

  <section class="client_section layout_padding">
    <div class="container ">
      <div class="heading_container">
        <h2>
         Khách hàng đánh giá
        </h2>
        <hr>
      </div>
      <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="client_container layout_padding-top">
              <div class="img-box">
                <img src="images/client-img.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                 Nguyễn Thanh Vũ
                </h5>
                <p style="text-align: justify;">
                  <p style="text-align: center;">
                  <img src="images/left-quote.png" alt="">
                  <span >
                 Hoa đẹp, phục vụ nhiệt tình
                  </span>
                  <img src="images/right-quote.png" alt="">
                  </p>
                  Shop hoa này thực sự là một nơi tuyệt vời để mua sắm hoa tươi. Không chỉ có một loạt các loại hoa đẹp mắt, mà còn có dịch vụ chăm sóc khách hàng tận tình. 
                  Tôi đã được đón tiếp nhiệt tình bởi nhân viên tại shop, họ cung cấp cho tôi những lời khuyên hữu ích về cách chọn lựa các loại hoa phù hợp với dịp mà tôi cần. 
                                 </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="client_container layout_padding-top">
              <div class="img-box">
                <img src="images/contrai.png" alt="" style="border-radius:300px;height: 170px;">
              </div>
              <div class="detail-box">
                <h5>
                 Trần Hữu Tín
                </h5>
                <p style="text-align: justify;">
                  <p style="text-align: center;">
                  <img src="images/left-quote.png" alt="">
                  <span>
                   Cửa hàng uy tín, hoa rất đẹp
                  </span>
                  <img src="images/right-quote.png" alt="">
                  </p>
                  Chất lượng của hoa rất tốt, hoa đều tươi và thơm, tỏa hương lấp lánh.
                  Giá cả cũng rất hợp lý, phù hợp với chất lượng của sản phẩm. Ngoài ra, shop còn cung cấp dịch vụ giao hoa nhanh chóng và đúng hẹn, giúp tôi tiết kiệm thời gian. Tôi thực sự hài lòng với trải nghiệm mua sắm hoa tại shop hoa này và sẽ quay lại lần sau.

                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="client_container layout_padding-top">
              <div class="img-box">
                <img src="images/phunu.png" alt=""style="border-radius:300px;height: 170px;">
              </div>
              <div class="detail-box">
                <h5>
                  Lê Khánh Vy
                </h5>
                <p style="text-align: justify;">
                  <p style="text-align: center;">
                  <img src="images/left-quote.png" alt="">
                  <span>
                   Rất thích hoa của shop này!
                  </span>
                  <img src="images/right-quote.png" alt=""> </p>
                  Điều mà tôi thích nhất ở shop hoa này là sự đa dạng của các loại hoa. Từ những bông hoa cổ điển như hoa hồng, hoa ly đến những loài hoa hiếm hoi, hoa độc đáo, đều có đủ.
                   Ngoài ra, shop còn cung cấp các dịch vụ trang trí hoa cho các dịp đặc biệt như đám cưới, sinh nhật, hay lễ kỷ niệm, giúp tôi tạo nên không gian đẹp mắt và ấn tượng.
                </p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
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