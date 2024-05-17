@extends('master')

@section('content')

<!--Hero Section-->
<div class="hero-section hero-background">
    <h1 class="page-title">Organic Fruits</h1>
</div>

<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
            <li class="nav-item"><span class="current-page">Checkout</span></li>
        </ul>
    </nav>
</div>

<div class="page-contain login-page">

    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">

            <div class="row">

                <!--Form Sign In-->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="signin-container">
                        <x-tutorial.channelName.alert />

                        <form action="{{ route('check')}}" name="frm-login" method="POST">

                            @csrf
                            <p class="form-row">
                                <label for="fid-name">Full Name<span class="requite">*</span></label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name}}" class="txt-input" disabled>
                            </p>
                            <p class="form-row">
                                <label for="fid-name">Email Address:<span class="requite">*</span></label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email}}" class="txt-input" disabled>
                            </p>
                            <p class="form-row">
                                <label for="fid-name">Country<span class="requite">*</span></label>
                                <input type="text"  name="country"  class="txt-input" required>
                            </p>
                            <p class="form-row">
                                <label for="fid-name">State<span class="requite">*</span></label>
                                <input type="text"  name="state"  class="txt-input" required>
                            </p>
                            <p class="form-row">
                                <label for="fid-name">Town<span class="requite">*</span></label>
                                <input type="text"  name="town"  class="txt-input" required>
                            </p>
                            <p class="form-row">
                                <label for="fid-name">Street<span class="requite">*</span></label>
                                <input type="text"  name="street" class="txt-input" required>
                            </p>
                            <p class="form-row">
                                <label for="fid-name">Apartment<span class="requite">*</span></label>
                                <input type="text"  name="apartment"  class="txt-input" required>
                            </p>
                            <p class="form-row">
                                <label for="fid-name">Zipcode<span class="requite">*</span></label>
                                <input type="text"  name="zipcode"  class="txt-input" required>
                            </p>

                            <p class="form-row wrap-btn">
                                <button class="btn btn-submit btn-bold" type="submit">Proceed to payment</button>
                            </p>

                        </form>
                    </div>
                </div>


            </div>

        </div>

    </div>

</div>

@endsection