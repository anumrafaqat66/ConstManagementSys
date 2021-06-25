$(function () {
	$('.message').keypress(function (event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			sendTxtMessage($(this).val());
		}
	});


	$('.btnSend').click(function () {
		// alert('sendmessage*****');
		sendTxtMessage($('.message').val());
	});


	$('.selectVendor').click(function () {
		// console.log('i am clicked selectVendor');
		ChatSection(1);

		var receiver_id = $(this).attr('id');
		// console.log(receiver_id);
		$('#ReciverId_txt').val(receiver_id);
		$('#ReciverName_txt').html($(this).attr('title'));

		GetChatHistory(receiver_id);
	});

	$('.upload_attachmentfile').change(function () {

		DisplayMessage('<div class="spiner"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
		ScrollDown();

		var file_data = $('.upload_attachmentfile').prop('files')[0];
		var receiver_id = $('#ReciverId_txt').val();
		var form_data = new FormData();
		form_data.append('attachmentfile', file_data);
		form_data.append('type', 'Attachment');
		form_data.append('receiver_id', receiver_id);

		$.ajax({
			url: 'chat-attachment/upload',
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function (response) {

				$('.upload_attachmentfile').val('');
				GetChatHistory(receiver_id);
			},
			error: function (jqXHR, status, err) {
				// alert('Local error callback');
			}
		});

	});

	$('.ClearChat').click(function () {
		var receiver_id = $('#ReciverId_txt').val();
		$.ajax({
			//dataType : "json",
			url: 'chat-clear?receiver_id=' + receiver_id,
			success: function (data) {
				GetChatHistory(receiver_id);
			},
			error: function (jqXHR, status, err) {
				// alert('Local error callback');
			}
		});

	});



});	///end of jquery

function ViewAttachment(message_id) {
	//alert(message_id);
	/*$.ajax({
				  //dataType : "json",
					  url: 'view-chat-attachment?message_id='+message_id,
				  success:function(data)
				  {
									 
				  },
				  error: function (jqXHR, status, err) {
						 // alert('Local error callback');
				  }
				});*/
}
function ViewAttachmentImage(image_url, imageTitle) {
	$('#modelTitle').html(imageTitle);
	$('#modalImgs').attr('src', image_url);
	$('#myModalImg').modal('show');
}

function ChatSection(status) {
	//chatSection
	if (status == 0) {
		$('#chatSection :input').attr('disabled', true);
	} else {
		$('#chatSection :input').removeAttr('disabled');
	}
}
ChatSection(0);


function ScrollDown() {
	var elmnt = document.getElementById("content");
	var h = elmnt.scrollHeight;
	$('#content').animate({ scrollTop: h }, 1000);
}

window.onload = ScrollDown();

function DisplayMessage(message) {
	var Sender_Name = $('#Sender_Name').val();
	var Sender_ProfilePic = $('#Sender_ProfilePic').val();

	var str = '<div class="direct-chat-msg right">';
	str += '<div class="direct-chat-info clearfix">';
	str += '<span class="direct-chat-name pull-right">' + Sender_Name;
	str += '</span><span class="direct-chat-timestamp pull-left"></span>'; //23 Jan 2:05 pm
	str += '</div><img class="direct-chat-img" src="' + Sender_ProfilePic + '" alt="">';
	str += '<div class="direct-chat-text">' + message;
	str += '</div></div>';
	$('#dumppy').append(str);
}

function sendTxtMessage(message) {
	var messageTxt = message.trim();
	// alert('sendmessage');
	if (messageTxt != '') {
		//console.log(message);
		DisplayMessage(messageTxt);

		var receiver_id = $('#ReciverId_txt').val();
		$.ajax({
			dataType: "json",
			type: 'post',
			data: { messageTxt: messageTxt, receiver_id: receiver_id },
			url: 'send-message',
			success: function (data) {
				GetChatHistory(receiver_id)
			},
			error: function (jqXHR, status, err) {
				// alert('Local error callback');
			}
		});
		ScrollDown();
		$('.message').val('');
		$('.message').focus();
	} else {
		$('.message').focus();
	}
}

function GetChatHistory(receiver_id) {
	$.ajax({
		//dataType : "json",
		url: 'get-chat-history-vendor?receiver_id=' + receiver_id,
		success: function (data) {
			$('#dumppy').html(data);
			ScrollDown();
		},
		error: function (jqXHR, status, err) {
			// alert('Local error callback');
		}
	});
}

function exampleFunction(user_id) {
	$.ajax({
		url: 'update-notification',
		method: 'POST',
		datatype: 'json',
		data: {
			'id': user_id
		},
		success: function (data) {
			$('#notification').html(data);
		},
		async: true
	});
}

function update_activity() {
	
	$.ajax({
		url: 'update-activity',
		method: 'POST',
		datatype: 'json',
		
		success: function (data) {
			$('#notifications').html(data);
		},
		async: true
	});
}


var result = null;
function check_notification(user_id) {
	$.ajax({
		url: 'check-notification',
		method: 'POST',
		datatype: 'json',
		data: {
			'id': user_id
		},
		success: function (data) {
			result = data;
		},
		async: false
	});
}

var result_activity = null;
function check_activity() {
	$.ajax({
		url: 'check-activity',
		method: 'POST',
		datatype: 'json',
		//data: {
		//	'id': user_id
		//},
		success: function (data) {
			result_activity = data;
		},
		async: false
	});
}


setInterval(function () {
	var user_id = $('#user_id').html();
	if ($('#badge_count').html() == undefined) {

		check_notification(user_id);

		if (result != 0) {
			exampleFunction(user_id);
		}
	}
}, 3000);

setInterval(function () {
	if ($('#badge_count_activity').html() == undefined) {

		check_activity();

		if (result_activity != 0) {
			update_activity();
		}
	}
}, 3000);


