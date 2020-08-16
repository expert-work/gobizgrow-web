<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{$Estimate->estimate_number}} : {{$Customer->name}}</title>
    
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
                                    <p style="font-size: 16px; line-height: 18px;padding:0;margin: 0">{{$Company->phone}}</p>
                                    <p style="font-size: 16px; line-height: 18px;padding:0;margin: 0">{{$Company->country}}</p>
                                     
                             </td>
                            
                            <td>

                                <div style="width: 250px;  float: right;">
                                    <table width="100%" >
                                   <tr style="padding: 0;margin: 0">
                                       <td width="60%" style="text-align: left;padding: 0;margin: 0; line-height: 18px">Estimate Number</td>
                                       <td width="40%"  style="padding: 0;margin: 0; line-height: 18px">{{$Estimate->estimate_number}}</td>
                                   </tr>

                                   <tr style="padding: 0;margin: 0">
                                       <td style="text-align: left;padding: 0;margin: 0; line-height: 18px">Invoice Date</td>
                                       <td style="padding: 0;margin: 0; line-height: 18px">{{ date('m/d/Y', strtotime($Estimate->estimate_date)) }}</td>
                                   </tr>

                                   <tr style="padding: 0;margin: 0">
                                       <td style="text-align: left;padding: 0;margin: 0; line-height: 18px">Due date</td>
                                       <td style="padding: 0;margin: 0; line-height: 18px">{{ date('m/d/Y', strtotime($Estimate->due_date)) }} </td>
                                   </tr>                                   

                                </table>
                                </div>
                                
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <br><br><br> <br>
                                <b>Bill To,</b>
                                <p><b>{{$Customer->name}}</b></p>
                                <p style="margin: 0;padding: 0;line-height: 20px">Phone:{{$Customer->phone}}</p>
                                <p style="margin: 0;padding: 0;line-height: 20px">Email:{{$Customer->email}}</p>
                                

                                @if($Customer->street_address !='null' && $Customer->street_address !='')
                                  <p style="margin: 0;padding: 0;line-height: 20px">{{$Customer->street_address}}</p>
                                @endif
                                
                                @if($Customer->city !='null' && $Customer->city !='')
                                  <p style="margin: 0;padding: 0;line-height: 20px">{{$Customer->city}}</p>
                                @endif

                                @if($Customer->state !='null' && $Customer->state !='')
                                  <p style="margin: 0;padding: 0;line-height: 20px">{{$Customer->state}}</p>
                                @endif


                                @if($Customer->zip_code !='null' && $Customer->zip_code !='')
                                  <p style="margin: 0;padding: 0;line-height: 20px">{{$Customer->zip_code}}</p>
                                @endif

                                    </td>
                            
                            <td>
                               
                                
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
           
            
           
            
            <tr class="heading">
                <td style="text-align: left;">
                    Item
                </td>
                <td style="text-align: center;">
                    Quantity x Price
                </td>
                <td style="text-align: right;">
                    Amount
                </td>
            </tr>
            
            @foreach($EstimateItem as $items)
                <tr class="item">
                    <td style="text-align: left;">
                       {{$items->name}}
                    </td>
                    <td style="text-align: center;">
                       {{$items->quantity}} x {{usaCurrencyFormat($items->price)}}
                    </td>
                    <td  style="text-align: right;">
                       {{  usaCurrencyFormat($items->total)}}
                    </td>
                </tr>
            @endforeach
            
            
            <tr class="total">
                <td></td><td></td>
                <td style="text-align: right;">
                   Sub Total: {{usaCurrencyFormat($Estimate->sub_total)}}
                </td>
            </tr>
            <tr class="total">
                <td></td><td></td>
                <td style="text-align: right;">
                   Discount: {{usaCurrencyFormat($Estimate->discount_val)}}
                </td>
            </tr>
            @foreach($Estimate_tax as $tax)
           <tr class="total">
                <td></td><td></td>
                <td style="text-align: right;">
                   {{$tax->name}}({{$tax->percent}}%): {{usaCurrencyFormat($tax->tax_amount)}}
                </td>
            </tr>
           @endforeach
            <tr class="item">
                <td></td><td></td>
                <td style="text-align: right;">
                   <b>Total</b>: {{usaCurrencyFormat($Estimate->total)}}
                </td>
            </tr>


        </table>
    </div>
</body>
</html>