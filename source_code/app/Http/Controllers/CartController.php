<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Bill;
use App\Models\ChiTietBill;
use App\Models\User;
use App\Models\Category;
use App\Models\LichSuNhapKho;

use Mail;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function index()
    {
        $cart= Cart::where('id_user',auth()->user()->id)->get();
        $hover=Cart::where('id_user',auth()->user()->id)->get();
        $pd=Product::all();
        return view('Cart')->with('cart',$cart)->with('hover',$hover)->with('pd',$pd);
    }
    public function indexbill()
    {
        $bill= Bill::orderBy('created_at','desc')->get();
        $pd=Product::all();

        return view('spica.pages.tables.donhang')->with('bill',$bill)->with('pd',$pd);
    }

    public function Nhapkho()
    {
        $product = Product::paginate(10);
        $dm = Category::all();
    
        return view('spica.pages.tables.Nhapkho')->with('product',$product)->with('dm',$dm);
    }

    public function savekho(Request $request)
    {
        $tong=$request->slkho+$request->nhapkho;


        $pd=Product::find($request->id_sp);
        $pd->soluong=$tong;
        $pd->save();

        $ls= new LichSuNhapKho;
        $ls->id_sp = $request->id_sp;
        $ls->tensanpham = $request->tensp;
        $ls->soluongkho = $request->slkho;
        $ls->soluongnhap = "+" . $request->nhapkho;
        $ls->soluongkhinhap = $tong;
        $ls->save();


        return redirect()->back()->with('success','Đã thêm sản phẩm!');
    }

    
    public function mailvnpay()
    {
        if(auth()->check()){
            $hover=Cart::where('id_user',auth()->user()->id)->get();
            $pd=Product::all();
    
            if(isset($_GET['vnp_TransactionStatus'])){
            if($_GET['vnp_TransactionStatus'] == '00')
            {
                $cart= Cart::where('id_user',auth()->user()->id)->get();
    
                foreach($cart as $hang){
                    foreach($pd as $sanpham){
           
                        if($sanpham->id == $hang->id_sp){
                        if($sanpham->soluong > $hang->soluong){
                $productsluong = Product::where('id',$hang->id_sp)->get();
                foreach($productsluong as $sluongpd){
                    $tinhsoluong = ($sluongpd->soluong - $hang->soluong);
               
            
                    $ls= new LichSuNhapKho;
                    $ls->id_sp = $sluongpd->id;
                    $ls->tensanpham = $sluongpd->tensanpham;
                    $ls->soluongkho = $sluongpd->soluong;
                    $ls->soluongnhap = "-" . $hang->soluong;
               
                }
                $ls->soluongkhinhap = $tinhsoluong;
                $ls->save();
                $sluongpd->soluong = $tinhsoluong;
                $sluongpd->save();
    
              
    
            Cart::where('id_user',auth()->user()->id)->where('id_sp',$hang->id_sp)->delete();
    
    
        }
    }
    }
            }
         

            $sanphamchitiet=ChiTietBill::where('id_dh',$_GET['vnp_checkeau'])->get();
            $tongbill=Bill::where('id',$_GET['vnp_checkeau'])->first();
            $name = auth()->user()->name;
            $emaildh=auth()->user()->email;
            $sdtdh=auth()->user()->sdt;
            $dcdathang=auth()->user()->diachi;
            Mail::send('thongbaodathang',compact('name','emaildh','sdtdh','dcdathang','sanphamchitiet','tongbill'),function($email) use($emaildh){
                $email->subject('Đặt hàng thành công');
                $email->to($emaildh);
            });
            Mail::send('codondathang',compact('name','emaildh'),function($email) use($emaildh){
                $email->subject('Có đơn hàng mới từ '.$emaildh);
                $email->to("changnghia2307@gmail.com");
            });

            }
            elseif($_GET['vnp_TransactionStatus'] == '02'){
            return view('huydathang')->with('success', 'Đã thêm sản phẩm vào giỏ hàng')->with('hover',$hover);

            }
        }
            return redirect('/Dathang?vnp_TransactionStatus=00')->with('success', 'Đã thêm sản phẩm vào giỏ hàng')->with('hover',$hover);
            //redirec thì không gửi bằng with được phải dùng view
            

        }else{
            return view('hoanthanh')->with('kiemtralogin','check');
        }

    }
    public function dathangthanhcong()
    {
    
            return view('hoanthanh')->with('kiemtralogin','check');
        
    }



    public function taikhoan()
    {
        $user= User::paginate(8);
        return view('spica.pages.tables.taikhoan')->with('user',$user);
    }

    public function Thongke()
    {
        $lichsu=LichSuNhapKho::orderBy('created_at','desc')->get();
        $monthlyTotals = Bill::where('trangthai','Hoàn thành')->select(DB::raw('DATE_FORMAT(`created_at`, "%m") AS month'), DB::raw('SUM(REPLACE(tong, ".", "")) AS total_value'))
        ->whereRaw('YEAR(`created_at`) = date("Y")')

        ->groupBy('month')
        ->pluck('total_value','month')
     
        ->toArray();
        $monthlyTotalsWithZero = [
            '01' => 0,
            '02' => 0,
            '03' => 0,
            '04' => 0,
            '05' => 0,
            '06' => 0,
            '07' => 0,
            '08' => 0,
            '09' => 0,
            '10' => 0,
            '11' => 0,
            '12' => 0
        ];
        
    // Gán giá trị tính tổng vào mảng
    $resultmonth = array_replace($monthlyTotalsWithZero, $monthlyTotals);





        $demdh=Bill::all();
        $daata = Product::select('danhmuc', DB::raw('SUM(soluong) as tongkho'))->groupBy('danhmuc')->get();
    
        $data= $daata->pluck('tongkho')->toArray();
        $datadm= $daata->pluck('danhmuc')->toArray();
        $tong=0;
        $random=[];
        $pd =Product::all();
        foreach($pd as $pds){
            $tong =$tong + $pds->soluong;
        }
        foreach($datadm as $dem){
            $mausac = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $random[]=$mausac;
        }
      
            $doanhthu=Bill::where('trangthai','Hoàn thành')->get();
            $tongdoanhthu=0;
            foreach($doanhthu as $doanhthus){
                $tongdoanhthu=$tongdoanhthu + intval(str_replace('.','',$doanhthus->tong));
            }

            $bill = Bill::select('trangthai', DB::raw('COUNT(*) as dembill'))->groupBy('trangthai')->orderBy(DB::raw("FIELD(trangthai, 'Đang xử lý','Hoàn thành', 'Hủy')"))->selectRaw("CASE 
            WHEN trangthai = 'Đang xử lý' THEN   'rgba(255, 206, 86, 0.5)' -- Màu sắc cho Đang xử lý
            WHEN trangthai = 'Hoàn thành' THEN   'rgba(75, 192, 192, 0.5)' -- Màu sắc cho Hoàn thành
            WHEN trangthai = 'Hủy' THEN  'rgba(255, 99, 132, 0.5)' -- Màu sắc cho Hủy
            ELSE '#000000' -- Màu sắc mặc định
        END AS color")->get();



            $tt= $bill->pluck('trangthai')->toArray();
            $dembill= $bill->pluck('dembill')->toArray();
            $maume= $bill->pluck('color')->toArray();
        return view('spica.pages.tables.Thongke')->with('data',$data)->with('datadm',$datadm)->with('tong',$tong)->with('mausac',$random)->with('dembill',$dembill)
        ->with('tt',$tt)->with('maume',$maume)->with('doanhthu',$tongdoanhthu)->with('demdh',$demdh)->with('thang',$resultmonth)->with('lichsu',$lichsu);
   



    }

    
    public function searchmonth(Request $request)
    {
        $lichsu=LichSuNhapKho::orderBy('created_at','desc')->get();


        $monthlyTotals = Bill::where('trangthai','Hoàn thành')->select(DB::raw('DATE_FORMAT(`created_at`, "%m") AS month'), DB::raw('SUM(REPLACE(tong, ".", "")) AS total_value'))
        ->whereRaw('YEAR(`created_at`) = date("Y")')

        ->groupBy('month')
        ->pluck('total_value','month')
     
        ->toArray();
        $monthlyTotalsWithZero = [
            '01' => 0,
            '02' => 0,
            '03' => 0,
            '04' => 0,
            '05' => 0,
            '06' => 0,
            '07' => 0,
            '08' => 0,
            '09' => 0,
            '10' => 0,
            '11' => 0,
            '12' => 0
        ];
        
    // Gán giá trị tính tổng vào mảng
    $resultmonth = array_replace($monthlyTotalsWithZero, $monthlyTotals);

        $daata = Product::select('danhmuc', DB::raw('SUM(soluong) as tongkho'))->groupBy('danhmuc')->get();
    
        $data= $daata->pluck('tongkho')->toArray();
        $datadm= $daata->pluck('danhmuc')->toArray();
        $tong=0;
        $random=[];


        $demdh=Bill::where('created_at','like','%'.$request->sr.'%')->get();
        $doanhthu=Bill::where('trangthai','Hoàn thành')->where('created_at','like','%'.$request->sr.'%')->get();
        $tongdoanhthu=0;
        foreach($doanhthu as $doanhthus){
            $tongdoanhthu=$tongdoanhthu + intval(str_replace('.','',$doanhthus->tong));
        }


        $pd =Product::all();
        foreach($pd as $pds){
            $tong =$tong + $pds->soluong;
        }
        foreach($datadm as $dem){
            $mausac = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $random[]=$mausac;
        }
        $bill = Bill::where('created_at','like','%'.$request->sr.'%')->select('trangthai', DB::raw('COUNT(*) as dembill'))->groupBy('trangthai')
        ->orderBy(DB::raw("FIELD(trangthai, 'Đang xử lý','Hoàn thành', 'Hủy')"))->selectRaw("CASE 
        WHEN trangthai = 'Đang xử lý' THEN   'rgba(255, 206, 86, 0.5)' -- Màu sắc cho Đang xử lý
        WHEN trangthai = 'Hoàn thành' THEN   'rgba(75, 192, 192, 0.5)' -- Màu sắc cho Hoàn thành
        WHEN trangthai = 'Hủy' THEN  'rgba(255, 99, 132, 0.5)' -- Màu sắc cho Hủy
        ELSE '#000000' -- Màu sắc mặc định
    END AS color")->get();
        
        if($bill->count() > 0){
        $tt= $bill->pluck('trangthai')->toArray();
        $dembill= $bill->pluck('dembill')->toArray();
        $maume= $bill->pluck('color')->toArray();
        
        return view('spica.pages.tables.Thongke')->with('data',$data)->with('datadm',$datadm)->with('tong',$tong)->with('mausac',$random)->with('dembill',$dembill)
        ->with('tt',$tt)->with('m',$request->sr)->with('dt',$request->dt)->with('maume',$maume)->with('doanhthu',$tongdoanhthu)->with('demdh',$demdh)->with('thang',$monthlyTotalsWithZero)->with('thang',$resultmonth)->with('lichsu',$lichsu);

    }
    else{

        $dembill=[1];
        $tt=[Null];
        $maume=[0];
        return view('spica.pages.tables.Thongke')->with('data',$data)->with('datadm',$datadm)->with('tong',$tong)->with('mausac',$random)->with('dembill',$dembill)
        ->with('tt',$tt)->with('m',$request->sr)->with('dt',$request->dt)->with('maume',$maume)->with('doanhthu',$tongdoanhthu)->with('demdh',$demdh)->with('thang',$monthlyTotalsWithZero)->with('thang',$resultmonth)->with('lichsu',$lichsu);
    }
    }

    public function    phanquyen()
    {
      

        $que= User::orderBy("role","asc");
        $user = $que->paginate(8);
        return view('spica.pages.tables.phanquyen')->with('user',$user);
    }

    public function indexctbill(Request $request)
    {
    
        $bill= Bill::find($request->id);
        $ct=ChiTietBill::all();
        return view('spica.pages.tables.ctdonhang')->with('bill',$bill)->with('ct',$ct);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_sp=$request->query('add');
      
        $cart= Cart::where('id_sp',$id_sp)->where('id_user',auth()->user()->id)->first();
       $sp= Product::find($id_sp);
        if($cart){
            $cart->soluong ++;
        $cart->save();
        }else{
           $cart= new Cart();
           $cart->id_user = auth()->id();
           $cart->id_sp = $id_sp;
           $cart->hinhanh = $sp->hinhanh;
           $cart->tensanpham = $sp->tensanpham;
           $cart->gia = $sp->gia;
           $cart->soluong = 1;
           $cart->save();
           
        }
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');

    }
    public function tanggiam(Request $request)
    {
       $id_giam=$request->query('gio-hang-cua-ban');
       $id_tang=$request->query('tang');
       $xoa=$request->query('xoa');
       $xoarong=$request->query('xoarong');

        $cartgiam=Cart::where('id',$id_giam)->first();
        $carttang=Cart::where('id',$id_tang)->first();
        $cartxoa=Cart::where('id',$xoa)->first();
   

        if($id_giam){
        if($cartgiam->soluong == 1){
            $cartgiam->delete();

        }else{
            $cartgiam->soluong --;
            $cartgiam->save();
        }
    
    }
        if($id_tang){
            $carttang->soluong ++;
            $carttang->save();
        }
        if($cartxoa){
            $cartxoa->delete();
        }
        if($xoarong){
            $cartxoarong=Cart::where('id_user',auth()->user()->id)->delete();
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $MaxIdBill=Bill::max('id');
        $IdBill=$MaxIdBill +1 ;

        if(isset($_POST['redirect'])){
          
            $cart= Cart::where('id_user',$request->id_user)->get();
            $hover=Cart::where('id_user',auth()->user()->id)->get();
            $pd=Product::all();
        
            $tinhsoluong=0;
            $user=User::find($request->id_user);
            if(auth()->user()->sdt == ''){
                $user->sdt = $request->sdt;
                $user->save();
            }
            if(auth()->user()->diachi == ''){
                $user->diachi = $request->diachi;
                $user->save();
            }
    
        
          

            $Bill = new Bill;
            $Bill->id = $IdBill;
            $Bill->id_user = $request->id_user;
            $Bill->tenkhachhang = $request->tenkhachhang;
            $Bill->sdt = $request->sdt;
            $Bill->diachi = $request->diachi;
            $Bill->soluong = $request->tongsoluong;
            $Bill->loinhan = $request->loinhan;
            $Bill->loai = 'VNPay';
            $Bill->tong = $request->tong; 
            $Bill->trangthai = 'Đang xử lý'; 
        
            foreach($cart as $hang){
    
            foreach($pd as $sanpham){
       
                if($sanpham->id == $hang->id_sp){
                if($sanpham->soluong > $hang->soluong){
            
  
    
            $ChiTietBill = new ChiTietBill;
            $ChiTietBill->id_user= $request->id_user;
            $ChiTietBill->id_sp = $hang->id_sp;
            $ChiTietBill->id_dh = $IdBill;
            $ChiTietBill->hinhanh = $hang->hinhanh;
            $ChiTietBill->tensanpham = $hang->tensanpham;
            $ChiTietBill->gia = $hang->gia;
            $ChiTietBill->soluong = $hang->soluong;
            $ChiTietBill->save() ;

        }
    }
        }
    
            }
           if($Bill->save()){
                // if($Bill->exists){
                //     Cart::where('id_user',$request->id_user)->delete();
                // }else{
                //     echo "Vui lòng thao tác lại!";
                // }
            }else{
                echo "Lỗi khi lưu dữ liệu";
            }


        
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/mailvnpay?vnp_checkeau=".$IdBill;
        $vnp_TmnCode = "6OFTMY08";//Mã website tại VNPAY 
        $vnp_HashSecret = "SSNGDCBVCFWJUNYMJTYUPFOHUWEHLUFA"; //Chuỗi bí mật
        
        $vnp_TxnRef = '#DH' . $IdBill; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán mua hàng hoatuoi.com lúc : ' . Carbon::now('Asia/Ho_Chi_Minh');
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = intval(str_replace(".","",$request->tong)) * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        //$vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
   
   
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
              
    
                header('Location: ' . $vnp_Url);
                die();
              
            } else {
                
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo


        }
else{

        $cart= Cart::where('id_user',$request->id_user)->get();

        $pd=Product::all();
    

        $tinhsoluong=0;
        $user=User::find($request->id_user);
        if(auth()->user()->sdt == ''){
            $user->sdt = $request->sdt;
            $user->save();
        }
        if(auth()->user()->diachi == ''){
            $user->diachi = $request->diachi;
            $user->save();
        }


        $Bill = new Bill;
        $Bill->id = $IdBill;
        $Bill->id_user = $request->id_user;
        $Bill->tenkhachhang = $request->tenkhachhang;
        $Bill->sdt = $request->sdt;
        $Bill->diachi = $request->diachi;
        $Bill->soluong = $request->tongsoluong;
        $Bill->loinhan = $request->loinhan;
        $Bill->loai = 'Tiền mặt';
        $Bill->tong = $request->tong; 
        $Bill->trangthai = 'Đang xử lý'; 
    
 
        foreach($cart as $hang){

         
            foreach($pd as $sanpham){
       
                if($sanpham->id == $hang->id_sp){
                if($sanpham->soluong > $hang->soluong){
            
        $productsluong = Product::where('id',$hang->id_sp)->get();
        foreach($productsluong as $sluongpd){
            $tinhsoluong = ($sluongpd->soluong - $hang->soluong);
            $ls= new LichSuNhapKho;
            $ls->id_sp = $sluongpd->id;
            $ls->tensanpham = $sluongpd->tensanpham;
            $ls->soluongkho = $sluongpd->soluong;
            $ls->soluongnhap = "-" . $hang->soluong;
       
        }
        $ls->soluongkhinhap = $tinhsoluong;
        $ls->save();
        
        $sluongpd->soluong = $tinhsoluong;
        $sluongpd->save();

        Cart::where('id_user',auth()->user()->id)->where('id_sp',$hang->id_sp)->delete();

        $ChiTietBill = new ChiTietBill;
        $ChiTietBill->id_user= $request->id_user;
        $ChiTietBill->id_sp = $hang->id_sp;
        $ChiTietBill->id_dh = $IdBill;
        $ChiTietBill->hinhanh = $hang->hinhanh;
        $ChiTietBill->tensanpham = $hang->tensanpham;
        $ChiTietBill->gia = $hang->gia;
        $ChiTietBill->soluong = $hang->soluong;
        $ChiTietBill->save() ;

    }}}
        }
       if($Bill->save()){
            if($Bill->exists){
                $hover=Cart::where('id_user',auth()->user()->id)->get();
             
                $sanphamchitiet=ChiTietBill::where('id_dh',$IdBill)->get();
                $tongbill=Bill::where('id',$IdBill)->first();
             
                $sdtdh=auth()->user()->sdt;
                $dcdathang=auth()->user()->diachi;

                $name = auth()->user()->name;
                $emaildh=auth()->user()->email;
                Mail::send('thongbaodathang',compact('name','emaildh','sdtdh','dcdathang','sanphamchitiet','tongbill'),function($email) use($emaildh){
                    $email->subject('Đặt hàng thành công');
                    $email->to($emaildh);
                });
                Mail::send('codondathang',compact('name','emaildh'),function($email) use($emaildh){
                    $email->subject('Có đơn hàng mới từ '.$emaildh);
                    $email->to("changnghia2307@gmail.com");
                });
   
                return redirect('/Dathang?vnp_TransactionStatus=00')->with('success', 'Đã thêm sản phẩm vào giỏ hàng')->with('hover',$hover);

            }else{
                echo "Vui lòng thao tác lại!";
            }
        }else{
            echo "Lỗi khi lưu dữ liệu";
        }
   
      
}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function  edittaikhoan(string $id)
    {
        $user= User::find($id);
        return view('spica.pages.tables.edittaikhoan')->with('user',$user);
    }


    public function editdonhang(string $id)
    {
        $bill= Bill::find($id);
        $ct=ChiTietBill::all();
        return view('spica.pages.tables.editdonhang')->with('bill',$bill)->with('ct',$ct);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    



   

    
    public function  updateroleuser(Request $request, string $id)
    {
        User::where('id',$id)->update(['role' =>$request->status]);
        return redirect()->route('phanquyen')->with('success','Đã cấp quyền user!!');
    }

    public function updaterole(Request $request, string $id)
    {
        User::where('id',$id)->update(['role' =>$request->status]);
        return redirect()->route('phanquyen')->with('hoanthanh','Đã cấp quyền admin!!');
    }




    public function updatetrangthai(Request $request, string $id)
    {
        Bill::where('id',$id)->update(['trangthai' =>$request->status]);
        return redirect()->route('indexbill')->with('hoanthanh','Trạng thái đơn hàng của bạn đã được thay đổi!!');
    }

 
    public function updatetaikhoan(Request $request, string $id)
    {
        $user = User::where('id',$id)->first();
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->sdt = $request->sdt;
        $user->diachi = $request->diachi;
        $user->save();
        return redirect()->route('edittaikhoan',['Cart' =>$id])->with('success',' tài khoản đã cập nhật thành công!!');
        
    }









    public function updatedonhang(Request $request, string $id)
    {
       

        $idspArray = $request->id_sp;
        $soluongArray = $request->soluong;
        $giaArray = $request->gia;
        $soluongArrayOld = $request->soluongold;
        $tongtien=0;

        $tongsoluong=array_sum($request->soluong);
        foreach ($idspArray as $key => $idsp) {
            $soluong = $soluongArray[$key];
            $gia = $giaArray[$key];
            $soluongold = $soluongArrayOld[$key];
            $tongtien = $tongtien+ (intval($soluong) * intval(str_replace("." , "",$gia)));
        
            // Thực hiện cập nhật giá trị soluong cho idsp tương ứng
            ChiTietBill::where('id_sp', $idsp)
                ->update(['soluong' => $soluong]);

            $timpds = Product::where('id',$idsp)->get();
            foreach ($timpds as $timpd) {
                // Lấy index của phần tử trong mảng $id
            
                // Trừ đi giá trị tương ứng từ mảng $soluong
                $timpd->soluong = $timpd->soluong - ($soluong - $soluongold) ;
            
                // Lưu thay đổi
                $timpd->save();
            }

        }
              $thanhtien=$tongtien+ 45000;

        $product=Bill::find($id);
        $product->tenkhachhang = $request->tenkhachhang;
        $product->sdt = $request->sdt;
        $product->diachi = $request->diachi;
        $product->loinhan = $request->loinhan;
        $product->soluong = $tongsoluong;
        $product->tong = number_format($thanhtien,0, "," , ".");
        $product->save();


        return redirect()->route('editdonhang',['Cart'=> $id] )->with('success','Đã cập nhật đơn hàng!!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
        Bill::where('id',$id)->delete();
        ChiTietBill::where('id_dh',$id)->delete();
        return redirect()->route('indexbill' )->with('success','Đã xóa đơn hàng!!');
    }


    public function xoataikhoan(string $id)
    {
    
        User::where('id',$id)->delete();
        return redirect()->route('taikhoan')->with('success','Đã xóa tài khoản!!');
    }






}
