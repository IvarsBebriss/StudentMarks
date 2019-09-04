// Ivars Bebrišs

// funkcija ievieto šīs dienas datumu lapas sākumā
function datums(){
	var d = new Date(); //datums
	var output="Šodien ir "; //šinī mainīgajā glabāsies gala vērtība

	// weekday mainīgais - glabājas latviskoti nedēļas dienu nosaukumi
	var weekday = new Array("svētdiena","pirmdiena","otrdiena", "trešdiena", "ceturtdiena", "piektdiena", "sestdiena");

	output += weekday[d.getDay()] + ", "; //pievienojam nedēļas dienu
	output += d.getFullYear()+".gada "; //pievienojam gadu
	output += d.getDate()+"."; // pievienojam datumu

	// month mainīgias - glabājas latviskoti mēnešu nosaukumi
	var menesis = new Array("janvāris", "februāris", "marts","aprīlis","maijs","jūnijs","jūlijs","augusts","septembris","oktobris","novembris","decembris");

	output += menesis[d.getMonth()]; // pievienojam mēnesi
	document.getElementById('datums').innerHTML = output; //ievietojam rezultātu HTML
}


//validācija darbosies ja formai pievienosi onsubmit='return validet()'
//html galvas sadaļā jāpievieno <script src="myScrips.js"></script>
// funkcija pārbauda reģistrācijas formā ievadītās vērtības
function validet(){
	var dogName=document.regforma.dogName.value;
	var email=document.regforma.epasts.value;
	var passw=document.regforma.parole.value;
	var piek=document.regforma.piekritu.checked;

	if (!dogName){ //pārbaudam vai suņa vārds ir ievadīts
		alert("Suņa vārda lauks ir obligāts!");
		document.regforma.dogName.focus();
		return false;
	} else {
		if (dogName.length<2 || dogName.length > 12){ //pārbaudam vai suņa vārds ir 2-12 zīmju garš
			alert("Suņa vārdam jābūt 2-12 burtu garam!");
			document.regforma.dogName.focus();
			return false;
		}
	}
	
	if (!email){
		alert("E-pasta lauks ir obligāts!");
		document.regforma.epasts.focus;
		return false;
	}
	
	if (!validetepastu(email)) return false;
	
	if (!passw){
		alert("Paroles lauks ir obligāts!");
		document.regforma.parole.focus;
		return false;
	}
	
	if (!validetparoli(passw)) return false;
	
	if (!piek){
		alert("Lai turpinātu, jāpiekrīt noteikumiem!");
		document.regforma.piekritu.focus;
		return false;
	}

	var breed=document.regforma.breed.value;
	var letters = /^[A-Za-z\s]+$/; //letters - visi burti un 'white space'
	if(!breed.match(letters)){ //pārbaudam vai škirnes nosaukumā ir tikai teksts un atstarpes
		alert("Suņa šķirnes nosaukumā jābūt tikai burtiem!");
		document.regforma.breed.focus();
		return false;
	}

	return true;
}

// papildus funkcijas validācijas funkcijai - e-pasta pārbaudei
function validetepastu(x){
	var atpos = x.indexOf("@");
	var dotpos = x.indexOf(".");
	
	if (atpos<2 || dotpos<atpos+2 || dotpos+2>=x.length){
		alert("Jāievada derīga e-pasta adrese");
		x.focus();
		return false;
	}
	return true;
}

// papildus funkcijas validācijas funkcijai - paroles pārbaudei
function validetparoli(x){
	if (x.length<7) {
		alert("Parolei jābūt vismaz 7 simbolu garai!");
		x.focus;
		return false;
	}
	return true;
}

// funkcija atver meklētāju jaunā logā
function meklet(){

	var r = confirm("Vai atvērt google.lv?"); //paziņojums - vai atvērt jaunu logu

	if (r == true) {
		window.open("https://www.google.lv/search?q=suns","","width=800,height=600,top=150,left=150");
	}
}

