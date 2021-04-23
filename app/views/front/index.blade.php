@extends('front.common.layout')
@section('title')首页@stop

@section('content')

<div class="main">
    	<div class="index_top clearfix">
        	<div class="index_left">
            	<div class="index_left_bg"><img src="upload/video_thumb/last_time_bg.jpg" /></div>
                <div class="index_left_body">
                @if($state==1)
                <!-- 会议直播预告，显示倒计时 -->
               <input type="hidden" id="meeting_start_time" value="{{$time}}">
                	<div id="before" class="before" >
                        <div class="last_time" >
                            <span id="time1" class="time1">00</span>
                            <span id="time2" class="time2">00</span>
                            <span id="time3" class="time3">00</span>
                            <span id="time4" class="time4">00</span>
                        </div>
                        <a class="class_href" href="javascript::nothing()"></a>
                    </div>
                    <div class="left_share">
                    	<span>分享到：</span>
                        <a href="javascript:Pop_on_wx()"><img src="assets/images/icon_weixin.jpg" /></a>
                    </div>
                    <script src="{{asset('assets/js/timer.js')}}"></script>
                @else
                	@if($state==2)
                	<!--会议进行中-->
                	<input type="hidden" id="url" value="{{$url}}">
                    <div id="meeting" class="meeting" >
                    	<a href="javascript:Pop_on_input()">
                        	<img src="assets/images/online_classing.png" />
                        </a>
                    </div> 
                    <div class="left_share">
                    	<span>分享到：</span>
                        <a href="javascript:Pop_on_wx()"><img src="assets/images/icon_weixin.jpg" /></a>
                    </div>
                    @else   
                     <!--会议结束-->
                    <div id="end" class="end_title" >会议已结束</div>
                    @endif
                @endif

                    
                </div>
            </div>
            <div class="index_right">
            	<div class="title_box">专家介绍</div>
                <div class="index_right_list">
                @foreach($oExperts as $v)
	                <div class="index_right_ship clearfix">
	                    	<div class="index_right_img">
	                        	<a href="expert/info/{{$v->id}}"><img src="{{$v->photo}}" /></a>
	                        </div>
	                        <div class="index_right_txt">
	                        	<p>专家: {{$v->name}}</p>
	                            <p>职位: {{$v->postion}}</p>
	                            <p>医院: {{$v->hospital}}</p>
	                            <p><a href="expert/info/{{$v->id}}">详细>></a></p>
	                        </div>
	                </div>
                
                @endforeach
                
                	
                    <div class="index_right_more"><a href="/expert">more+</a></div>
                </div>
            </div>
        </div>
        <div class="review">
        	<div class="title_box">精彩回顾</div>
            <div class="review_list">
                <div class="one_line clearfix">
                @foreach($oReviews as $k=>$v)             
                	<div class= "@if($k!=2) review_ship @else review_ship mar_0  @endif" >
	                        <div class="review_ship_img">
	                            <a href="/review/review-info/{{$v->id}}">
	                                <img src="{{$v->img_thumb}}" />
	                            </a>
	                        </div>
	                        <div class="review_ship_txt">
	                            <div class="review_ship_title break"><a href="/review/review-info/{{$v->id}}">{{$v->title}}</a></div>
	                            <div class="review_ship_intro clearfix">
	                                <div class="review_ship_left">
	                                    <p>主持：@if($v->GetMainExpert()==null)<a href="#">暂无</a>@else <a href="/expert/info/{{$v->GetMainExpert()->id}}">{{$v->GetMainExpert()->name}}</a>@endif</p>
	                                    <p>日期：<span class="txt_999">{{date('Y-m-d',strtotime($v->start_time))}}</span></p>
	                                </div>
	                                <div class="review_ship_right">
	                                    <a class="info_btn" href="/review/review-info/{{$v->id}}">查看详情</a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>   
	            @endforeach
                </div>     
			</div>
        </div>
    </div>
 
      <!--微信分享弹窗-->
    <div id="char_pop" class="chat_pop" style="display: none">
    	<div class="chat_pop_top"><a href="javascript:Pop_close()" class="chat_pop_close"></a></div>
        <div class="chat_pop_body">
        	<img src="{{$qrcode}}" />
            <p>使用微信扫一扫，并将网页分享给好友</p>
        </div>
    </div>
    <!-- 姓名输入弹出框 -->
        <div id="name_pop" class="export_pop" style="display:none">
    	<div class="export_pop_top">
        	<span>提示</span>
            <a href="javascript:Pop_close()" class="export_pop_close"></a>
        </div>
        <div class="export_pop_body">
        	<div>请输入您的姓名：</div>
            <div class="export_name_input"><input id="nick_name" type="text" /></div>
            <div class="export_name_submit"><input type="button" class="btn blue_btn" value="确定" onclick="join_meeting()"/></div>
        </div>
    </div>
        <!--微信引导页-->
    <div id="cover" class="phone_page" style="display: none">
	    <div class="phone_top"><img src="assets/images/top.png" /></div>
    	<div class="know"><a href="javascript:quit_pop()"><img src="assets/images/btn_bg.png" /></a></div>
    </div>






@stop
