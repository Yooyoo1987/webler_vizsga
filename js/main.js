
const navBarsBtn = document.getElementById("nav-bars-btn");
const barsItems = document.getElementById("bars-items");
const navUserBtn = document.getElementById("nav-user-btn");
const navSearchBtn = document.getElementById("nav-search-btn");
const searchItems = document.getElementById("search-input");
const cookieBtn = document.getElementById("cookieBtn");
const cookie = document.getElementById("cookie");

barsItems.style.display = "none";
searchItems.style.display = "none";

navBarsBtn.addEventListener("click", function (e) {
    e.preventDefault();
    if (barsItems.style.display === "none") {
        barsItems.style.display = "block";
    } else {
        barsItems.style.display = "none";
    }
})

navSearchBtn.addEventListener("click", function (e) {
    e.preventDefault();
    if (searchItems.style.display === "none") {
        searchItems.style.display = "block";
    } else {
        searchItems.style.display = "none";
    }
})

if(cookieBtn){
    cookieBtn.addEventListener("click", function(e){
        e.preventDefault();
        cookie.style.display = "none";
    })
}



