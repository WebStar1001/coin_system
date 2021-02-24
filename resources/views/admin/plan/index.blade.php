@extends('admin.layout.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">STO Section Title</h3>
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('general.store')}}">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label><strong>Title</strong></label>
                                <input type="text" name="plan_title" class="form-control" value="{{$general->plan_title}}">
                            </div>

                            <div class="form-group">
                                <label><strong>Sub-Title</strong></label>
                                <input type="text" name="plan_subtitle" class="form-control" value="{{$general->plan_subtitle}}">
                            </div>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong class="col-md-12"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</strong>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="tile">
                <div class="tile-body">
                    <div class="table">

                        <div class="caption font-dark pull-right">
                            <i class="icon-settings font-dark"></i>
                            <a href="{{route('plan.create')}}" class="btn btn-primary bold"><i class="fa fa-plus"></i> Add New </a>
                        </div>

                        <br>
                        <br>

                        <div class="row">
                            @foreach($plan as $data)
                                <div class="col-md-4">
                                    <div class="tile">
                                        <div class="card text-center">
                                            <div class="card-header">
                                                <h3>{{$data->name}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <img style="max-width: 180px" src="{{asset('assets/images/sto/'.$data->image)}}">
                                                            </li>
                                                            <li class="list-group-item">Start Date : {{$data->start_date}}</li>
                                                            <li class="list-group-item">End Date : {{$data->end_date}}</li>
                                                            <li class="list-group-item">Total Amount To Sell : {{$data->amount}}</li>
                                                            <li class="list-group-item">Price : {{$data->price}} {{$general->currency}}</li>
                                                            <li class="list-group-item">Grow : {{$data->grow}}%</li>
                                                            <li class="list-group-item">Period : {{$data->times}} Hours After</li>
                                                            <li class="list-group-item">Sold : {{$data->sold}}</li>
                                                            <li class="list-group-item">
                                                                Sold: {{round(($data->sold/$data->amount)*100, 2)}}%
                                                                <div class="progress" style="margin: 10px">
                                                                    <div class="progress-bar" role="progressbar" style="width: {{round(($data->sold/$data->amount)*100, 2)}}%" aria-valuenow="{{round(($data->sold/$data->amount)*100, 2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item">Available : {{$data->amount - $data->sold}}</li>

                                                            <li class="list-group-item"> Status:
                                                                @if($data->status == 1)
                                                                    <h4>Running</h4>
                                                                    <img style="width: 30px;" src="{{asset('assets/images/coming.gif')}}">
                                                                @elseif($data->status == 2)
                                                                    <h4>Complete</h4>
                                                                @else
                                                                    <h4>Upcoming</h4>
                                                                    <img style="width: 30px;" src="{{asset('assets/images/load.gif')}}">
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="{{route('plan.edit',$data->id)}}" class="btn btn-primary btn-block">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

@stop
