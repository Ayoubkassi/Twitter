let list = document.querySelectorAll('.inp');
	var mylist=[];
	let i = 0;
	let contin = document.querySelector('.jadi');
	list.forEach((item)=>{
		item.addEventListener('click',(e)=>{
			let input = document.createElement('input');
			input.className="inpi";
			input.type="submit";
			input.value=e.target.value;
				contin.appendChild(input);
		
			
			

		});
	});