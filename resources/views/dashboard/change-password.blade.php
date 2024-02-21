@extends("dashboard.layouts.main")
@push("meta")
    <title>Dashboard | MyDL.in</title>
@endpush
@section("main-section")

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center">
					<h4 class="card-title">Change Password</h4>					
				</div>
			</div>
			<div class="card-body">
				@if (session('errorMsg'))
					<div class="alert alert-danger">
						{{ session('errorMsg') }}
					</div>
				@endif

				<form method="POST" action="/change-password">
					@csrf

					<div class="form-group row">
						<label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

						<div class="col-md-6">
							<input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="old-password">

							@error('old_password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mt-2">
						<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mt-2">
						<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

						<div class="col-md-6">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
					</div>

					<div class="form-group row mb-0 mt-2">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Change Password') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>

@endsection