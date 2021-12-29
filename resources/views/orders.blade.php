@extends('layouts.sidebar')

@section('content')
{{-- User data From database --}}
<div class="content-wrapper">
    <!-- Main content -->
        <div class="container-fluid">
            <!-- left column -->
            <div class="col-lg-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-success">
                        <div class="card-header border-0">
                            <div class="row">

                            <div class="col-md-6"><h6 class="card-title"><b>Orders</b></h6></div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                        <form action="{{route('orders.store')}}" method="POST">
                            @csrf
                        <div class="card-body">
                            <table class="table bg-white rounded shadow-sm  table-hover">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col" style="width: 25%">Product</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Disc (%)</th>
                                        <th scope="col">Total</th>
                                        <th scope="col"><a href="#" class="btn btn-sm btn-primary rounded-circle add_more"><i class="fa fa-plus"></i></a></th>

                                    </tr>
                                </thead>
                                <tbody class="addmoreproduct">
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="product_id[]" id="product_id" class="form-control product_id">
                                                <option value=""> Select Item</option>
                                                @foreach ($products as $product)
                                                <option data-price="{{$product->price}}" value="{{$product->id}}">{{$product->product_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[]" id="quantity" class="form-control quantity" min="0">
                                        </td>
                                        <td>
                                            <input type="number" name="price[]" id="price" class="form-control price">
                                        </td>
                                        <td>
                                            <input type="number" name="discount[]" id="discount" class="form-control discount">
                                        </td>
                                        <td>
                                            <input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount">
                                        </td>
                                        <td >
                                            <a href="#" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times"></i></a></td>
                                        </tr>
                                </tbody>
                            </table>

                            </div>
                        </div>
                    </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(27, 228, 117)">
                         <h5>Total <b class="total " >0.00</b></h5>
                        </div>
                        <div class="card-body">
                            <div class="btn-group">
                                <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark">
                                    <i class="fa fa-print" ></i>Print
                                </button>
                                <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-primary">
                                    <i class="fa fa-print" ></i>Print
                                </button>
                                <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-danger">
                                    <i class="fa fa-print" ></i>Print
                                </button>
                            </div>
                            <div class="panel">
                                <div class="row">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>
                                                <label for="">Customer Name</label>
                                                <input type="text" name="customer_name" id="" class="form-control">
                                            </td>
                                            <td>
                                                <label for="">Customer Phone</label>
                                                <input type="number" name="customer_Phone" id="" class="form-control">
                                            </td>
                                        </tr>
                                    </table>
                                    <td>Payment Method </br>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="cash" checked="checked">
                                            <label for="payment_method"> <i class="fa fa-money-bill text-success"></i>Cash  </label>
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="bank transfer" checked="checked">
                                            <label for="payment_method"> <i class="fa fa-university text-danger"></i>Bank Transfer  </label>
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="credit Card" checked="checked">
                                            <label for="payment_method"> <i class="fa fa-credit-card text-info"></i>Credit Card</label>
                                        </span>

                                    </td>
                                    <td>
                                        Payment
                                        <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                                    </td>
                                    <td>
                                        Returning Change
                                        <input type="number" name="balance" id="balance" class="form-control">
                                    </td>
                                    <hr class="mt-4">
                                    <td>
                                        <button class="btn btn-primary btm-block mt-2">Save</button>
                                    </td>
                                    <br>
                                    <div class="text-center" style="text-align: center !important">
                                        <a href="#" class="text-danger text-center"> <i class="fa fa-sign-out-alt"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                </div>
            </form>

            </div>
            </div>
        </div>
        <div class="modal">
            <div id="print">
                @include('report.receipt')
            </div>
        </div>



@endsection

@section('script')

<script>
    // it add new row to order table
    // })
    $('.add_more').on('click', function(){
        var product = $('.product_id').html();
        var numberofrow = ($('.addmoreproduct tr').length - 0) + 1;
        var tr = '<tr><td>' + numberofrow + '</td>'+
            '<td><select name="product_id[]" class=" form-control product_id">' + product + '</select></td>' +
            '<td> <input type="number" name="quantity[]" class="form-control quantity"></td>' +
            '<td> <input type="number" name="price[]" class="form-control price"></td>' +
            '<td> <input type="number" name="discount[]" class="form-control discount"></td>' +
            '<td> <input type="number" name="total_amount[]" class="form-control total_amount"></td>' +
            '<td ><a href="#" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i></a></td>';
            $('.addmoreproduct').append(tr);
    });
    // delete a row
    $('.addmoreproduct').delegate('.delete','click', function(){
        $(this).parent().parent().remove();
    });
    // i will do all the logic here
    function TotalAmount(){
        var total = 0;
        $('.total_amount').each(function(i, e){
            var amount = $(this).val() - 0;
            total += amount;
        });
        $('.total').html(total);
    }
    $('.addmoreproduct').delegate('.product_id','change', function(){
        var tr = $(this).parent().parent();
        var price = tr.find('.product_id option:selected').attr('data-price');
        tr.find('.price').val(price);
        var qty = tr.find('.quantity').val() - 0;
        var disc = tr.find('.discount').val() - 0;
        var price = tr.find('.price').val() - 0;
        var total_amount = (qty * price) - ((qty * price * disc) / 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount()
    });

    $('.addmoreproduct').delegate('.quantity, .discount', 'keyup',function(){
        var tr = $(this).parent().parent();
        var qty = tr.find('.quantity').val() - 0;
        var disc = tr.find('.discount').val() - 0;
        var price = tr.find('.price').val() - 0;
        var total_amount = (qty * price) - ((qty * price * disc) / 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount()
    });

    //balance after payment
    $('#paid_amount').keyup(function(){
        // alert(1)
        var total = $('.total').html();
        var paid_amount = $(this).val();
        var tot = paid_amount - total;
        $('#balance').val(tot);
    })

    //Print Section
    function PrintReceiptContent(el){
        var data = '<input type="button" id="printPageButton" class="printPageButton" style="display:block; width:100%; border:none; background-color:#008B8B; color:#fff; padding: 14px 28px; font-size:16px; cursor:pointer; text-align:center" value="Print Receipt" onClick="window.print()">';
        data += document.getElementById(el).innerHTML;
        myReceipt = window.open("", "myWin", "left=900, top=130, width=400, height=400");
        myReceipt.screnX = 0;
        myReceipt.screnY = 0;
        myReceipt.document.write(data);
        myReceipt.document.title = "Print Receipt";
        myReceipt.focus();
        setTimeout(() => {
            myReceipt.close();
        }, 8000);

    }

</script>
@endsection

