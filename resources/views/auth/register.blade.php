@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Register') }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route('register') }}">
							@csrf

							@if (isset($registered))
							<p class="text-success text-center">
                            	<strong>{{ $registered }}</strong>
                            </p>
							@endif
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

								<div class="col-md-6">
									<input id="name" type="text"
										   class="form-control @error('name') is-invalid @enderror" name="name"
										   value="{{ old('name') }}" required autocomplete="name" autofocus>

									@error('name')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="email"
									   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control @error('email') is-invalid
@enderror" :class="{'is-invalid': !emailStatus}" name="email" value="{{ old('email') }}" required
										   autocomplete="email" v-model="email">

									@error('email')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
									<span class="invalid-feedback" :class="{'visibility': validationErrors.length}"
										  role="alert" v-for="(error, id) in validationErrors" :key="id">
                                        <strong>@{{ error }}</strong>
                                    </span>
								</div>
							</div>

							<div class="form-group row">
								<label for="password"
									   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

								<div class="col-md-6">
									<input id="password" type="password"
										   class="form-control @error('password') is-invalid @enderror" name="password"
										   required autocomplete="new-password">

									@error('password')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Register') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
