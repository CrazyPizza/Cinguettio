document.getElementById('search_friend').addEventListener('keyup', search);

function search(){
	var txt = document.getElementById('search_friend').value;
	var http = new XMLHttpRequest();
	var url = "search.php";

	http.onreadystatechange = function() {
		if (http.readyState == 4 && http.status == 200) {
			risposta(http.responseText);
		}
	};
	
	http.open("GET", url+"?mail="+txt, true);
	http.send();
}

function risposta(text){
	document.getElementById('search_result').innerHTML = text;
}