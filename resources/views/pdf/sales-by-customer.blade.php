<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales by Customer Report</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table width="100%">
                        <tr>
                            <td class="title" >
                                    <p style="font-size: 20px; line-height: 18px;padding:0;margin: 0">{{$Company->name}}</p>
                                    <p style="font-size: 16px; line-height: 18px;padding:0;margin: 0">SALES REPORT BY CUSTOMER</p>
                                     
                                     
                             </td>
                            
                            <td>
                                <p style="font-size: 16px; line-height: 18px;padding:0;margin: 0">{{$range}}</p>
                              
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
             
            

            
        <!--     <tr class="heading">
                <td style="text-align: left;">
                    Item
                </td>
                <td style="text-align: center;">
                    Date
                </td>
                <td style="text-align: right;">
                    Amount
                </td>
            </tr>
  -->

         <?php  $total=0;?>
            @foreach($invoiceSArray as $invoiceS)
                       <tr class="heading">
                            <td style="text-align: left;">
                                <b>{{$invoiceS['customer']->name}}</b>
                            </td>
                            <td style="text-align: center;">

                            </td>
                            <td style="text-align: right;">
                                 
                            </td>
                       </tr>
                    @foreach($invoiceS['invoices'] as $invoices )
                        <tr class="item">
                             <td style="text-align: left;">
                                {{$invoices->invoice_number}}
                              </td>
                            <td style="text-align: center;">
                             </td>

                            <td  style="text-align: right;">
                                {{usaCurrencyFormat($invoices->total)}}
                               <?php  $total=$total+$invoices->total;?>

                             </td>
                        </tr>
                    @endforeach
            @endforeach
            
            
            <tr class="total">
                <td></td><td></td>
                <td style="text-align: right;">
                   Total: <b>{{usaCurrencyFormat($total)}}</b>
                </td>
            </tr>
       

        </table>
    </div>
</body>
</html>