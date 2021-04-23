@extends('adm.common.layout')
@section('content')
<!-- 配置文件 -->
<script type="text/javascript" src="/assets/js/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/assets/js/ueditor/ueditor.all.js"></script>
<!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
<script type="text/javascript" src="/assets/js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="/assets/js/ajaxfileupload.js"></script>
<script src="/assets/js/video.js"></script>

<!-- date -->
<script src="/assets/js/DatePicker/WdatePicker.js" type="text/javascript"></script>
<link type="text/css" href="/assets/js/date/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
<link type="text/css" href="/assets/js/date/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
<script type="text/javascript" src="/assets/js/date/js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="/assets/js/date/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="/assets/js/date/js/jquery-ui-timepicker-zh-CN.js"></script>
<script type="text/javascript">
    $(function () {
        $(".ui_timepicker").datetimepicker({
            showSecond: true,
            timeFormat: 'hh:mm:ss',
            stepHour: 1,
            stepMinute: 1,
            stepSecond: 1
        })
    })
</script>
<!-- date -->

	<div class="app_content_div" id="app_content_div_301Index">
		<h3>编辑视频</h3>
	</div>
	
	<form class="form-horizontal"  method="post" action="/adm/video/edit-video-do/{{$oVideo->id}}">
	  <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
	  <div class="form-group">
	    <label for="title" class="col-sm-2 control-label"><span style="color:red;">*</span>标题</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="title" name="title" value="{{$oVideo->title}}">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="url" class="col-sm-2 control-label"><span style="color:red;">*</span>视频路径</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="url" name="url" value="{{$oVideo->url}}">
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="type" class="col-sm-2 control-label"><span style="color:red;">*</span>视频类型</label>
	    <div class="col-sm-10">
	      	<label class="radio-inline">
			  <input type="radio" name="type" id="video_type1" value="1" @if($oVideo->type==1) checked @endif> 录播
			</label>
			<label class="radio-inline">
			  <input type="radio" name="type" id="video_type2" value="0" @if($oVideo->type==0) checked @endif> 直播
			</label>
	    </div>
	  </div>
	  <div class="form-group" >
	    <label for="description" class="col-sm-2 control-label"><span style="color:red;">*</span>课程简介</label>
	    <div class="col-sm-10">
	    <script id="description" name="description" type="text/plain">{{$oVideo->description}}</script>
		<script type="text/javascript">
		    var editor = UE.getEditor('description')
		</script>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="doc_department" class="col-sm-2 control-label"><span style="color:red;">*</span>直播开始时间</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control ui_timepicker" id="start_time" name="start_time" value="{{$oVideo->start_time}}">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="doc_hospital" class="col-sm-2 control-label"><span style="color:red;">*</span>直播结束时间</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control ui_timepicker" id="end_time" name="end_time" value="{{$oVideo->end_time}}" >
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="upload_file" class="col-sm-2 control-label"><span style="color:red;">*</span>缩略图</label>
	    <div class="col-sm-10">
	    	<input  id="upload_file" name="upload_file"  type="file" onchange="saveThumb()"/>
	      	<input type="hidden" class="form-control" id="img_thumb" name="img_thumb" value="{{$oVideo->img_thumb}}" >
	      	<img style="width:320px;height:200px;" alt="" id="thumb" src="{{$oVideo->img_thumb}}"/>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="expertlist" class="col-sm-2 control-label"><span style="color:red;">*</span>关联专家</label>
	    	<div class="col-sm-10">
	    	 	<select id="expert">
        			<option value="">请选择</option>
        			@foreach($oDocs as $k=>$v)
	    			<option value="{{$k}}">{{$v}}</option>
	    			@endforeach
        		</select>
		        <button class="btn btn-default" type="button" onclick="addexpert()">添加</button> 
			    <style>
		       .expert{margin:5px;}
		        </style> 
		        <div id="expertlist" name="expertlist">
		        	@foreach($oDocsAsso as $k=>$v)
		        	<div>
		        		<input type="hidden" value="{{$k}}" name="doc_id[]">
		        		<span class="expert">{{$v}}</span>
		        		<span class="glyphicon glyphicon-remove mouse" onclick="$(this).parent().remove()"></span>
		        	</div>
		        	@endforeach
			  	</div>
	  		</div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default">确定</button>
	    </div>
	  </div>
	</form>
	<script>
function addexpert(){
	var expert = $('#expert option:selected');
	var flag = true;
	var experthtml = '';
	if(expert.val()){
		$('#expertlist').find('input').each(function(){
			if($(this).val()==expert.val()){
				flag = false;
				return false;
			}
		});
		if(flag){
			experthtml += '<div>';
			experthtml += '		<input type="hidden" value="'+expert.val()+'" name="doc_id[]">';
			experthtml += '		<span class="expert">'+expert.text()+'</span>';
			experthtml += '		<span class="glyphicon glyphicon-remove mouse" onclick="$(this).parent().remove()"></span>';
			experthtml += '</div>';
			$('#expertlist').append(experthtml);
		}else{
			alert('您已经添加过该专家了');
			return false;
		}
	}else{
		alert('请先选择一个专家');
		return false;
	}
}
</script>
@stop


