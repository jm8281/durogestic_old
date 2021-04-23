@extends('adm.common.layout')
@section('content')
	<div class="app_content_div" id="app_content_div_301Index">
		<h3>直播录播管理</h3>
	</div>
	<div style="float:right;"><button type="button" class="btn btn-primary" onclick="window.location.href='/adm/video/add-video'">新增视频</button></div>
	<br><br><br>
	<table class="table table-striped">
      <thead>
        <tr>
          <th>id</th>
          <th>标题</th>
          <th>科室</th>
          <th>专家</th>
          <th>类型</th>
          <th>直播开始时间</th>
          <th>直播结束时间</th>
<!--           <th>更新签到积分</th>-->
<!--           <th>试题列表</th>-->
<!--           <th>积分导出</th> -->
<!--          <th>周报导出</th>  -->
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
      	@foreach($oVideos as $k=>$v)
        <tr>
          <th scope="row">{{$v->id}}</th>
          <td>{{str_cut_cms($v->title,30)}}</td>
          <td>@if(empty($v->oDocs)==0){{$v->oDocs->department}}@endif</td>
          <td>@if(empty($v->oDocs)==0){{$v->oDocs->name}}@endif</td>
          <td>@if($v->type==1) 录播 @else 直播 @endif</td>
          <td>{{$v->start_time}}</td>
          <td>{{$v->end_time}}</td>
          <td>  
          		<a href="/adm/video/edit-video/{{$v->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
          		&nbsp;&nbsp;&nbsp;
          		<a href="#" onclick="delUser('/adm/video/del-video/{{$v->id}}')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$oVideos->links()}}
    <script>
		function delUser(url){
			if(confirm('确定要删除该条记录吗？')){
				window.location.href = url;
			}
		}	
	</script>
@stop
