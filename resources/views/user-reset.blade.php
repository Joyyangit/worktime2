@extends('layouts.dashboard')
@section('title', '成员管理')

@section('main')

<div class="row">
	<div class="col-md-4 col-md-offset-1">
@if (count($errors) > 0)
<div class="alert alert-danger">
	<p><strong>Whoops!</strong> There were some problems with your input.</p>
	<p></p>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<form method="post" action="/user/update/{{ $user->id }}" autocomplete="off">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
		<input readonly type="email" class="form-control" value="{{ $user->email }}">
    </div>
</div>
<div class="form-group">
    <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input class="form-control" type="text" name="name" value="{{ $user->name }}" />
    </div>
</div>
<div class="form-group">
    <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        <input class="form-control" placeholder="密码" type="password" name="password" />
    </div>
</div>
<div class="form-group">
    <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        <input class="form-control" placeholder="确认密码" type="password" name="password_confirmation" />
    </div>
</div>

<div class="form-group">
    <button class="btn btn-danger btn-lg btn-block" type="submit" id="loginBtn">提交修改</button>
</div>

</form>


</div></div>


@stop
