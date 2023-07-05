<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My_PDF</title>
</head>
<style>
    body{
    font-family: DejaVu Sans;
}
.dashed-line {
  border-bottom: 1px dashed black; /* Đặt đường viền dạng gạch đứt */
}

</style>
<body>
    <div  style="text-align:center">
    <h1><i>#hoatuoi.com</i></h1>
    <p>265 Nguyễn Trãi, Quận 1</p>
    <p>FB | INS : <i>hoatuoi_ins</i></p>
    <br>
    <p class="dashed-line"></p>

</div>
<body>
    <div  style="text-align:center">
    <p>Ngày đặt : <i>{{$ID->created_at}}</i></p>
    <p>Ngày giao : <i>{{$ID->updated_at}}</i></p>
    <b style="font-size:20px">HÓA ĐƠN BÁN HÀNG</b>
   <br> <b>#DH{{ $ID->id}}</b>


</div>
<p><b>Khách hàng </b>: {{$ID->tenkhachhang}}</p>
<p>Điện thoại : {{$ID->sdt}}</p>
<p>Hình thức thanh toán : <b>{{$ID->loai}}</b></p>

<br>
<p class="dashed-line"></p>
<br>
    <div style="  display: flex;text-align:center;">
        <a style="  float:left;"><b>Đơn giá</b></a>
        <a><b>SL</b></a>
        <a style="  float:right;"><b>Thành tiền</b></a>
@php 
$tong ='0';
@endphp
    </div>
    @foreach($CTB as $ctb)
    <p>{{$ctb->tensanpham}}</p>
    <div style="  display: flex;text-align:center;">
        <a style="  float:left;">{{$ctb->gia}}</a>
        <a>{{$ctb->soluong}}</a>
        <a style="  float:right;"> @php $gia=$ctb->gia;
             $soluong=$ctb->soluong;
             $thanhtien=intval(str_replace("." , "",$gia))*intval($soluong);
         
            $tong=$tong+$thanhtien;
             echo number_format($thanhtien,0, "," , "."), " ₫";
             
        @endphp</a>

      
        <p class="dashed-line"> </p>

    </div>
    @endforeach
    
    <div style="  text-align:center;">

        <p>Tổng tiền hàng   <span style="  float:right;">@php 
            echo number_format($tong,0, "," , "."), " ";
            @endphp VND</span></p>
      

        <p>Phí ship  <span style="  float:right;">45.000 VND</span></p>


        <p>Tổng cộng   <span style="float:right;"><b>{{$ID->tong}} VND</b></span></p>
      

        </div>
    <br>
<div style="text-align:center"><b><i>XIN CÁM ƠN QUÝ KHÁCH ^^</i></b></div>

</body>
</html>