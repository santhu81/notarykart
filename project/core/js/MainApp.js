Host = {
	path : null,
	host_base_path : null,
	host_path : null
}
CSession = {
	idleTime : 0
}
var MainApp = function () {
	var SetHostPaths = function () {
		var path_name = window.location.pathname.split('/')[1];
		path_name = path_name.replace("#", "");
		if (path_name == "test")
			path_name = "";
		if (path_name == "") {
			Host.host_base_path = window.location.protocol + "//" + window.location.host + "/";
			Host.host_path = window.location.protocol + "//" + window.location.host + "/RKYBII.php?CPKP=";
			if (Host.host_base_path.lastIndexOf('//') > 10)
				Host.host_base_path = Host.host_base_path.substring(0, Host.host_base_path.length - 1);
		} else {
			Host.host_base_path = window.location.protocol + "//" + window.location.host + "/" + path_name + "/";
			Host.host_path = window.location.protocol + "//" + window.location.host + "/" + path_name + "/RKYBII.php?CPKP=";
			if (Host.host_base_path.lastIndexOf('//') > 10)
				Host.host_base_path = Host.host_base_path.substring(0, Host.host_base_path.length - 1);
		}
	}
	return {
		init : function () {
			SetHostPaths();
		},
		getCookie : function (c_name) {
			if (document.cookie.length > 0) {
				c_start = document.cookie.indexOf(c_name + "=")
					if (c_start != -1) {
						c_start = c_start + c_name.length + 1
							c_end = document.cookie.indexOf(";", c_start)
							if (c_end == -1)
								c_end = document.cookie.length
									return unescape(document.cookie.substring(c_start, c_end))
					}
			}
			return "";
		},
		ValidateEmailfunction : function (mail) {
			if (empty(mail))
				return true;
			split_arr = mail.split(",");
			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			var flag = true;
			for (j = 0; j < split_arr.length; j++) {
				if (split_arr[j].match(mailformat)) {
					flag = true;
				} else
					flag = false;
			}
			return flag;
		},
	}
}
();
MainApp.init();
function AjaxErrorMessage(xhr, textStatus, errorThrown) {
	var error_msg = "";
	if (textStatus !== null) {
		error_msg = textStatus;
	} else if (errorThrown !== null) {
		error_msg = errorThrown.message;
	} else {
		error_msg = error;
	}
	alert("Request timed out!!! ");
}
function empty(mixed_var) {
	var key;
	if (mixed_var === "" || mixed_var === 0 || mixed_var == 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || typeof mixed_var === 'undefined') {
		return true;
	}
	if (typeof mixed_var == 'object') {
		for (key in mixed_var) {
			return false;
		}
		return true;
	}
	return false;
}

function isEmpty(str) {
    return (!str || 0 === str.length);
}