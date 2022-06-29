"use strict";

window.addEventListener("DOMContentLoaded", ()=>{
    let dele = document.querySelector(".delete button");
    dele.addEventListener('click', () => {
        let head = document.querySelector(".edit h2");
        window.alert("Are you sure you want to delete your account?");
        window.location.href = "delete.php";
        // head.classList.add("trial");
        console.log("Account Deleted");
    });
})