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

const fullText = `
Hi, I’m Nana Aba
I’m a curious and hands-on techie with a background in Business and Computer Science. I love building things that make work smoother and more efficient — whether that’s customizing an ERP system, solving an IT issue, or creating a clean, functional website.

Right now, I’m an IT Technician at IBW Surveyors, where I help keep our tech running smoothly and lead projects that improve how we work. Before that, I spent a couple of years at IN Engineering + Surveying, diving deep into Odoo ERP development, supporting digital marketing efforts, and working closely with teams to bring ideas to life.

Along the way, I’ve picked up skills in Python, JavaScript, SQL Server, Git, and tools like WordPress, React, and BigQuery. I’m all about learning, collaborating, and finding practical solutions that actually make a difference.

Let’s Connect
Have a project in mind or just want to say hi? I’m always open to chatting about tech, teamwork, or the next big idea.
`;

const el = document.getElementById("typewriter-text");
let index = 0;

function type() {
  if (index <= fullText.length) {
    el.textContent = fullText.slice(0, index);
    index++;
    setTimeout(type, 15); // Typing speed in ms
  }
}

type();

const d = new Date();
document.getElementById("time").innerHTML = d;