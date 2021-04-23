@extends('front.common.layout')
@section('title')名家风采-详情@stop
@section('content')
  <div class="main">
    	<div class="export_info">
        	<div class="export_this">
            	<div class="title_box">本期嘉宾</div>
                <div class="export_this_body clearfix">
                	<div class="left_export"><img src="{{$oExpert->photo}}" /></div>
                    <div class="right_export">
                    	<div class="export_base">
                        	<p class="name">{{$oExpert->name}}</p>
                            <p><b>科室：</b>{{$oExpert->department}}</p>
                            <p><b>职称：</b>{{$oExpert->title}}</p>
                        </div>
                        <div class="export_this_intro">
                        	<p>{{$oExpert->description}}</p>
                            <div class="export_edu clearfix">
                            	<div class="edu_title">接受教育：</div>
                                <div class="edu_info">
                                	<p>{{$oExpert->education}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($oVideoExpert)
            <div class="this_intro">
				<div class="title_box">本期简介</div>    
                <div class="this_intro_body">
                    <p class="te_2">{{$oVideoExpert->description}}</p>
				</div>
            </div>
               @if($oOtherExperts) 
            <div class="other_export">
            	<div class="title_box">其他专家</div>
                <div class="export_list clearfix">
                 @foreach( $oOtherExperts as $k=>$v)
    	        <div class="export_ship @if($k%3 == 2)mar_0 @endif">    
	   	        <div class="export_ship_img">
                <a href="/expert/info/{{$v->id}}"><img src="{{$v->photo}}" /></a>
            	</div>
            	<div class="export_ship_txt">
                <p>专家: {{$v->name}}</p>
                <p>职位: {{$v->postion}}</p>
                <p>科室: {{$v->department}}</p>
                <p>医院: {{$v->hospital}}</p>
           	    </div>
           	   </div>
		        @endforeach
                </div>
            </div>
           @endif
         @endif
    </div>   
</div>    
@stop
