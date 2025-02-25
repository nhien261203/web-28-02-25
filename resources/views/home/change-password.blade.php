
@extends('layout')
@section('content')



    <!-- breadcrumb-area -->
    <section >
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="breadcrumb-content">
                        <h2 class="title">Change Password</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- contact-area -->
    <section class="contact-area">

       <div class="">
         <div class="contact-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="contact-content">
                            <div class="section-title mb-15">
                                <span class="sub-title">Change Your password</span>

                            </div>

                            <form  action="" method="POST">
                                @csrf
                                <div class="contact-form-wrap">



                                    <div class="form-grp">
                                        <input name="old_password" type="password" placeholder="Old Password *" required>
                                        @error('old_password')
                                            <small class="help-block">{{$message}}</small>

                                        @enderror
                                    </div>

                                    <div class="form-grp">
                                        <input name="password" type="password" placeholder="Your Password *" required>
                                        @error('password')
                                            <small class="help-block">{{$message}}</small>

                                        @enderror
                                    </div>

                                    <div class="form-grp">
                                        <input name="confirm_password" type="password" placeholder="Your Confirm Password *" required>
                                        @error('confirm_password')
                                            <small class="help-block">{{$message}}</small>

                                        @enderror
                                    </div>





                                    <button type="submit">Change</button>
                                </div>
                            </form>
                            <p class="ajax-response mb-0"></p>
                        </div>
                    </div>

                    {{-- <div class="col-lg-6">
                        <div class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96811.54759587669!2d-74.01263924803828!3d406880494567041!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25bae694479a3%3A0xb9949385da52e69e!2sBarclays%20Center!5e0!3m2!1sen!2sbd!4v1636195194646!5m2!1sen!2sbd" allowfullscreen loading="lazy"></iframe>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
       </div>
    </section>
    <!-- contact-area-end -->


@endsection

