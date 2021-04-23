@extends('front.common.layout')
@section('title')往期视频@stop
@section('content')

<div class="main">
    	<div class="past_video">
        	<div class="past_video_list">
              @if($oVideos)            	
            	@foreach($oVideos as $k=>$v)          	
            		 @if($k%3==0)
            			 <div class="one_line clearfix">
            		 @endif
		           	 @if($k%3==2)
		            	 <div class="review_ship mar_0">
		     		 @else 
		     		 <div class="review_ship">
		             @endif
                        <div class="review_ship_img">
                            <a href="/review/review-info/{{$v->id}}">
                                @if(trim($v->img_thumb))                               
                                	<img  src="{{$v->img_thumb}}" />
                                @else
                                	<img src="/upload/video_thumb/default.jpg"/>
                                @endif
                            </a>
                        </div>
                        <div class="review_ship_txt">
                            <div class="review_ship_title break"><a href="/review/review-info/{{$v->id}}">{{$v->title}}</a></div>
                            <div class="review_ship_intro clearfix">
                                <div class="review_ship_left">
                                    <p>主持：@if($v->expertinfo) <a href="/expert/info/{{$v->expertinfo->id}}">{{$v->expertinfo->name}}</a>  @else <a href="#">暂无 </a> @endif</p>
                           
                                    <p>日期：<span class="txt_999">{{substr($v->end_time,0,10)}}</span></p>
                                </div>
                                <div class="review_ship_right">                                 
                                    <a class="info_btn" href="/review/review-info/{{$v->id}}">查看详情</a>
                                </div>
                            </div>
                        </div>                    
                 	@if($k%3==2)
		            	</div></div>
		     		@else 
		     			 </div>
		            @endif		                 			
			 @endforeach
			@endif
			<div class="clear"></div>
			@if(trim($oVideos->links()))	
             <div class="flip">  
            	<div class="flip_list">
          		 {{$oVideos->links()}} 
               </div>
            </div>
           @endif           
    </div> 
   </div>
  </div>       
@stop
