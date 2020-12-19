@extends('layouts.app')
@section('content')

<form method="POST" action="{{route('loginuser')}}">
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 form-control-label">Email</label>
		<div class="col-sm-10">
			<input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 form-control-label">Password</label>
		<div class="col-sm-10">
			<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="password">
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-secondary">Sign in</button>
		</div>
	</div>
</form>