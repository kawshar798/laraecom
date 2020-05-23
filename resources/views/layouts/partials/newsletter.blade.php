<div class="bg-primary py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col-auto flex-horizontal-center">
                            <i class="ec ec-newsletter font-size-40"></i>
                            <h2 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h2>
                        </div>
                        <div class="col my-4 my-md-0">
                            <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$20 coupon for first shopping.</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <!-- <form class="js-validate newsletter-form-submit" action="{{url('newsletter/store')}}"   id="newsletter_id" method="POST" >
                    @csrf -->
                    <form class=" newsletter-form-submit"   id="newsletter_id">
                     @csrf
                    <input type="hidden" class="success_url"   method="get" value="{{url('/')}}">
                    <input type="hidden" class="submit_url"   method="POST" value="{{url('newsletter/store')}}">
                    <input type="hidden" class="method" value="POST">
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <label class="sr-only" for="subscribeSrEmail">Email address</label>
                        <div class="input-group input-group-pill">
                            <input type="email" class="form-control border-0 height-40" name="email"  placeholder="Email address" aria-label="Email address" aria-describedby="subscribeButton" required
                                   data-msg="Please enter a valid email address.">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2">Sign Up</button>
                            </div>
                        </div>
                    </form> 
                   
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </div>