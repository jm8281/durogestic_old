@extends('front.common.layout')
@section('title')往期视频-详情@stop
@section('content')
 <script src="{{asset('assets/js/jquery.js')}}"></script>
 <script src="{{asset('assets/js/blockui/jquery.blockUI.js')}}"></script>
 <script src="{{asset('assets/js/pop_on.js')}}"></script>
 <script type="text/javascript" src="/assets/js/player/ckplayer/ckplayer.js" charset="utf-8"></script> 
  <div class="main">
    	<div class="past_top clearfix">
        	<div class="past_left">
            	<div class="past_left_title">{{$oVideo->title}}</div>
                
                <div class="past_left_video" id="plat">
                </div>
                <div class="online_class_share">
                    <span>分享到：</span>          
                      <a href="javascript:void(0);" onclick="Pop_on_wx()"><img src="/upload/video_thumb/icon_weixin.jpg" /></a>                
                     
                </div>
            </div>
            <div class="past_right">
            	<div class="past_intro">
                	<div class="title_box">本期简介</div>
                    <div class="past_intro_body">
                    	<p>{{$oVideo->description}}</p>
                    </div>
                </div>
                @if($oVideoOther)
                <div class="past_other">
                  <div class="past_other_title">其他讲堂</div>
                    <div class="past_other_list">
                    	<div class="past_other_ship">
                        	<a href="/review/review-info/{{$oVideoOther->id}}">
                        	    @if(trim($oVideoOther->img_thumb))                               
                                  <img  src="{{$oVideoOther->img_thumb}}" />
                                @else
                                  <img src="/upload/video_thumb/default.jpg"/>
                                @endif 
                            </a>                       	
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="past_export">
            <div class="title_box">本期嘉宾</div>
            <div class="export_this_list">
                @if($oVideo->experts)
                 @foreach($oVideo->experts as $v)
                   <div class="export_this_ship clearfix">
                		<div class="left_export"><img src="{{$v->photo}}" /></div>
                		<div class="right_export">                    
	                        <div class="export_base">
	                            <p class="name">{{$v->name}} 教授  </p>
	                            <p><b>科室：</b>{{$v->department}}</p>
	                            <p><b>职称：</b> {{$v->title}}</p>
	                        </div>
	                        <div class="export_this_intro">
	                            <p>{{$v->description}}</p>
	                            <div class="export_edu clearfix">
	                                <div class="edu_title">接受教育：</div>
	                                <div class="edu_info">
	                                   <p>{{$v->education}}<a href="/expert/info/{{$v->id}}">【详情】</a></p>
	                                </div>
	                            </div>
	                        </div>
                    </div>						
					</div>
				 @endforeach
               @endif
			</div>
        </div>
    </div>
    
<script type="text/javascript">	
		var flashvars={
			f:  '{{$oVideo->url}}',   
			c:0,
			p:2,
		    b:1,
		   // loaded:'loadedHandler'
		};
		var video = ['{{$oVideo->url}}'];	
		CKobject.embed('/assets/js/player/ckplayer/ckplayer.swf','plat','ckplayer_a1','548','329',false,flashvars,video);
</script>
 
   <!--微信分享弹窗-->
    <div id="char_pop" class="chat_pop" style="display:none">
    	<div id="char_close" class="chat_pop_top"><a href="javascript:Pop_close()" class="chat_pop_close"></a></div>
        <div class="chat_pop_body">
        	<img src="{{$oVideo->d2bar}}"></img>
            <p>使用微信扫一扫，并将网页分享给好友</p>
        </div>
    </div>
   <!-- 微信引导页 -->
    <div id="cover" class="phone_page" style="display:none">
    	<div class="phone_top"><img src="/assets/images/top.png"/></div>
    	<div class="know"><a href="javascript:quit_pop()"> <img src="/assets/images/btn_bg.png"/></a></div>
    </div>
@stop
            
