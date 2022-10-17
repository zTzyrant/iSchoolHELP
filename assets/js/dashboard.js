function offsidebar() {
    var sidebar = document.getElementById("sidebar");
    sidebar.classList.remove("active");
    console.log("sss");
}

function onsidebar() {
    var sidebar = document.getElementById("sidebar");
    sidebar.classList.add("active");
    console.log("sss");
}




function myFunction(x) {
    if (x.matches) { // If media query matches
        offsidebar();
    } else {
        onsidebar();
    }
}


  
  var x = window.matchMedia("(max-width: 1203px)")
  myFunction(x) // Call listener function at run time
  x.addListener(myFunction) // Attach listener function on state changes 