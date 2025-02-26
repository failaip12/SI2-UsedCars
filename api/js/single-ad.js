
/////////////////////////////////
/* Single ad page */
const togglerLeft = document.querySelector(".toggler-one")
const togglerRight = document.querySelector(".toggler-two")
const adImage = document.querySelector(".ad-image")
const photoNum = document.querySelector(".num-of-photo")
let numDisplayed = 0
const imagesArray = ["./images/car_images/car1.jpg", "./images/car_images/car2.jpg", "./images/car_images/car3.jpg"]
photoNum.textContent = (numDisplayed+1) + "/" + (imagesArray.length)

function changeImage(imagesArray, numDisplayed) {
    adImage.src = imagesArray[numDisplayed]
    photoNum.textContent = (numDisplayed+1) + "/" + (imagesArray.length)
}

togglerLeft.addEventListener("click", function() {
    if (numDisplayed == 0) {
        numDisplayed = imagesArray.length - 1
    } else {
        numDisplayed-- 
    }
    changeImage(imagesArray, numDisplayed)
})

togglerRight.addEventListener("click", function() {
    if (numDisplayed == 2) {
        numDisplayed = 0
    } else {
        numDisplayed++
    }
    changeImage(imagesArray, numDisplayed) 
})