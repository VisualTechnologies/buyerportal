@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Import Products</div>

                <div class="panel-body">
                    <form action="{{ route("product.importSave") }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}



                        <div class="form-group{{ $errors->has('seller') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Seller</label>
                            <div class="col-md-6">
                                <select name="seller" class="form-control">
                                    @foreach ($sellers as $seller)
                                        <option value="{{ $seller->id }}">{{ $seller->company }} - {{ $seller->first_name }} {{ $seller->last_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('seller'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seller') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('importFile') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">CSV File</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="importFile"/>
                                @if ($errors->has('importFile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('importFile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" value="Save"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection