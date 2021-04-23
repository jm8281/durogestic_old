@extends('adm.common.layout')
@section('title')后台首页@stop
@section('content')
<div class="app_content_div" id="app_content_div_301Index">
		<h3>专家列表</h3>
	</div>
	<div style="float:right;"><button type="button" class="btn btn-primary" onclick="window.location.href='/adm/expert/add'">新增专家</button></div>
	
	<table class="table table-striped">
      <thead>
        <tr>
          <th>id</th>
          <th>姓名</th>
          <th>职称</th>
          <th>科室</th>
          <th>医院</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
      	@foreach($oExpert as $k=>$v)
        <tr>
          <th scope="row">{{$v->id}}</th>
          <td>{{$v->name}}</td>
          <td>{{$v->title}}</td>
          <td>{{$v->department}}</td>
          <td>{{$v->hospital}}</td>
          <td>
          		<a href="/adm/expert/edit/{{$v->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></a></span>
          		&nbsp;&nbsp;&nbsp;
          		<a href="#" onclick="delUser('/adm/expert/del/{{$v->id}}')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a></span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$oExpert->links()}}
    <script>
		function delUser(url){
			if(confirm('确定要删除该专家吗？')){
				window.location.href = url;
			}
		}	
	</script>



@stop
