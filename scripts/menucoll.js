var butt0 = document.getElementById("dropbtn0");
butt0.addEventListener("click", menucoll1);

function menucoll1(){
    var menu = document.getElementById("dropdown-content0");
    var menu1 = document.getElementById("dropdown-content1");
    if(menu.style.display==="inline"){
        menu.style.display="none";
        butt0.style.backgroundColor="white";
    }else{
        menu.style.display="inline";
        butt0.style.backgroundColor="#ccc";
    }
}

var butt1 = document.getElementById("dropbtn1");
butt1.addEventListener("click", menucoll2);

function menucoll2(){
    var menu0 = document.getElementById("dropdown-content0");
    var menu = document.getElementById("dropdown-content1");
    if(menu.style.display==="inline"){
        menu.style.display="none";
        butt1.style.backgroundColor="white";
    }else{
        menu.style.display="inline";
        butt1.style.backgroundColor="#ccc";
    }

}