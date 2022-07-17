var BaseLib = {
    base_Url: '',
    isInit:false,
    initLib: (url) => {
		if (url.length > 0) {
			BaseLib.base_Url = url;
			BaseLib.isInit = true;
			console.log("init finish",BaseLib.base_Url);
		}
	},
    Post: (url, postData) => {
		console.log(BaseLib.base_Url + url);
		return new Promise((reslove, reject) => {
			$.ajax({
				type: "POST",
				url: BaseLib.base_Url + url,
				dataType: "json",
				data:postData,
				processData: false,
				contentType : false,
			})
			.done((res) => reslove(res))
			.fail((err) => reject(err));
		});
	},
    Get:(url)=>{
		return new Promise((reslove, reject) => {
			$.ajax({
				type: "GET",
				url: BaseLib.base_Url + url,
				dataType: "json",
				processData: false,
				contentType : false,
			})
			.done((res) => reslove(res))
			.fail((err) => reject(err));
		});
    },
	GetGoogle:(url)=>{
		return new Promise((reslove, reject) => {
			$.ajax({
				type: "GET",
				url: url,
				dataType: "json",
				processData: false,
				contentType : false,
			})
			.done((res) => reslove(res))
			.fail((err) => reject(err));
		});
    },
	ResponseCheck:(responseData)=>{
		if(responseData.status == "success"){
			return Swal.fire(
				'成功!',
				responseData.message,
				'success'
			)
		}else if(responseData.status == "fail"){
			return Swal.fire(
				'失敗!',
				responseData.message,
				'info'
			)
		}else{
			return Swal.fire(
				'錯誤!',
				"請聯絡系統管理員",
				'danger'
			)
		}
	},

}