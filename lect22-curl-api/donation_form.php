<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>USC Donations</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Donation Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<form action="charge.php" method="POST">

			<div class="row">
				<div id="errorMsg" class="col-sm-9 ml-sm-auto text-danger font-italic mb-3">
				</div>
			</div>

			<div class="form-group row">
				<label for="full-name-id" class="col-sm-3 col-form-label text-sm-right">Full Name: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="full-name-id" name="full-name" placeholder="Tommy Trojan">
					<small id="full-name-error" class="invalid-feedback">Name is required.</small>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="amount-id" class="col-sm-3 col-form-label text-sm-right">Amount (USD): <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="number" name="amount" id="amount-id" class="form-control" min="1" step="0.01" placeholder="100.00">
					<small id="amount-error" class="invalid-feedback">Amount is required.</small>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="card-num-id" class="col-sm-3 col-form-label text-sm-right">Card Number: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="card-num-id" name="card-num" placeholder="4242424242424242">
					<small id="card-error" class="invalid-feedback">Card number is required.</small>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="exp-month-id" class="col-sm-3 col-form-label text-sm-right">Exp Month: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select name="exp-month" id="exp-month-id" class="form-control">
						<option value="" selected disabled>- Select One -</option>
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
					<small id="exp-month-error" class="invalid-feedback">Expiration month is required.</small>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="exp-year-id" class="col-sm-3 col-form-label text-sm-right">Exp Year: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select name="exp-year" id="exp-year-id" class="form-control">
						<option value="" selected disabled>- Select One -</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
					</select>
					<small id="exp-year-error" class="invalid-feedback">Expiration year is required.</small>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="cvc-id" class="col-sm-3 col-form-label text-sm-right">CVC: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="cvc-id" name="cvc" placeholder="123">
					<small id="cvc-error" class="invalid-feedback">Security code is required.</small>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-sm-9 ml-sm-auto mt-2 text-danger font-italic">
					* Required
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-sm-9 ml-sm-auto mt-2">
					<button type="submit" class="btn btn-primary">Donate</button>
				</div>
			</div> <!-- .form-group -->

		</form>

	</div> <!-- .container -->

	<script>
		document.querySelector('#card-num-id').oninput = function(){
			if ( this.value.length > 16 ) {
				this.value = this.value.substr(0, (this.value.length-1));
			}
		}

		document.querySelector('form').oninput = function(e){
			e.srcElement.classList.remove('is-invalid');
		}

		document.querySelector('form').onsubmit = function(e){
			for (var i = 0; i < e.target.length - 1; i++) {
				if (e.target[i].value.length == 0) {
					e.target[i].classList.add('is-invalid');
				} else {
					e.target[i].classList.remove('is-invalid');
				}
			}
			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>