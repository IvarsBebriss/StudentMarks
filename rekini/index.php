<?php
session_start();
include 'funkcijas.php';
include 'layout.php';

if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}
?>

<div style="align-items: center; display: flex; justify-content: center;height: 100vh; position: relative;">
            
            <div style="text-align: center">
                <div style="font-size: 84px; margin-bottom: 30px;">
                    Rēķini.lv
                </div>
            </div>
        </div>

<?php
include 'footer.php';