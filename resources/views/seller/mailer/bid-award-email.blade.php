<style>
    body {font-family:Helvetica, Arial, sans-serif; font-size:10pt;} 
    table {width:40%; border-collapse:collapse; border:1px solid #CCC;}
    td {padding:5px; border:1px solid #CCC; border-width:1px 0;}
    .inner{
        width:40%;border:groove;
    }
</style>
<body>
<div class="inner">
     <h4>Hello <strong>{{ucfirst($mail_data['username'])}},</strong></h4>
     <p>Your bid have been awarded for the product given below:</p>
    
             <table align="center" border="1" width="100%">
         <tr>
        <th>Product Name</th>
        <th>Bid Amount</th>
        <th>Bid Date & Time</th>
        </tr>
        <tr>
        <td style="text-align:center; border:1px #CCCCCC solid;">{{$mail_data['product_name']}}</td>
        <td style="text-align:center; border:1px #CCCCCC solid;">{{$mail_data['bid']}}</td> 
        <td style="text-align:center; border:1px #CCCCCC solid;">{{$mail_data['bid_date']}}</td> 
        </tr>
      
      </table>
      
      
      <p><a href="https://development-review.net/emporium/mybids">Please go to this url for complete your payment</a></p>
      
  </div>
    </body>






