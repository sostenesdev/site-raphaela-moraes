@extends('layouts.auth')

@section('content')
    						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src='{{asset("assets/img/avatars/avatar.jpg")}}' alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
                                     @if ($errors->has('email'))
                                        <div class="text-center">
                                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
									<form method="post" action='{{route("admin.login.authenticate")}}'>
                                        @csrf
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											<small>
                                                <a href="index.html">Forgot password?</a>
                                            </small>
										</div>
										<div>
											<label class="form-check">
                                                <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
                                                <span class="form-check-label">
                                                Remember me next time
                                                </span>
                                            </label>
										</div>
										<div class="text-center mt-3">
											<button type='submit' href="index.html" class="btn btn-lg btn-primary">Entrar</button>
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
										</div>
									</form>
								</div>
							</div>
						</div>

@endsection