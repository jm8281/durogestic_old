function saveThumb() {
	$.ajaxFileUpload({
		url: "/adm/expert/upload-doc-thumb",
		secureuri: false,
		fileElementId: "upload_file",
		dataType: "json",
		data:{_token:$("#_token").val()},
		success: function(data, status) {
			if(data.success){
			$("#photo").val(data.photo);
			$("#thumb").attr("src", data.photo);
			alert("上传成功");
		}else{
			alert(data.msg);}
		}
	})
}