// funkcija izvada formas datus uz DIV elementu 
// <input type="button" class="poga" onclick="datiuzdiv()" value="POGA">
// <div id="datuparbaude"></div>
function datiuzdiv(){
	var str = "Aizvērt";
	var a="<strong>Pārbaudiet datu pareizību:</strong><br>Lietotāja e-pasts: <u>";
	a += document.getElementById('epasts').value;
	a += "</u><br>parole: <u>";
	a += document.getElementById('parole').value;
	a += "</u><br>pilsēta/novads: <u>";
	a += document.getElementById('pilseta').value;
	a += "</u><br>vecums: <u>";
	a += document.getElementById('vecums').value;
	a += "</u><br>tautiba: <u>";
	a += document.getElementById('tautiba').value;
	a += "</u><br>dzimums: <u>";
	a += document.regforma.dzimums.value;
	a += "</u><br>Izvēlētā valoda: <u>";
	var i;
	for (i=0; i<4; i++){
		if (document.regforma.valoda[i].checked) a+=document.regforma.valoda[i].value;
	}
	a += "</u><br>Piezīmes: <u>";
	a += str.link('9uzd_formas.html')+"</u>";
	
	//confirm(a);
	document.getElementById("datuparbaude").innerHTML = a	;
}

/* bildes maiņa ar timeout
<scripit>
	setTimeout(function(){maini();}, 2000);
	var bildes = ["bb8.jpg", "c3po.jpg", "r2d2.jpg", "r2d2.png"];
	function maini(){
		var x = document.getElementById("ramis2");
		bildes_numurs = parseInt(x.alt);
		bildes_numurs++;
		if (bildes_numurs>3) bildes_numurs=0;
		x.src = bildes[bildes_numurs];
		x.alt = bildes_numurs;
		setTimeout(function(){maini();}, 2000);
	}
</script>
<div id = "sestais">
	<img id = "ramis2" src="bb8.jpg" alt='0' height="170" width="170"> 
</div>
*/

/* bildes maiņa ar pogām
<scripit>
	var bildes = ["bb8.jpg", "c3po.jpg", "r2d2.jpg", "r2d2.png"];
	function maini_bildi(i){
			x = document.getElementById("ramis");
			bildes_numurs= parseInt(x.alt) + parseInt(i);
			if (bildes_numurs>3) bildes_numurs=0;
			if (bildes_numurs<0) bildes_numurs=3;
			document.getElementById("ramis").src = bildes[bildes_numurs];
			document.getElementById("ramis").alt = bildes_numurs;
		}
</script>

<button onClick="maini_bildi(-1)">&lt; Atpakaļ</button>
<button onClick="maini_bildi(1)">Nākamā &gt;</button>
*/

// funkcija veic darbību, ja tiek asptiprināts popup
function mekle_vairak(){
	var atveram = confirm("Vai atvērt google.com?");
	if(atveram) window.open("http://www.google.com/search?source=&q=r2-d2","Google", "width=800, height=600, top=150, left=150");
}

// funkcija maina tekstu html elementā
// <input type="checkbox" name="public" id="public" class="custom-control-input" onclick="changeText();">
function changeText() {
	if (document.getElementById('public').checked){
		document.getElementById('publicLabel').innerHTML ="Public note";
	} else {
		document.getElementById('publicLabel').innerHTML ="Private note";
	}
}

// apstiprini, ka vēlies veikt darbību
// onclick="return confirm('Are you sure you want to delete this note?');"

// palielināt un samzaināt bildi on hover
//<img onmouseover="bigIMG(this)" onmouseout="normalIMG(this)" id='bilde' src="r2d2.png">
function bigIMG(x){
	x.style.width = '150px';
}
function normalIMG(x){
	x.style.width = '100px';
}

// rādīt vai slēpt tekstu, ja klikšķina rindkopu
// <p id = "slepta">Vairāk teksts '\se</p>
// <p><a id="moretext" href="#moretext" onclick="showtext()">Lasīt vairāk</a></p>
// <p><a id="lesstext" href="#lesstext" onclick="hidetext()">Atpakaļ</a></p>
function showtext() {
  document.getElementById("slepta").style.display = "block";	
  document.getElementById("moretext").style.display = "none";
  document.getElementById("lesstext").style.display = "block";			  
}
function hidetext() {
  document.getElementById("slepta").style.display = "none";	
  document.getElementById("moretext").style.display = "block";
  document.getElementById("lesstext").style.display = "none";
}
