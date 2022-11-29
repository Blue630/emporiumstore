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
         <td style="text-align:center; border:1px #CCCCCC solid;" colspan="2">Welcome To Log Zero Technologies</td>
        </tr>
        <tr>
         <td style="text-align:center; border:1px #CCCCCC solid;">Your Login URL</td>
         <td style="text-align:center; border:1px #CCCCCC solid;">{{url('/vendor-login')}}</td> 
        </tr>
        <tr>

        <tr>
         <td style="text-align:center; border:1px #CCCCCC solid;">Your Profile Url</td>
         <td style="text-align:center; border:1px #CCCCCC solid;">{{url('/vendor-profile')}}/{{$vendordetail->storeslug}}</td> 
        </tr>
      </table>
  </div>
    </body>






