<!DOCTYPE html> 
<html> 

<?php 
	ini_set('resplay_errors',0); 
	
	if( isset( $_REQUEST['calculator'] )) 
	{ 
		$op=$_REQUEST['operator']; 
		$num1 = $_REQUEST['firstnum']; 
		$num2 = $_REQUEST['secondnum']; 
	} 
	if($op=="+") 
	{ 
		$res= $num1+$num2; 
	} 
	if($op=="-") 
	{ 
		$res= $num1-$num2; 
	} 
	if($op=="*") 
	{ 
		$res =$num1*$num2; 
	} 
	if($op=="/") 
	{ 
		$res= $num1/$num2; 
	} 
	
	if($_REQUEST['firstnum']==NULL || $_REQUEST['secondnum']==NULL) 
	{ 
		echo "<script language=javascript> alert(\"Enter values.\");</script>"; 
	} 

?> 

<head> 
	<script src= 
"https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.min.js"
			integrity= 
"sha512-iphNRh6dPbeuPGIrQbCdbBF/qcqadKWLa35YPVfMZMHBSI6PLJh1om2xCTWhpVpmUyb4IvVS9iYnnYMkleVXLA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"> 
	</script> 

	<style> 
		table { 
			border: 1px solid white; 
			margin-left: auto; 
			margin-right: auto; 
		} 

		input[type="button"] { 
			width: 88%; 
			padding: 20px 45px; 
			background-color: orange; 
			color: black; 
			font-size: 25px; 
			font-weight: bold; 
			border: none; 
			border-radius: 5px; 
		} 

		input[type="text"] { 
			padding: 20px 120px; 
			font-size: 26px; 
			font-weight: bold; 
			border: none; 
			border-radius: 8px; 
			border: 3px solid black; 
		} 
	</style> 
</head> 


<body> 
	<table id="calculator"> 
		<tr> 
			<td colspan="3"> 
				<input type="text" id="answer"> 
			</td> 
		</tr> 
		<tr> 
			<td> 
				<input type="button"
						value="AC"
						onclick="clear_input()"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="()"
						onclick="res('()')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="%"
						onclick="res('%')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="/"
						onclick="res('/')"
						onkeydown="ans(event)"> 
			</td> 
		</tr> 
		<tr> 
			<td> 
				<input type="button"
						value="7"
						onclick="res('7')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="8"
						onclick="res('8')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="9"
						onclick="res('9')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="*"
						onclick="res('*')"
						onkeydown="ans(event)"> 
			</td> 
		</tr> 

		<tr> 
			<td> 
				<input type="button"
						value="4"
						onclick="res('4')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="5"
						onclick="res('5')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="6"
						onclick="res('6')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="-"
						onclick="res('-')"
						onkeydown="ans(event)"> 
			</td> 
		</tr> 
		<tr> 

			<td> 
				<input type="button"
						value="1"
						onclick="res('1')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="2"
						onclick="res('2')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="3"
						onclick="res('3')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="+"
						onclick="res('+')"
						onkeydown="ans(event)"> 
			</td> 
		</tr> 
		<tr> 
			<td> 
				<input type="button"
						value="0"
						onclick="res('0')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="."
						onclick="res('.')"
						onkeydown="ans(event)"> 
			</td> 
			<td> 
				<input type="button"
						value="clear"
						onclick="clearfield()"
						onkeydown="ans(event)"> 
			</td> 

			<!-- calculate function call function calculate to evaluate value --> 
			<td> 
				<input type="button"
						value="="
						onclick="calculate()"> 
			</td> 
		</tr> 
	</table> 

	<script> 

		function res(val) { 
			document.getElementById("answer").value += val 
		} 
		function clearfield() { 
			let st = document.getElementById("answer").value 
			document.getElementById("answer").value = 
			st.substring(0, st.length - 1); 
		} 

		function ans(event) { 
			if (event.key == '0' || event.key == '1'
				|| event.key == '2' || event.key == '3'
				|| event.key == '4' || event.key == '5'
				|| event.key == '6' || event.key == '7'
				|| event.key == '8' || event.key == '9'
				|| event.key == '+' || event.key == '-'
				|| event.key == '*' || event.key == '/') 
				document.getElementById("answer").value += event.key; 
		} 

		var cal = document.getElementById("calculator"); 
		cal.onkeyup = function (event) { 
			if (event.keyCode === 13) { 
				console.log("Enter"); 
				let a = document.getElementById("answer").value 
				console.log(a); 
				calculate(); 
			} 
		} 

		function calculate() { 
			let a = document.getElementById("answer").value 
			let b = math.evaluate(a) 
			document.getElementById("answer").value = b 
		} 

		function clear_input() { 
			document.getElementById("answer").value = ""
		} 
	</script> 
</body> 

</html>
