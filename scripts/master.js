"use strict";

window.addEventListener("DOMContentLoaded", () => {
    /*let element = document.getElementById("dark-mode");
    element.addEventListener("click", () => {
        
        const dark = document.body;
        dark.classList.toggle("dark-mode");
        
        console.log("Dark Mode Activated");

    });*/
    function setTextAnimation(delay, duration, strokeWidth, timingFunction, strokeColor,repeat) {
        let paths = document.querySelectorAll("path");
        let mode=repeat?'infinite':'forwards'
        for (let i = 0; i < paths.length; i++) {
            const path = paths[i];
            const length = path.getTotalLength();
            path.style["stroke-dashoffset"] = `${length}px`;
            path.style["stroke-dasharray"] = `${length}px`;
            path.style["stroke-width"] = `${strokeWidth}px`;
            path.style["stroke"] = `${strokeColor}`;
            path.style["animation"] = `${duration}s svg-text-anim ${mode} ${timingFunction}`;
            path.style["animation-delay"] = `${i * delay}s`;
        }
    }
setTextAnimation(0.1,3.2,2,'linear','#ffffff',true);

    function play() {
        var x = document.getElementsByClassName("match__item--middle").src;
        document.getElementById("open").innerHTML = x;
    }
})
