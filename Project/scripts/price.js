window.onload = function(){
    slideOne();
    slideTwo();
}

let sliderOne = document.getElementById("slider-1");
let sliderTwo = document.getElementById("slider-2");
let displayValOne = document.getElementById("range1");
let displayValTwo = document.getElementById("range2");
let minGap = 0;
let sliderTrack = document.querySelector(".slider-track");
let sliderMaxValue = document.getElementById("slider-1").max;

function slideOne(){
    if(parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap){
        sliderOne.value = parseInt(sliderTwo.value) - minGap;
    }
    displayValOne.textContent = sliderOne.value;
    fillColor();
}
function slideTwo(){
    if(parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap){
        sliderTwo.value = parseInt(sliderOne.value) + minGap;
    }
    displayValTwo.textContent = sliderTwo.value;
    fillColor();
}
function fillColor(){
    percent1 = (sliderOne.value / sliderMaxValue) * 100;
    percent2 = (sliderTwo.value / sliderMaxValue) * 100;
    sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #ff9800 ${percent1}% , #ff9800 ${percent2}%, #dadae5 ${percent2}%)`;
}


function hoverOnRecipe (id) {
    document.getElementById("recipe__parameter"+id).classList.add("active")
    document.getElementById("recipe__img"+id).classList.add("active")
    document.getElementById("recipe__description"+id).classList.add("active")
    document.getElementById("recipeReady"+id).classList.add("active")
}
function hoverOffRecipe (id) {
    document.getElementById("recipe__parameter"+id).classList.remove("active")
    document.getElementById("recipe__img"+id).classList.remove("active")
    document.getElementById("recipe__description"+id).classList.remove("active")
    document.getElementById("recipeReady"+id).classList.remove("active")
}