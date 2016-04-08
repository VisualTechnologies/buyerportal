@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Products
                    <a href="{{ route("product.import") }}" class="pull-right"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span></a>
                </div>

                <div class="panel-body">
                    <div id="filters">
                        <div class="form-group{{ $errors->has('seller') ? ' has-error' : '' }} clearfix">
                            <label class="col-md-4 control-label">Filter by Supplier</label>
                            <div class="col-md-6">
                                <select name="seller" id="seller" class="form-control">
                                    <option value="">Show all sellers</option>
                                    @foreach ($user->sellers as $s)
                                        <option value="{{ $s->id }}" @if ($s->id == $seller_id) selected @endif >{{ $s->company }} - {{ $s->first_name }} {{ $s->last_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('seller'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('seller') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (count($products))
                        <table class="table">
                            <thead>
                            <tr>
                                <th><a href="{{ route("product.create") }}" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></th>
                                <td><!-- image --></td>
                                @foreach ($fields as $field=>$label)
                                    <th>{{ $label }}</th>
                                @endforeach
                                <th>Supplier</th>
                                <th></th>
                            </tr>
                            </thead>

                        @foreach ($products as $product)
                            <tr>
                                <td><a href="{{ route("product.edit", ['product' => $product->product_id]) }}" class="pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                                <td><img src="{{ $product->getThumbnail() }}"/></td>
                                @foreach ($fields as $field=>$label)
                                    <td>{{ $product->$field }}</td>
                                @endforeach

                                <td>{{ $product->seller->company }}</td>
                                <td><a href="{{ route("product.delete", ['product' => $product->product_id]) }}" class="pull-right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                            </tr>
                        @endforeach
                        </table>
                    @else
                        No Products Found<br>
                        <a href="{{ route("product.create") }}" class=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> click here to add new product. </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(function(){
            $("#seller").on("change", function(e) {
                var seller = $(this).val();
                var url = "/product/seller/" + seller;
                if (seller != "") {
                    window.location.href = url;
                }
                else {
                    window.location.href = "/product";
                }

            });
        });

    </script>
@endsection
