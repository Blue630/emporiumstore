<?php
$sesotp = session('otp', $otp);
?>
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
         <table align="center" border="1" width="100%">
     <tr>
     <td style="text-align:center; border:1px #CCCCCC solid;">OTP</td>
     <td style="text-align:center; border:1px #CCCCCC solid;"><?php echo e($sesotp); ?></td> 
    </tr>         
  </table>
</div>
</body><?php /**PATH D:\Works\Work-2022\laravel\resources\views/front/sendmail/regmail.blade.php ENDPATH**/ ?>