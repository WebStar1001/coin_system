@extends('admin.layout.master')
@section('body')
    <div class="row">

        <div class="col-md-12">
            <div class="tile">

                <div class="tile-title">
                    <a href="{{route('plan.index')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All STO
                    </a>
                    <br>
                </div>

                <div class="tile-body">

                    <form method="post" class="form-horizontal" action="{{route('plan.store')}}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <strong>Image</strong>
                                    <input type="file" class="form-control" style="padding:3px" name="image" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <strong>STO Name</strong>
                                    <input type="text" class="form-control" name="name" required>
                                </div>

                                <div class="col-md-4">
                                    <strong>STO Start Date</strong>
                                    <div class="input-group">

                                        <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off"  name="start_date" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"> <i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <strong>STO End Date</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off"  name="end_date" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"> <i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <strong>Total Quantity to Sell</strong>
                                    <input type="text" class="form-control" name="amount">
                                </div>

                                <div class="col-md-3">
                                    <strong>Price</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="price" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"> {{$general->currency_sym}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <strong>Grow</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="grow" required>
                                        <div class="input-group-prepend">
                                           <span class="input-group-text">
                                               <i class="fa fa-percent"></i>
                                           </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <strong>Grow After Every Time</strong>
                                    <select class="form-control" name="times">
                                        @foreach($time as $data)
                                            <option value="{{$data->time}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <strong>Status:</strong>
                                    <select class="form-control" name="status">
                                        <option value="0">UPCOMING</option>
                                        <option value="1">RUNNING</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        $(function() {
            $( ".datepicker" ).datepicker();
        });
    </script>
@stop
