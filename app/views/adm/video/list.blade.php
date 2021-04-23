@extends('adm.common.layout')
@section('title')后台直播/录播管理@stop
@section('content')
<div>
<select id="expert">
<option value="">请选择</option>
<option value="1">张三</option>
<option value="2">李四</option>
<option value="3">王五</option>
<option value="4">赵六</option>
</select>
<button class="btn btn-default" type="button" onclick="addexpert()">添加</button>
</div>
<style>
.expert{margin:5px;}
</style>
<div id="expertlist">
	
</div>
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
