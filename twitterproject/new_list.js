
/*
<ul id="categories">
	<li class="colection_categorie">
		<a>Ayoub</a>
	 </li>
	 <li class="colection_categorie">
		<a>Aroua</a>
	 </li>
	 <li class="colection_categorie">
		<a>Bensaid</a>
	 </li>

</ul>

*/
let inputField = document.getElementById('input');

inputField.addEventListener("keyup",new_cat);

const new_cat = () => {
	let value = document.getElementById("input").value.toUpperCase();
	
	//get all categories
	
	let ul = document.getElementById('categories');
	
	//get items from ul
	
	let li = ul.querySelectorAll("li.collection_categorie");
	
	li.forEach((categorie)=>{
		let a = categorie.getElementByTagName('a');
		
		//if matched
		
		if(a.innerHTML.toUpperCase().indexOf(value) > -1){
			categorie.style.display = "";
		} else {
			categorie.style.display = 'none';
		
		}
	});
	
}
