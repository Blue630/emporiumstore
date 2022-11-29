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
         <td style="text-align:center; border:1px #CCCCCC solid;">Name</td>
         <td style="text-align:center; border:1px #CCCCCC solid;">{{$dataset['name']}}</td> 
        </tr>
        <tr>
         <td style="text-align:center; border:1px #CCCCCC solid;">Email</td>
         <td style="text-align:center; border:1px #CCCCCC solid;">{{$dataset['email']}}</td> 
        </tr>
        <tr>

        <tr>
         <td style="text-align:center; border:1px #CCCCCC solid;">Phone</td>
         <td style="text-align:center; border:1px #CCCCCC solid;">{{$dataset['phone']}}</td> 
        </tr>

         <td style="text-align:center; border:1px #CCCCCC solid;">Address</td>
         <td style="text-align:center; border:1px #CCCCCC solid;">{{$dataset['address']}}</td> 
        </tr>
       
         <td style="text-align:center; border:1px #CCCCCC solid;">Message</td>
         <td style="text-align:center; border:1px #CCCCCC solid;">{{$dataset['message']}}</td> 
        </tr>
      </table>
  </div>
    </body>






