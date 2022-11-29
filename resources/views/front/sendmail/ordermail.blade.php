<?php
$orderid;
//$order_seller_id;
$sellerids = array();
$getorderdeatil = DB::table('order_detail')->where('order_id',$orderid)->get();
foreach ($getorderdeatil as $order_value)
{
	//$seller_id = explode(',',$order_value->seller_id);
	//print_r($seller_id);
	$seller_id = $order_value->seller_id;
	if(!in_array($seller_id, $sellerids))
    {
    $sellerids[] = $seller_id;
	//print_r($seller_id);	
	$getselllerdetail = DB::table('sellers')->where(array('user_id'=>$seller_id))->first();
	$seller_business_type = $getselllerdetail->business_type;
	$seller_reg_business_name = $getselllerdetail->reg_business_name;
	$seller_off_business_mobile = $getselllerdetail->off_business_mobile;
	$seller_vat_number = $getselllerdetail->vat_number;
	$seller_business_reg_number = $getselllerdetail->business_reg_num;
	$seller_business_address = $getselllerdetail->business_address;
	$seller_first_name = $getselllerdetail->first_name;
	$seller_middle_name = $getselllerdetail->middle_name;
	$seller_last_name = $getselllerdetail->last_name;
	$seller_mobile = $getselllerdetail->mobile;
	$seller_phone = $getselllerdetail->phone;
	$seller_state = $getselllerdetail->state;
	$seller_pincode = $getselllerdetail->pincode;
	$seller_address = $getselllerdetail->address;
	$seller_store_name = $getselllerdetail->storename;
	$getorder = DB::table('orders')->where(array('id'=>$orderid))->first();
	$oid = $getorder->oid;
	$totalamount = $getorder->totalamount;
	$delivery_charges = $getorder->delivery_charges;
	$discountamount = $getorder->discount_amount;
	$cashbackamount = $getorder->cashback_amount;
	$walletamount = $getorder->walletamount;
	$payement_method = $getorder->payment_method;
	$buyer_id = $getorder->buyer_id;
	$address_id = $getorder->address_id;
	$getbuyername = DB::table('users')->where(array('id'=>$buyer_id))->first();
	$buyer_name = $getbuyername->name;
	$getbuyeraddress = DB::table('addresses')->where(array('id'=>$address_id))->first();
	$buyer_address = $getbuyeraddress->address;
	$buyer_address2 = $getbuyeraddress->address2;
	$buyer_city = $getbuyeraddress->city;
	$buyer_state = $getbuyeraddress->state;
	$buyer_pincode = $getbuyeraddress->pincode;
	$buyer_country = $getbuyeraddress->country;
	$buyer_phoneno = $getbuyeraddress->phoneno;
	$uid = $getorder->uid;
	$transaction_id = $getorder->transaction_id;
	$payment_status = $getorder->payment_status;
	$status = $getorder->status;
	$created_at = $getorder->created_at;

	$random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$shuffle_str = str_shuffle($random_str);
	$current_date = @date("Y-m-d",time());
	$invocie_number = substr($shuffle_str,0,8);
	//die;
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="https://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Invoice</title>
	<style type="text/css">
	<!--
	body,td,th {
		font-family: Verdana, Geneva, sans-serif;
		font-size: 14px;
	}
	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
	}
	.ft-15{font-size:15px !important;}
	.table tr td{border: 1px solid #9E9E9E !important;font-size:12px !important;}
	-->
	</style></head>

	<body>
	<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
	    <td>
	    <table width="100%" border="0" cellspacing="0" cellpadding="5">
	  <tr>
	    <td width="50%" align="center" valign="top"><img src="https://development-review.net/emporium/public/front/img/LOGO-seller.jpg" width="140" /></td>
	    <td width="50%" align="right" valign="top"><p><strong>Tax Invoice/Bill of Supply/Cash Memo</strong><br />
	    (Original for Recipient)    </p></td>
	  </tr>
	  <tr>
	    <td height="20" colspan="2"></td>
	  </tr>
	  <tr>
	    <td valign="top"><strong>Sold By :</strong><br />
	    {{$seller_store_name}}<br />
	    *   
	    <?php
	    if($seller_business_address!='')
	    {
	    	echo $seller_business_address;
		}
		else
		{
			echo $seller_address;
		}
		?><br />
	    {{$seller_state}}, {{$seller_pincode}}
	    </td>
	    <td align="right" valign="top"><strong>Billing Address :</strong><br />
	    {{$buyer_address}}<br />
	    {{$buyer_address2}}<br />
	    {{$buyer_city}}, {{$buyer_state}}, {{$buyer_pincode}}<br />
	    {{$buyer_country}}  <br />
	    <!--<strong>State/UT Code</strong>: 07--></td>
	  </tr>
	  <tr>
	    <td height="20" colspan="2" valign="top"></td>
	  </tr>
	  <tr>
	    <td valign="top">
	    <?php
	    if($seller_vat_number!='')
	    {
	    ?>
	    <strong>PAN No:</strong> {{$seller_vat_number}}<br />
	    <?php
		}
	    ?>
	    <?php if($seller_business_reg_number!='') { ?>
	    	<strong>GST Registration No: </strong>{{$seller_business_reg_number}} 
	    <?php } ?>
		</td>
	    <td align="right" valign="top"><strong>Shipping Address :</strong><br />
	    {{$buyer_name}}<br />
	    {{$buyer_address}}<br />
	    {{$buyer_address2}}<br />
	    {{$buyer_state}}<br />
	    {{$buyer_city}}, {{$buyer_state}}, {{$buyer_pincode}}<br />
	    {{$buyer_country}}<br />
	    <!--<strong>State/UT Code:</strong>--> 07</td>
	  </tr>
	  <tr>
	    <td height="20" colspan="2" valign="top"></td>
	  </tr>
	  <tr>
	    <td valign="top"><strong>Order Number:</strong> {{$oid}}-{{$orderid}}<br />
	    <strong>Order Date: </strong>{{$created_at}}</td>
	    <td align="right" valign="top"><strong>Place of supply: </strong>{{$buyer_state}}<br />
	    <strong>Place of delivery:</strong> {{$buyer_state}}<br />
	    <strong>Invoice Number</strong> : {{$invocie_number}}<br />
	    <!--<strong>Invoice Details :</strong> GFHGHGGH<br />-->
	    <strong>Invoice Date</strong> : {{$created_at}}</td>
	  </tr>
	</table>
	<p>&nbsp;</p>
	<table class="table" width="100%" border="1" cellspacing="0" cellpadding="1" style="border:1px solid #414141;">
	  <tr>
	    <td width="10%" bgcolor="#cacaca"><strong>S.no</strong></td>
	    <td width="50%" bgcolor="#cacaca"><strong>Description</strong></td>
	    <td width="10%" bgcolor="#cacaca"><strong>Unit Price</strong></td>
	    <td width="10%" bgcolor="#cacaca"><strong>VAT</strong></td>
	    <td width="6%" bgcolor="#cacaca"><strong>Discount</strong></td>
	    <td width="4%" bgcolor="#cacaca"><strong>Qty</strong></td>
	    <td width="10%" bgcolor="#cacaca"><strong>Net Amount</strong></td>
	    <td width="10%" bgcolor="#cacaca"><strong>Total Amount</strong></td>
	  </tr>
		<?php
		$srl = 0;
		$get_order_deatil = DB::table('order_detail')->where(array('order_id'=>$orderid,'seller_id'=>$seller_id))->get();
		foreach($get_order_deatil as $order_detail)
		{
		$srl++;
		$product_id = $order_detail->product_id;
		$get_product_name = DB::table('products')->where('id',$product_id)->first();
		$product_name = $get_product_name->name;
		$spec_detail = unserialize($order_detail->spec_detail);
		$implode_spec_detail = implode(',', $spec_detail);
		$variant_id = $order_detail->variant_id;
		$product_amount = $order_detail->product_amount;
		$discount_amount = $order_detail->discount_amount;
		$delivery_charges = $order_detail->delivery_charges;
		$product_quantity = $order_detail->quantity;
		$single_product_amount_before_vat = $product_amount/$product_quantity;
		$vat_amount = $single_product_amount_before_vat*20/100;
		$single_product_amount = $single_product_amount_before_vat-$vat_amount;

		$product_seller_id = $order_detail->seller_id;
		?>
		<tr class="ft-12">
		<td>{{$srl}}</td>
		<td width="70%">{{$product_name}} | 
		<?php echo $implode_spec_detail;?>
	    </td>
		<td width="2%">£{{number_format($single_product_amount,2)}}</td>
		<td width="2%">£{{number_format($vat_amount,2)}}</td>
		<td width="2%">£{{number_format($discount_amount,2)}}</td>
		<td width="2%">{{$product_quantity}}</td>
		<td width="2%">£{{number_format($product_amount,2)}}</td>
		<td width="2%">£{{number_format($product_amount,2)}}</td>    
		</tr>
		<?php
		}
		?>
	  <tr>
	    <td>&nbsp;</td>
	    <td>Shipping Charges</td>
	    <td>£{{$delivery_charges}}</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <?php
		$purchases = DB::table('order_detail')->where(array('order_id'=>$orderid,'seller_id'=>$seller_id))->sum('product_amount');
	    $netamount = $purchases+$delivery_charges;
	    ?>
	    <td>£{{number_format($netamount,2)}}</td>
	    <td>£{{number_format($netamount,2)}}</td>
	  </tr>
	  <tr>
	    <td colspan="6"><strong>TOTAL:</strong></td>
	    <td>&nbsp;</td>
	    <td bgcolor="#cacaca"><strong>£{{number_format($netamount,2)}}</strong></td>
	  </tr>
	</table>
	<p>Whether tax is payable under reverse charge - No</p>
	<table class="table" width="100%" border="1" cellspacing="0" cellpadding="1" style="font-size:13px;">
	  <tr>
	    <td width="25%" align="left" valign="middle"><strong>Payment Transaction ID:</strong> {{$transaction_id}}</td>
	    <td width="25%" align="center" valign="middle"><strong>Date &amp; Time:</strong> {{$created_at}}</td>
	    <td width="25%" align="center" valign="middle"><strong>Invoice Value:</strong> {{number_format($netamount,2)}}</td>
	    <td width="25%" align="center" valign="middle"><strong>Mode of Payment:</strong> {{$payement_method}}</td>
	  </tr>
	</table>
	<p style="text-align:center;font-size:10px;color:#9E9E9E;width:80%;margin:80px auto 0 auto">*ASSPL-Emporium Seller Services Pvt. Ltd., ARIPL-Emporium Retail India Pvt. Ltd. (only where Emporium Retail India Pvt. Ltd. fulfillment center is co-located)<br />
	Customers desirous of availing input GST credit are requested to create a Business account and purchase on Emporium.com/business from Business eligible offers<br />
	Please note that this invoice is not a demand for payment</p>
	<p>&nbsp;</p>
	    </td>
	  </tr>
	</table>
	</body>
	</html>
<?php
}
}
?>