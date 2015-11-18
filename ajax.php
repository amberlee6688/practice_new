<!DOCTYPE html>
<html lang="zh">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>ajax</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#submit").mouseover(function(){
				$(this).css({'background':'black'});
			})
			$("#submit").mouseout(function(){
				$(this).css({'background':'#5A2626'});
			});

		});
		function userlogin(){
			var account = $('#account').val();
			var password = $('#password').val();

			//<!--判斷是否填寫-->
			if(account == "" && password == ""){
				$("#error_msg").text("Please enter your account and password.");
				//alert('1');
				//$("#account").focus();
				return false;
			}
			if(account == ""){
				$("#error_msg").text("Please enter your account.");
				//alert('2');
				$("#account").focus();
				return false;
			}
			else if(password == ""){
				$("#error_msg").text("Please enter your password.");
				//alert('3');
				$("#password").focus();
				return false;
			}

			$.ajax({
				url: "login_chk.php",
				data: "account="+account+"&password="+password,
				type: "POST",
				beforeSend: function(){
					$("#loading_div").show();
				},
				success: function(msg){
					if(msg == "success") {
						//$("#loadingsuccess_div").show();
						$("#loadingsuccess_div").text("you login successfully!");
						$("#loadingsuccess_div").fadeIn();
						$("#error_msg").hide();
						$("#login").hide();
						$("#user_logout").fadeIn();
						
					}
					else {
						$("#error_msg").show();
						$("#error_msg").html("Please Login again,<br/>沒有此用戶或密碼不正確");
					}
				},
				error: function(xhr){
					alert("ajax request error!");
				},
				complete: function(){
					$("#loading_div").hide();
					//$("#user_login").hide();
				}
			});
		}

		function userlogout(){
			$.ajax({
				url:"logout.php",
				type : "POST",
				beforeSend:function(){
					$('#loadinggout_div').show(); 
					$('#loadingsuccess_div').hide();
					$('#error_msg').text('Logout...please wait..');
					$('#user_logout').hide();
					//beforeSend 發送請求之前會執行的函式
				},
				success:function(msg){
					if(msg=="success"){
						$('#login').fadeIn(); 	
					}else
					{	
						$('#error_msg').html('請在登出一次');
					}
				},
				error:function(xhr){
					alert('Ajax request 發生錯誤');
				},
				complete:function(){
					$('#loadinggout_div').hide();
					$('#login').fadeIn(); 	
				}
			});	
		}


	</script>
	<link href="css/ajax.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="content">
		<div class="login_show">
			<form id="login" name="login" method="post">
				<p class="login_label"><label for="account">Account: </label><input type="text" id="account" name="account" placeholder="account"><p>
				<p class="login_label"><label for="password">Password: </label><input type="text" id="password" name="password" placeholder="password"></p>
				
				<p class="login_label center"><input type="button" id="submit" value="submit" onclick="userlogin();"></p>
			</form>
		</div>

		<div id="error_msg"></div>

		<form id="user_logout" name="user_logout" method="post" style="display:none;">
			<div id="showname">
				
			</div>
			<input type="button" id="logout" value="logout" onclick="userlogout();">
		</form>

		<div id="loading_div" style="display:none;">
			<img src="pic/ajax_loader.gif"><br>Login~ Please wait
		</div>

		<div id="loadinggout_div" style="display:none;">
			<img src="pic/ajax_loader.gif"><br>Logout~ Please wait
		</div>
		
		<div id="loadingsuccess_div" style="display:none;">
			
		</div>

	</div>
</body>
</html>