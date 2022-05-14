let speed_people = 0.08;
let speed_arm = 0.08;
let speed_fon = -0.5;
let speed_fonTraining_1 = 0.1;

let Y_people = 0;
let Y_arm = 0;
let Y_fon = 0;
let Y_fonTraining_1 = 0.;

let start_scroll = 0;

window.addEventListener("scroll", function (e) {

    let people = document.querySelector('.fonPeopleBody');
    let arm = document.querySelector('.fonPeopleArm');
    let fon = document.querySelector('.fonKitchen');
    let fonTraining_1 = document.querySelector('.fonTraining_1');

    if(window.pageYOffset != start_scroll) {

        Y_people += speed_people * (window.pageYOffset - start_scroll);
        Y_arm += speed_arm * (window.pageYOffset - start_scroll);
        Y_fon += speed_fon * (window.pageYOffset - start_scroll);
        Y_fonTraining_1 += speed_fonTraining_1 * (window.pageYOffset - start_scroll);
    }

    start_scroll = window.pageYOffset;

    people.setAttribute("style", "transform:translateY(" + Y_people + "px);");
    arm.setAttribute("style", "transform:translateY(" + Y_arm + "px);");
    fon.setAttribute("style", "transform:translateY(" + Y_fon*(-1) + "px);");
    fonTraining_1.setAttribute("style", "transform:translateY(" + Y_fonTraining_1*(-1) + "px);");
});


function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
        }
    }
}
