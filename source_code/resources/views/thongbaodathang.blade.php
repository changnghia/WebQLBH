
<div style="width:500px;margin: 0 auto;padding:15px;text-align:center">

<h2>Chào {{ $name }}</h2>

<p>
<div style="text-align:justify">
 
Đơn hàng #DH{{ $tongbill->id }} của bạn sẽ sớm giao đến bạn.

Vui lòng đăng nhập Hoatuoi.com để theo dõi trạng thái đơn hàng. Sau khi bạn nhận hàng, vui lòng thanh toán cho shipper.
</p>
</div>

<p>
<h3>
  
  THÔNG TIN ĐƠN HÀNG - DÀNH CHO NGƯỜI MUA
  
  </h3> 
<ul>
    <li>Người đặt hàng : {{ $name }}</li>
    <li>Tài khoản đặt hàng : {{ $emaildh }}</li>
    <li>Số điện thoại nhận hàng : {{ $sdtdh }}</li>
    <li>Địa chỉ nhận hàng : {{ $dcdathang }}</li>
    <li>Lời nhắn : {{ $tongbill->loinhan }}</li>
    

</ul>
<ul>
  @foreach($sanphamchitiet as $sp)
<li>Tên sản phẩm : {{ $sp->tensanpham }}</li>
<li>Số lượng : {{ $sp->soluong }}</li>
<li>Giá :  <span style="color:green">{{ $sp->gia }} ₫</span></li>
<br>
<hr>
@endforeach
<li>Tổng số lượng : {{ $tongbill->soluong }}</li>
<li>Phí ship : 45.000₫</li>
<li>Tổng tiền : <span style="color:red">{{ $tongbill->tong }}₫</span></li>

</ul>
</p>
<p>
Chúc bạn luôn có những trải nghiệm tuyệt vời khi mua sắm tại <b>Hoatuoi.com</b>
</p>
<p>Thân mến,</p>
<p>Đội ngũ <b>Hoatuoi.com</b></p>
</div>