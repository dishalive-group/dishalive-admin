@extends("dashboard.layouts.frontend")
@section('main-section')
<div class="login">
	<div class="wrapper wrapper-login wrapper-login-full p-0">
		<div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
		    <a href="/" title="DishaLive Web Design and Solutions">
			    <img src="{{$logo}}" alt="DishaLive Logo" class="img-fluid w-50">
			</a>
			<h1 class="title fw-bold text-white mb-3">Welcome to Admin Panel</h1>
			<h3 class="fw-bold text-white mb-3">To Rock, Keep updating</h3>
			<p class="text-white op-7">We're for you with someting awesome.</p>
							
			
			</p>
			
			<p class="text-white">Developed by <a href="https://www.dishalive.com" class="link link-primary text-white">DishaLive Web Design and Solutions</a></p>
			
		</div>
		<div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
			<div class="container container-login container-transparent animated fadeIn">
				<h3 class="text-center">Sign In</h3>
				<div class="login-form">
				<form action="/login" method="POST">
                    @csrf                  
                        <input type="number" name="mobileNo" class="form-control" value="{{old('mobileNo')}}" placeholder="Enter your mobile number"><br>
                        @error('mobileNo') <span class="text-danger">{{$message}}</span> @enderror
                    
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        @error('passowrd') <span class="text-danger">{{$message}}</span> @enderror <br>
                        
                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary w-100" name='submit' value="Login" >
                                            
                        <!-- <div class="py-5">
                            <a href='#' class="float-start btn btn-info"> <i class="fa fa-key"></i> Reset Password </a>
                            <a href="#" id="show-signup" class="float-end btn btn-info"> <i class="fa fa-user-plus"></i> Register Now</a>
                        </div>                         -->
                    </form> 
				</div>
			</div>

			<div class="container container-signup container-transparent animated fadeIn">
				<h3 class="text-center">Create new account</h3>
				<div class="login-form">
					<form action="/register" method="POST">
					@csrf
						<div class="row">
							<div class="col-md-12 pb-2">
								<label>Country</label>
								<select name="country" id="country" class="form-control" required>
									<option value="">Select any one</option>
									<option value="77" data-prefix="+91">India</option>									
								</select>
							</div>
							<div class="col-4 pb-2">
								<label>Prefix</label>
								<input type="text" name="mobileNoPrefix" id="mobileNoPrefix" class="form-control" placeholder="Mobile No. Prefix" required="">
								@error('mobileNoPrefix') <span class="text-danger">{{$message}}</span> @enderror
							</div>
							<div class="col-8 pb-2">
								<label>Mobile No.</label>
								<input type="number" name="mobileNo" class="form-control" placeholder="Enter Your Mobile Number" required="" value="{{old('mobileNo')}}">
								@error('mobileNo') <span class="text-danger">{{$message}}</span> @enderror
							</div>
							<div class="col-md-12 pb-2">					
								<label>Your Name</label>
								<input type="text" name="name" class="form-control" placeholder="Enter Your Name" required="" value="{{old('name')}}">
								@error('name')<span class="text-danger">{{$message}}</span>@enderror
							</div>
							<div class="col-md-12 pb-2">
								<label>Email</label>
								<input type="email" name="email" class="form-control" placeholder="Enter your email" required="" value="{{old('email')}}">
								@error('email') <span class="text-danger">{{$message}}</span> @enderror
							</div>
							<div class="col-md-6 pb-2">
								<label>Password</label>
								<input type="password" name="password" class="form-control" placeholder="Enter new password " required="">
								@error('password') <span class="text-danger">{{$message}}</span> @enderror                        
							</div>
							<div class="col-md-6 pb-2">
								<label>Retype Password</label>
								<input type="password" name="password_confirmation" class="form-control" placeholder="Retype password " required="">
								@error('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror                        
							</div>
							<div class="col-12 pt-3">
								<input type="submit" name="submit" value="Register Now!" class="btn btn-primary w-100">
							</div>
							<div class="text-center pt-3">
								<a href="reset-password"> <i class="fa fa-key"></i> Forgot Password? Reset Now!</a> &#160; 
								<a href="#" id="show-signin"><i class="fa fa-user"></i> Login Account</a>
							</div>					
						</div>				
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	<script>
		// Add an event listener to the country dropdown
		document.getElementById('country').addEventListener('change', function () {
			// Get the selected option
			var selectedOption = this.options[this.selectedIndex];

			// Get the mobile prefix from the data attribute
			var mobilePrefix = selectedOption.getAttribute('data-prefix');

			// Populate the mobileNoPrefix input field
			document.getElementById('mobileNoPrefix').value = mobilePrefix;
		});
	</script>
@endsection