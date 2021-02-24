@extends('layouts.master')
@section('style')

@stop
@section('content')
    @include('layouts.balance_show')

    <!-- contact us area start -->
    <section class="contact-area pranto-trans-aria" id="app">
        <div class="container">
            <div class="row">

                <div class="col-md-6" style="margin-bottom: 10px">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <div class="section-title">
                                <h2 style="font-size: 32px;">@lang('Profile Update')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="contact-form" method="POST" action="{{route('user.profile.update')}}" enctype="multipart/form-data">

                                @csrf
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 ">
                                        <div class="form-group">
                                            <label for="InputFirstname">@lang('Full Name')<span class="requred">*</span></label>
                                            <input type="text" class="form-control"  id="InputFirstname" placeholder="@lang('Enter Name')" value="{{Auth::user()->name}}"  name="name" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="InputMail">@lang('E-mail')<span class="requred">*</span></label>
                                            <input type="email" class="form-control"  id="InputMail" name="email" value="{{Auth::user()->email}}" placeholder="@lang('Enter Your E-mail')"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="InputUsername">@lang('Enter Mobile')<span class="requred">*</span></label>
                                            <input type="text"  class="form-control" name="mobile" value="{{Auth::user()->mobile}}" placeholder="@lang('Enter Mobile')"
                                                   required>
                                        </div>
                                    </div>


                                    <div class="col-xl-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="InputUsername">@lang('Country Name')<span class="requred">*</span></label>
                                            <input type="text"  class="form-control" name="country" value="{{Auth::user()->country}}" placeholder="@lang('Enter Country Name')"
                                                   required>
                                        </div>
                                    </div>



                                    <div class="col-xl-12 col-lg-12">
                                        <div class="row d-flex">
                                            <div class="col-md-6 offset-md-3">
                                                <button type="submit" style="width: 100%;" class="btn btn-primary btn-lg"> @lang('Update Profile')</button>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="margin-bottom: 10px">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <div class="section-title">
                                <h2 style="font-size: 32px;">@lang('Change Password')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="contact-form" id="changePAss" method="POST" action="{{route('change.password.user')}}">
                                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="InputFirstname">@lang('Old Password')<span class="requred">*</span></label>
                                            <input type="password" class="form-control" id="InputFirstname" placeholder="@lang('Enter Your Old Password')"  name="passwordold" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="InputFirstname">@lang('New Password')<span class="requred">*</span></label>
                                            <input type="password" class="form-control" id="InputFirstname" placeholder="@lang('Enter New Password')" name="password" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="InputMail">@lang('Confirm Password')<span class="requred">*</span></label>
                                            <input type="password" class="form-control" id="InputMail" name="password_confirmation" placeholder="@lang('Confirm Password')" required>
                                        </div>
                                    </div>



                                    <div class="col-xl-12 col-lg-12">
                                        <div class="row d-flex">
                                            <div class="col-md-6 offset-md-3">
                                                @if(Auth::user()->tauth == 1)
                                                    <button style="width: 100%" data-toggle="modal" data-target="#openmodal" type="button" class="login-button btn-contact"> @lang('Change Password')</button>
                                                @else
                                                    <button style="width: 100%" type="submit" class="btn btn-primary btn-lg"> @lang('Change Password')</button>
                                                @endif
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

        <div id="openmodal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang('Google Authenticator Code Verify')</h4>
                    </div>
                    <form action="#" method="POST">
                        {{csrf_field()}}
                        <div class="modal-body">

                            <div class="form-group">
                                <input type="text"  v-model="codeData.code" name="code" placeholder="Enter Google Authenticator Code">
                                <small style="color: red; text-align: center" v-if="errors !== '' && codeData.code === '' ">@{{ errors }}</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" @click.prevent="submitCode" class="btn btn-success">@lang('Verify')</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- contact us area end -->

@endsection
@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data:{
                codeData:{
                    code: ''
                },
                errors: ''
            },
            methods:{
                submitCode(){
                    var input = this.codeData;
                    axios.post('{{route('check_two_facetor')}}',input).then(function (e) {

                        if (e.data.success == true){
                            $("#changePAss").submit();
                            console.log("ok")
                        }else {
                            swal(e.data.message,"", "warning");
                        }

                    }).catch(function (error) {
                        app.errors = error.response.data.errors.code;
                    })
                }
            }


        });
    </script>
@stop
