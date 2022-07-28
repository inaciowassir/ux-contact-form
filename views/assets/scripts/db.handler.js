$(document).ready(function() 
{
	
	//funtion to validate name
	function validateName()
	{
		let nameformat = /^[a-zA-Z\s]{3,100}$/;
		if(document.getElementById("name").value.match(nameformat))
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	//funtion to validate email
	function validateEmail()
	{
		let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(document.getElementById("email").value.match(mailformat))
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	//funtion to validate message
	function validateMessage()
	{
		let messageformat = /^[a-zA-Z0-9\s]{3,}$/;
		if(document.getElementById("message").value.match(messageformat))
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	$(document).on("click", ".j_create_record", function(e) 
	{
		e.preventDefault();

		let _this 				= $(this);		
		let _createurl 			= _this.data("createurl");
		let _responseurl 		= _this.data("responseurl");
		let _waitmessage 		= _this.data("waitmessage");

		$.ajax({
			url: _createurl,
			method: "POST",
			dataType: "JSON",
			success: function(response) 
			{
				if (response.status == "success") 
				{
					let url = _responseurl + "/" + response.id;
					$(location).attr("href", url);					
				}
			},
			beforeSend: function() 
			{
				_this.text(_waitmessage).addClass("disabled");
			}
		})
	});
	
	$(document).on("click", ".j_save_record", function(e) 
	{
		e.preventDefault();
		
		if(!validateName())
		{
			alert("Your name must contain at least 3 characters, no numbers and special characters");
			return false;
		}
		
		if(!validateEmail())
		{
			alert("Invalid email informed");
			return false;
		}
		
		if(!validateMessage())
		{
			alert("Your message must contain at least 3 characters and no special characters");
			return false;
		}

		let _this 		= $(this);		
		let _form		= _this.data("form");	
		let _saveurl 	= _this.data("saveurl");
		let _titlemsg 	= _this.data("titlemsg");		
		let _successmsg = _this.data("successmsg");
		let _failedmsg 	= _this.data("failedmsg");	
		let _waitmessage 		= _this.data("waitmessage");
		let _responseurl 		= _this.data("responseurl");		
		
		let data 		= $("form[name='"+_form+"']").serialize();

		$.ajax({
			url		: _saveurl,
			method	: "POST",
			dataType: "JSON",
			data	: data,
			success	: function(response) 
			{
				if (response.status == "success") 
				{
					Swal.fire({
						icon: "success",
						title: _titlemsg,
						text: _successmsg,
					});
				
					$(location).attr("href", _responseurl);
				}
				
				if(response.status == "failed")
				{
					Swal.fire({
						icon: "error",
						title: _titlemsg,
						text: _failedmsg,
					});
				}
			},
			complete	: function()
			{
				
			},
			beforeSend	: function() 
			{
				_this.text(_waitmessage).addClass("disabled");
			}
		})
	});
	
	$(document).on("click", ".j_remove_record", function(e) 
	{
		e.preventDefault();

		let _this 		= $(this);
		let _id			= _this.data("id");
		let _removeurl 	= _this.data("removeurl");
		let _titlemsg 	= _this.data("titlemsg");	
		let _confirmmsg = _this.data("confirmmsg");		
		let _successmsg = _this.data("successmsg");
		let _failedmsg 	= _this.data("failedmsg");
		
		Swal.fire(
		{
			title: _titlemsg,
			text: _confirmmsg,
			icon: "question",
			confirmButtonColor:"#DD6B55",
			confirmButtonText:"Yes, Remove",
			showCancelButton:true,
		}).then((result) => {
			if(result.value === true)
			{
				$.ajax({
					url		: _removeurl,
					method	: "DELETE",
					dataType: "JSON",
					data	: {},
					success	: function(response) 
					{
						if (response.status == "success") 
						{
							Swal.fire({
								icon: "success",
								title: _titlemsg,
								text: _successmsg,
							});
						}
						
						if(response.status == "failed")
						{
							Swal.fire({
								icon: "error",
								title: _titlemsg,
								text: _failedmsg,
							});
						}
					},
					complete	: function()
					{
						_this.parent().parent().fadeOut("fast");
					},
					beforeSend	: function() 
					{
						_this.addClass("disabled");
					}
				});				
			}
		});
	});
});