let btns = document.querySelectorAll('.input');


btns.forEach(function(btn) {
    btn.addEventListener("mouseover", function() {
        btn.className = "ma";
        btn.firstElementChild.firstElementChild.firstElementChild.style.color="rgb(8,160,233)";
    });
});

btns.forEach(function(btn) {
    btn.addEventListener("mouseout", function() {
        btn.className = "input";
        btn.firstElementChild.firstElementChild.firstElementChild.style.color="rgb(196, 207, 214)";

    });
});


let labs = document.querySelectorAll('.label');

labs.forEach(function(lab) {
    lab.addEventListener("mouseover", function() {
        lab.className = "ma";
        lab.firstElementChild.style.color="rgb(8,160,233)";
    });
});

labs.forEach(function(lab) {
    lab.addEventListener("mouseout", function() {
        lab.className = "label";
        lab.firstElementChild.style.color="rgb(196, 207, 214)";

    });
});