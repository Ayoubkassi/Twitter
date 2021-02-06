<?php 

//categories array get from db




$a[] = "Tech";
$a[] = "Politics";
$a[] = "Sience";
$a[] = "Anime";
$a[] = "Sport";
$a[] = "Celebreties";
$a[] = "Fashion";
$a[] = "Movie";
$a[] = "General News";
$a[] = "Social Media";
$a[] = "Gaming";


//get query string

$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>
