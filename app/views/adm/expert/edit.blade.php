@extends('adm.common.layout')
@section('content')
<!-- 配置文件 -->
<script type="text/javascript" src="/assets/js/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/assets/js/ueditor/ueditor.all.js"></script>
<!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
<script type="text/javascript" src="/assets/js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="/assets/js/ajaxfileupload.js"></script>
<script src="/assets/js/doc.js"></script>
	<div class="app_content_div" id="app_content_div_301Index">
		<h3>编辑专家</h3>
	</div>
	
	<form class="form-horizontal"  method="post" action="/adm/expert/edit/{{$oExpertone->id}}">
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
	  <div class="form-group">
	    <label for="name" class="col-sm-2 control-label"><span style="color:red;">*</span>姓名</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="name" name="name" value="{{$oExpertone->name}}">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="upload_file" class="col-sm-2 control-label"><span style="color:red;">*</span>缩略图</label>
	    <div class="col-sm-10">
	    	<input  id="upload_file" name="upload_file" type="file" onchange="saveThumb()"/>
	      	<input type="hidden" class="form-control" id="photo" name="photo"  value="{{$oExpertone->photo}}">
	      	<img style="width:160px;height:200px;" alt="" id="thumb" src="{{$oExpertone->photo}}"/>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="department" class="col-sm-2 control-label"><span style="color:red;">*</span>科室</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="department" name="department"  value="{{$oExpertone->department}}">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="title" class="col-sm-2 control-label"><span style="color:red;">*</span>职称</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="title" name="title" value="{{$oExpertone->title}}">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="postion" class="col-sm-2 control-label"><span style="color:red;">*</span>职务</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="postion" name="postion" value="{{$oExpertone->postion}}">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="hospital" class="col-sm-2 control-label"><span style="color:red;">*</span>医院</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="hospital" name="hospital"  value="{{$oExpertone->hospital}}">
	    </div>
	  </div>
	  <div class="form-group" >
	    <label for="description" class="col-sm-2 control-label"><span style="color:red;">*</span>简介</label>
	    <div class="col-sm-10">
	    <script id="description" name="description" type="text/plain"> {{$oExpertone->description}}</script>
		<script type="text/javascript">
		    var editor = UE.getEditor('description')
		</script>
	    </div>
	  </div>
	  <div class="form-group" >
	    <label for="description" class="col-sm-2 control-label"><span style="color:red;">*</span>接受教育</label>
	    <div class="col-sm-10">
	    <script id="education" name="education" type="text/plain"> {{$oExpertone->education}}</script>
		<script type="text/javascript">
		    var editor = UE.getEditor('education')
		</script>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default">确定</button>
	    </div>
	  </div>
	</form>

@stop


