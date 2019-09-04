<?php
session_start();
include 'funkcijas.php';

if (isset($_POST['saglabat'])){
	if(validateMarks($_POST)){
		saveMarks($_POST);
	} else {
		echo "Nekorekti ievaddati";
	}
}

include 'layout.php';

if(!isset($_GET['id'])){
	echo '<div class="alert alert-info">Lapa nav atrasta</div>';
	exit();
} 
$result = getstudent($_GET['id']);
$atzimes = getMarks($_GET['id']);


if ($result):?>
<form method="post">
  <fieldset>
    <legend>Studenta atzīmju labošana</legend>
	
	<div class="form-group row">
      <label class="col-sm-2 col-form-label">Students</label>
      <div class="col-sm-5">
        <p class="form-control-plaintext"><?=$result['vards'].' '.$result['uzvards']?></p>
      </div>
    </div>
	<div class="form-group row">
      <label for="pd1" class="col-sm-2 col-form-label">PD1</label>
      <div class="col-sm-5">
        <input type="number" min="0" max="10" class="form-control prc" name="pd1" value="<?=$atzimes['pd1']??0?>"/>
      </div>
    </div>
	<div class="form-group row">
      <label for="pd2" class="col-sm-2 col-form-label">PD2</label>
      <div class="col-sm-5">
        <input type="number" min="0" max="10" class="form-control prc" name="pd2" value="<?=$atzimes['pd2']??0?>"/>
      </div>
    </div>
	<div class="form-group row">
      <label for="pd3" class="col-sm-2 col-form-label">PD3</label>
      <div class="col-sm-5">
        <input type="number" min="0" max="10" class="form-control prc" name="pd3" value="<?=$atzimes['pd3']??0?>"/>
      </div>
    </div>
	<div class="form-group row">
      <label for="ieskaite" class="col-sm-2 col-form-label">Ieskaite</label>
      <div class="col-sm-5">
        <input type="number" min="0" max="10" class="form-control prc" name="ieskaite" value="<?=$atzimes['iesk']??0?>"/>
      </div>
    </div>
	<div class="form-group row">
      <label class="col-sm-2 col-form-label">Vidējā atzīme</label>
      <div class="col-sm-5">
        <output type="text" class="form-control-plaintext" id="result"></output>
      </div>
    </div>
	<input name="id" hidden="true" value="<?=$result['id_stud']?>"> 
	<div class="form-group row">
		<div class="col-sm-2">
			<a href="index.php" class="btn btn-outline-secondary">Atpakaļ</a>
		</div>
		<div class="col-sm-5">
			<button type="submit" name="saglabat" class="btn btn-outline-primary">Saglabāt</button>
		</div>
    </div>
  </fieldset>
</form>
<script src="jquery.min.js"></script>
<script>
	$('.form-group').on('input','.prc',function(){
        CalculateAverage();
	});
    $( document ).ready(function(){
        CalculateAverage();
    });
    function CalculateAverage(){
        var totalSum = 0;
        var marksCount = 0;
        $('.form-group .prc').each(function(){
            var inputVal = $(this).val();
            if($.isNumeric(inputVal)){
                if(parseFloat(inputVal)>0 && parseFloat(inputVal)<=10){
					totalSum += parseFloat(inputVal);
					marksCount++;
				}
            }
        });
        $('#result').text((totalSum/marksCount).toFixed(2));
    }
</script>
<?php else:?>
<div class="alert alert-info">Lapa nav atrasta</div>
<?php endif;

include 'footer.php';