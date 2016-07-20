@extends('layouts.plane')

@section('body')
<a name="top"></a>
<h3>Work time</h3>
<hr />
<div class="row">

  <div class="col-lg-2">

<div class="list-group">
  <a href="/task/index" class="list-group-item{{ Request::is('task/*') || Request::is('/') ? ' active' : '' }}">任务清单</a>
  <a href="/tag/index" class="list-group-item{{ Request::is('tag/*') ? ' active' : '' }}">标签/版本</a>
  <a href="/user/index" class="list-group-item{{ Request::is('user/*') ? ' active' : '' }}">成员</a>
  <a target="_blank" href="http://www.chiark.greenend.org.uk/~sgtatham/bugs-cn.html" class="list-group-item">如何报告BUG</a>
</div>

<div class="list-group">
  <a href="/task/ido" class="list-group-item">分配给我</a>
  <a href="/task/icommit" class="list-group-item">我的作品</a>
  <a href="/user/edit/{{Auth::user()->id}}" class="list-group-item">修改密码</a>
  <a href="{{ url ('auth/logout') }}" class="list-group-item">退出</a>
</div>


</div>
<div class="col-lg-10">
@yield('main')
</div>

</div>

@stop
