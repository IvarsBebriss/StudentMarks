<?php
session_start();
include 'funkcijas.php';
include 'layout.php';

$clients = getData('clients','name');

if (isset($_POST['save'])){
	updateId('invoices',['client_id'=>$_POST['client_id'], 'date'=>$_POST['date'], 'sum'=>floatval($_POST['sum'])], $_POST['id']);
}

if (isset($_POST['list']['delete'])){
	foreach ($_POST['list']['delete'] as $key=>$row){
		deleteId('invoices_items', $key, $redirect='invoices_edit.php?id='.$_POST['id']);
	}
}

if (isset($_POST['add'])){
	saveData('invoices_items', ['invoice_id'=>$_POST['id'], 'product_id'=>$_POST['product_id'], 'quantity'=>floatval($_POST['quantity'])], $redirect='invoices_edit.php?id='.$_POST['id']);
}

$products = getData('products','name');

$result = getDataById('invoices',$_GET['id']);

$items = getItems($_GET['id']);

$sum = 0;
$counter = 0;
if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}

ob_start();

include 'list_of_items.php';

$output = ob_get_clean();

	
if ($result):?>

<div class="form-group mt-3">
	<a href="invoices.php" class="btn btn-outline-secondary">Atpakaļ</a>
</div>
<form method="post" id="invoice_form">
	<fieldset>
		<legend>Rēķina labošana</legend>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Klients</label>
			<div class="col-sm-5">
				<select class="form-control" name="client_id">
					<?php foreach($clients as $client):?>
					<option <?=$client['id'] == $result['client_id'] ? 'selected ' : ''?> value="<?=$client['id']?>"><?=$client['name']?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Datums</label>
			<div class="col-sm-5">
				<input type="date" class="form-control" name="date" value="<?=$result['date']?>">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Summa</label>
			<div class="col-sm-5">
				<input type="text" class="form-control-plaintext" disabled value="<?=$sum.'€'?>">
			</div>
		</div>
		<input name="sum" hidden="" value="<?=$sum?>">
		<input name="id" hidden="" value="<?=$result['id']?>">

		<div class="form-group row">
			<div class="col-sm-2"></div>
			<div class="col-sm-5">
				<button type="submit" class="btn btn-outline-primary" name="save">Saglabāt</button>
			</div>
		</div>
	</fieldset>

<?=$output?>

<?php else:?>
	<div class="alert alert-danger">Lapa nav atrasta</div>
<?php endif;
	include 'footer.php';
?>
