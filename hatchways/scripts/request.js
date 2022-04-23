"use strict";

window.addEventListener("DOMContentLoaded", ()=>{
    // GET request using fetch()
    fetch("https://api.hatchways.io/assessment/students")

    // Converting received data to JSON

    .then(response => response.json())
    .then(data => {
        console.log(data)
        // Create variable to store HTML and search results
        let element = " ";
        let searchInput = document.getElementById("search");
        let datastore = [];
        
        //Function used to find the average of the grades
        function findAvg(array){
            let sum = 0;
            for (let i = 0; i < array.length; i++){
                sum += parseInt(array[i]);
            }
            let average = sum / array.length;
            return average;
        } 
        
        function TestNumber(array){
            
            for(let num = 0; num < array.length; num++){                
                
                return num + 1;
            }
            
        }

        

        // Loop through each data and add a table row
        data.students.forEach(student => {     
            element += `<div class="student">`;
            element += `<img class="avatar" src="${student.pic}" </img>`;
            //element += `<button class=icon><i class="fas-solid fa-plus"></i></button>`;
            element += `<div class="info"><h1>${student.firstName} ${student.lastName} </h1>`;
            element += `<p>Email: ${student.email}</p>`;
            element += `<p>Company: ${student.company}</p>`;
            element += `<p>Skill: ${student.skill}</li></p>`;
            element += `<p>Average: ${findAvg(student.grades)}%</p></div>`;
            
            //function showGrades(){
                
                let grade = [];
                for(let i = 0; i < student.grades.length; i++){
                    grade[i] = student.grades[i];
                    element += `<p>Test ${i + 1}: ${grade[i]}% </p>`;
                }
                
            //}
            element += `</div>`;
        });

        document.getElementById("students").innerHTML = element;

    });

})
