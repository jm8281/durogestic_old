@extends('front.common.layout')
@section('title')名家风采@stop
@section('content')
<div class="main">
    <div class="export">
        <div class="export_list clearfix">
    	        @foreach($oExpert as $k=>$v)
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
            <div class="clear"></div>
        	<div class="flip">
         	 <div class="flip_list">
	     	@if(trim($oExpert->links()))
		 	<div class="page_num_box">
		      {{$oExpert->links()}}
		    <div class="clear"></div>
	   		</div>
	    @endif 
	    </div>
      </div>
	 </div>    
   </div>
@stop
