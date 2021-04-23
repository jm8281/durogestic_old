function saveThumb() {
	$.ajaxFileUpload({
		url: "/adm/video/upload-video-thumb",
		secureuri: false,
		fileElementId: "upload_file",
		dataType: "json",
		data:{_token:$("#_token").val()},
		success: function(data, status) {
			if(data.success){
				$("#img_thumb").val(data.img_thumb);
				$("#thumb").attr("src", data.img_thumb);
				alert("上传成功");		
			}else{
			alert(data.msg);}
			
		}
	})
}


