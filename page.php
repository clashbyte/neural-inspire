<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Цитаты Богдана</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="style.css">
		<meta name= "viewport" content= "width=device-width, initial-scale=1.0" >
		<script>
			$(document).ready(function(){
				setTimeout(function(){ $("#quote").removeClass("reveal") }, 100);
				setTimeout(function(){ $("#sub").removeClass("reveal") }, 700);
				//setTimeout(function(){ $("#sub, #quote").addClass("reveal") }, 15000);
				//setTimeout(function(){ document.location.reload() }, 15200);
			});
		</script>
	</head>
	<body>
		<div id="body">
			<div id="cont">
				<div id="quote" class="reveal">
				<?php
					echo Generate();
				?>
				</div>
				<div id="sub" class="reveal">
					- <?php echo GenerateSub(); ?>
				</div>
			</div>
		</div>
	</body>
</html>