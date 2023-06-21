const hamburger = document.getElementById("hamburger")
const nav = document.getElementById("nav")
const modalBtn = document.querySelector(".modal-btn")
const cancelBtn = document.querySelector(".cancel-btn")
const overlay = document.getElementById("overlay")

if (window.innerWidth < 700) {
    nav.style.display = "none"
} else {
    nav.style.display = "block"
}

hamburger.addEventListener("click", function() {
    if (nav.style.display == "none") {
        nav.style.display = "block"
    } else {
        nav.style.display = "none"
    }
})

modalBtn.addEventListener("click", function() {
    if (overlay.style.display == "none") {
        overlay.style.display = "flex"
    } else {
        overlay.style.display = "none"
    }
})

cancelBtn.addEventListener("click", function() {
    overlay.style.display = "none"
})