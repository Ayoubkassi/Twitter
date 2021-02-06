<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Categories</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
  <script>

function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    }
    xmlhttp.open("GET", "sugest.php?q="+str, true);
    xmlhttp.send();
  }
}

  </script>
</head>
<body>

	<div class="container">
		<h1>Search Categories</h1>

		<form action="">
			Search Categorie : <input type="text"  class="form-control" id="fname" name="fname" autocomplete="off" onkeyup="showHint(this.value)">
		</form>

		<p>Suggestions : <span id="txtHint" style="font-weight: bold"></span></p>
	</div>

</body>
</html>