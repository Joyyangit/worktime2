@extends('app')

@section('body')


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

<form method="post" action="/auth/login" autocomplete="off">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        <input class="form-control" placeholder="邮箱" type="email" name="email" />
    </div>
</div>
<div class="form-group">
    <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        <input class="form-control" placeholder="密码" type="password" name="password" />
    </div>
</div>

<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="remember"> 记住我
        </label>
    </div>
</div>

<div class="form-group">
    <button class="btn btn-success btn-lg btn-block" type="submit" id="loginBtn">登录</button>
</div>

</form>

<hr />
<a href="/auth/register" class="btn btn-default btn-lg btn-block">没有帐号，去注册</a>


@endsection
