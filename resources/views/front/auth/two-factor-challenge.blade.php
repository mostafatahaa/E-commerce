<x-front-layout title="2FA Challenge">
    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form action="{{route('two-factor.login')}}" class="card login-form" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>2FA Challenge</h3>
                                <p>You can must enter 2FA code.</p>
                            </div>

                            @if($errors->has('code'))
                            <div class="alert alert-danger">
                                {{$errors->first('code')}}
                            </div>
                            @endif

                            <div class="form-group input-group">
                                <label for="reg-fn">2FA</label>
                                <input class="form-control" type="text" name="code" id="code">
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Recovery Code</label>
                                <input class="form-control" type="text" name="recovery_code" id="re-code">
                            </div>

                            <div class="button">
                                <button class="btn" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>