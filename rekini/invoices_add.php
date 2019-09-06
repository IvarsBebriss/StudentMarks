<?php
session_start();
include 'funkcijas.php';
include 'layout.php';

$clients = getData('clients','name');

if(isset($_POST['save'])){
	saveData('invoices',['client_id'=>$_POST['client'], 'date'=>$_POST['date']]);
}

?>

<form method="post">
  <fieldset>
    <legend>Rēķina pievienošana</legend>
	<div class="form-group row">
		<label for="client" class="col-sm-2 col-form-label">Klients</label>
		<div class="col-sm-5">
			<select class="form-control custom-select" required="true" name="client">
				<option selected>Lūdzu, izvēlieties...</option>
				<?php foreach($clients as $client):?>
					<option value="<?=$client['id']?>"><?=$client['name']?></option>
				<?php endforeach;?>
			</select>
		</div>
    </div>
	<div class="form-group row">
      <label for="date" class="col-sm-2 col-form-label">Datums</label>
      <div class="col-sm-5">
        <input type="date" class="form-control" name="date" required="true" value="<?=date("Y-m-d")?>">
      </div>
    </div>
	<div class="form-group row">
		<div class="col-sm-2">
			<a href="invoices.php" class="btn btn-outline-secondary">Atpakaļ</a>
		</div>
		<div class="col-sm-5">
			<button type="submit" class="btn btn-outline-primary" name="save">Saglabāt</button>
		</div>
    </div>
  </fieldset>
</form>

<?php
include 'footer.php';?>