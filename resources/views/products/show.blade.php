@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-center">Show Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <img src="{{$product->photo}}" alt="No image" width="150" height="150">
            </div>
            <br>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>SKU:</strong>
                                {{ $product->sku }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group" id="product-stock" style="display: inline-block;">
                                <strong>Stock:</strong>
                                @if($product->stocks_count == 0)
                                    <p id="product-stock">Out of stock</p>
                                @else
                                    <p id="product-stock">{{ $product->stocks_count }}</p>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Size:</strong>
                                {{ $product->size }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                {{ $product->description }}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-center">Related products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-xs-3 col-md-3 col-sm-3 col-xl-3"
                         style="display: inline-block; margin: auto;   justify-content: center; align-items: center;">
                        <img src="{{$relatedProduct->photo}}" alt="Image" width="150" height="150">
                        <br>
                        <a href="{{route('product.show', $relatedProduct->id)}}">{{$relatedProduct->sku}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var apiurl = "{{route('product.api.update.stock', $product->id)}}";
            $.ajax({
                type: "GET",
                url: apiurl,
                datatype: "JSON",
                success: function (result) {
                    $('#product-stock').val(result);
                }
            });
        });
    </script>
@endsection
