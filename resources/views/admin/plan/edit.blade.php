@extends('admin.layout.master')
@section('body')


    <div class="row">
        @if (count($errors) > 0)

                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong class="col-md-12"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</strong>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                </div>

        @endif
        <div class="col-md-12">
            <div class="tile">

                <div class="tile-title ">

                    <a href="{{route('plan.index')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Plan
                    </a>
                    <br>
                </div>

                <div class="tile-body">

                    <form method="post" class="form-horizontal" action="{{route('plan.update', $plan->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img style="max-height: 250px" src="{{asset('assets/images/sto/'.$plan->image)}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <strong>Image</strong>
                                    <input type="file" class="form-control" style="padding:3px" name="image">
                                </div>

                                <div class="form-group col-md-6">
                                    <strong>STO Name</strong>
                                    <input type="text" class="form-control" value="{{$plan->name}}" name="name" required>
                                </div>

                                <div class="col-md-4">
                                    <strong>STO Start Date</strong>
                                    <div class="input-group">

                                        <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" value="{{$plan->start_date}}" name="start_date" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"> <i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <strong>STO End Date</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" value="{{$plan->end_date}}" name="end_date" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"> <i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <strong>Total Quantity to Sell</strong>
                                    <input type="text" class="form-control" value="{{$plan->amount}}" name="amount">
                                </div>

                                <div class="col-md-4">
                                    <strong>Price</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$plan->price}}" name="price" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"> {{$general->currency_sym}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <strong>Grow</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$plan->grow}}" name="grow" required>
                                        <div class="input-group-prepend">
                                           <span class="input-group-text">
                                               <i class="fa fa-percent"></i>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <strong>Grow After Every Time</strong>
                                    <select class="form-control" name="times">
                                        @foreach($time as $data)
                                            <option {{$plan->times == $data->time ? 'selected': ''}} value="{{$data->time}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <strong>Sold</strong>
                                    <input type="text" class="form-control" value="{{$plan->sold}}" name="sold">
                                </div>

                                <div class="form-group col-md-6">
                                    <strong>Status</strong>
                                    <select class="form-control" name="status">
                                        <option {{$plan->status == 0 ? 'selected': ''}} value="0">UPCOMING</option>
                                        <option {{$plan->status == 1 ? 'selected': ''}} value="1">RUNNING</option>
                                        <option {{$plan->status == 2 ? 'selected': ''}} value="2">COMPLETE</option>
                                    </select>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-12">

                            <button type="submit" class="btn btn-primary btn-block">Update</button>

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
