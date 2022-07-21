<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<title>Welcome to Vending Machine</title>
</head>
<body>

<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          	<h1 class="display-4">WELCOME TO VENDING MACHINE</h1>
          	<p class="lead">By GINA RIZKA ALSYAH</p>
		  	<div class="content">
			<div id="page1">
				<fieldset id="radio_snack">
					<?php
						foreach ($snacks as $s) {
					?>
						<input type='radio' value='<?php echo $s['snack'] ?>' name='radio_snack'><?php echo $s['snack']." - ".$s['harga'] ?> <br>
					<?php
						}
					?>
					
				</fieldset>
				<input type="button" value="next" id="btn_next" onclick="next()">
			</div>
			<div id="page2">
				masukkan pembayaran
				<br>
				*hanya menerima pecahan 2000, 5000, 10000, 20000, 50000
				<br>
				<input type="text" name="inputbayar" />
				<input type="button" value="bayar" id="btn_bayar" onclick="nextbayar()">
				<br>
				<div style="color:red" id="feedback">
				</div>
			</div>
      	</div>
    </div>
</div>

	<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

	<script>
		$('#page2').hide();
		function next() {
			$('#page2').show();
			$('#page1').hide();
			$('#feedback').hide();
		}
		
		function nextbayar() {
			var res = $("input[name='radio_snack']:checked").val();
			var uang = $("input[name='inputbayar']").val();

			$.ajax({
				type: "POST",
				url: "index.php/welcome/bayar", 
				data: {"snack": res, "bayar": uang},
				dataType: "json",  
				cache:false,
				success: function(data){
					console.log(data)
					$('#feedback').show();
					$('#feedback').html(data);
				},
				error : function(data) {
					// console.log(data)
				}
			});
		}
	</script>
</body>
</html>
