@extends('layouts.sidebar')

@section('content')
    {{-- User data From database --}}
    <div class="content-wrapper">
        <!-- Main content -->
        {{-- <div class="container"> --}}
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-6">
                            <h6 class="card-title"><b>PRODUCT BARCODES</b></h6>
                        </div>
                        <div class="col-md-5"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($getbarcode as $code)
                            <div class="col-lg-3 col-md-4 col-sm-12 mx-4 mb-3 text-center ">
                                <div class="card" style="width:350px">
                                    <div class="card-body">
                                        {!! $code->barcode !!}
                                        <h5 class="text-center" style="padding:0.5em; margin-top:1em;">
                                            {{ $code->product_code }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}

@endsection
