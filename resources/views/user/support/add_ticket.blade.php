@extends('layouts.master')
@section('style')

@stop
@section('content')
    <!-- contact us area start -->
    <section class="contact-area" style="margin-bottom: 120px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="section-title">
                        <h2>@lang($pt)</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-from-wrapper">
                        <form class="contact-form" action="{{route('ticket.store')}}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="InputName">@lang('Subject')<span class="requred">:</span></label>
                                        <input type="text" class="form-control"  value="{{ old('subject') }}" name="subject"  placeholder="@lang('Subject Name')*" required>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="InputName">@lang('Detail')<span class="requred">:</span></label>
                                        <textarea class="form-control" name="detail" rows="10" required placeholder="@lang('Message...')"></textarea>
                                    </div>
                                </div>


                                <div class="col-xl-12 col-lg-12">
                                    <div class="row d-flex">
                                        <div class="col-xl-12 col-lg-12">
                                            <button type="submit" style="width: 100%" class="login-button btn-contact">@lang('Submit')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us area end -->
@endsection
@section('script')

@stop
