var i = 5;
var semaphore = true;

window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
		if(semaphore){
			semaphore = false;
			var http = new XMLHttpRequest();
			var url = "recharge.php";

			http.onreadystatechange = function() {
				if (http.readyState == 4 && http.status == 200) {
					reach(http.responseText);
				}
			};

			http.open("GET", url+"?off="+i, true);
			http.send();
		}
	}
};

function reach(text){
	var middle = document.getElementById('middle_coloumn');
	var last = document.getElementById('last_post');
	if(text=='finish'){
		last.innerHTML = '<div style="text-align:center;"><p>Post finiti</p></div>';
		semaphore = false;
	} else {
		middle.removeChild(last);
		middle.innerHTML = middle.innerHTML + text;
		i += 5;
		semaphore = true;
	}
}