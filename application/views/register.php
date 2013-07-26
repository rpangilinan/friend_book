<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Friend Book</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../assets/css/bootstrap.css" rel="stylesheet">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    	<script src = "/assets/js/jquery-1.9.1.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#register').on('submit', function(){
				var form = $(this)
				$.post(form.attr('action'), form.serialize(), function(data){
					form.siblings('div.alert').remove();
					if(data.success === true){
						form.before('<div class="alert alert-success">'+ data.message +'</div>')
						window.location.href = data.location;
					}
					else{
						form.before('<div class="alert alert-error">'+ data.message +'</div>')
					}
				}, 'json')
				return false;
			});
		});
	</script>	
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<ul class="nav">
					<li><h4>Friend Book</h4></li>
				</ul>
			</div> <!-- container -->
		</div> <!-- navbar-inner -->
	</div> <!-- navbar -->

	<div class = "container">
		<h4>Register</h4>
		<form id="register" action="/users/register_user" method = "post">		
			<label>First Name:</label> <input type = "text" name = "first_name">
			<label>Last Name: </label><input type = "text" name = "last_name">
			<label>Email:</label> <input type = "text" name = "email">
			<label>Password: </label><input type = "password" name = "password">
			<p><input type = "submit" class = "btn btn-success" value = "Register"></p>
		</form>	
		
		<p>Already have an account?<a href="/users/sign_in"> Login</a></p>
	</div>
</body>
</html>