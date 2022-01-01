<div>

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
                            <div class="card-body">
                                <div class="my-2">
                                    <form wire:submit.prevent="InsertIntoCart">
                                    <input type="text" wire:model="product_code" name="" id="" class="form-control "
                                    placeholder="Enter Product Code">
                                    </form>
                                </div>
                                {{-- <div class="alert alert-success">{{$message}}</div> --}}
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{session('success')}}
                                    </div>
                                @elseif (session()->has('info'))
                                <div class="alert alert-info">
                                    {{session('info')}}
                                </div>
                                @elseif (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{session('error')}}
                                </div>

                                @endif
                                <table class="table bg-white rounded shadow-sm  table-hover">
                                    <thead class="table-success">
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col" style="width: 25%">Product</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Disc (%)</th>
                                            <th scope="col">Total</th>
                                            <th scope="col"></th>

                                        </tr>
                                    </thead>
                                    <tbody class="addmoreproduct">
                                        @foreach ($productInCart as $key=> $cart)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td width="30%">
                                               <input type="text" name="" id="" class="form-control" value="{{$cart->product->product_name}}">
                                            </td>
                                            <td width="15%">
                                                <div class="row">
                                                    <div class="col-md-2 mx-2 ">
                                                        <button wire:click.prevent="InrementQty({{$cart->id}})" type="button" class="btn btn-sm btn-success"> + </button>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="">{{$cart->product_qty}}</label>
                                                    </div>
                                                    <div class="col-md-2 ">
                                                        <button wire:click.prevent="DecrementQty({{$cart->id}})" type="button" class="btn btn-sm btn-danger"> - </button>
                                                    </div>
                                                </div>
                                                {{-- <input type="number" name="quantity[]"  id="quantity" value="" class="form-control quantity"  min="0"> --}}
                                            </td>
                                            <td>
                                                <input type="number" name="price[]" id="price" class="form-control price" value="{{$cart->product_price}}">
                                            </td>
                                            <td>
                                                <input type="number" name="discount[]" id="discount" class="form-control discount">
                                            </td>
                                            <td>
                                                <input type="number" name="total_amount[]" value="{{$cart->product_qty * $cart->product_price}}" id="total_amount" class="form-control total_amount" >
                                            </td>
                                            <td >
                                                <a href="#" class="btn btn-sm btn-danger rounded-circle" wire:click="removeProduct({{$cart->id}})"><i class="fa fa-times"></i></a>
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                </div>
                            </div>
                        </div>




                    {{-- add this form into datanbase --}}





                    <div class="col-md-4">

                        <div class="card">
                            <div class="card-header" style="background-color: rgb(27, 228, 117)">
                             <h5>Total <b class="total1 " >{{$productInCart->sum('product_total')}}</b></h5>
                            </div>
                            <div class="card-body">
                                <div class="btn-group">

                                    <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-primary mb-2">
                                        <i class="fa fa-print" ></i>Print
                                    </button>

                                </div>
                                <form action="{{route('orders.store')}}" method="POST">
                                    @csrf
                                    @foreach ($productInCart as $key=> $cart)
                                    <input type="hidden" name="product_id[]" id="" class="form-control" value="{{$cart->product->id}}">
                                        <input type="hidden" name="quantity[]"  id="quantity" value="{{$cart->product_qty}}" class="form-control"  >
                                        <input type="hidden" name="price[]" id="price" class="form-control price" value="{{$cart->product_price}}">
                                        <input type="hidden" name="discount[]" id="discount" class="form-control ">
                                        <input type="hidden" name="total_amount[]" value="{{$cart->product_total}}" id="total_amount" class="form-control total_amount" >
                                    @endforeach
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
                                                    <input type="text" name="customer_Phone" id="" class="form-control">
                                                </td>
                                            </tr>
                                        </table>
                                        <td>Payment Method
                                            <span class="radio-item">
                                                <input type="radio" name="payment_method" id="payment_method" class="true" value="cash" checked>
                                                <label for="payment_method"> <i class="fa fa-money-bill text-success"></i>Cash  </label>
                                                <input type="radio" name="payment_method" id="payment_method" class="true" value="bank transfer" >
                                                <label for="payment_method"> <i class="fa fa-university text-danger"></i>Bank Transfer  </label>
                                                <input type="radio" name="payment_method" id="payment_method" class="true" value="credit Card">
                                                <label for="payment_method"> <i class="fa fa-credit-card text-info"></i>Credit Card</label>
                                            </span>

                                        </td>
                                        <td>
                                            Payment
                                            <input type="number" wire:model="pay_money" name="paid_amount" id="paid_amount" class="form-control">
                                        </td>
                                        <td>
                                            Returning Change
                                            <input type="number" wire:model="balance" name="balance" id="balance" class="form-control">
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
</div>



</div>
