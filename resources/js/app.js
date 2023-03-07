import './bootstrap';

import Alpine from 'alpinejs';
import showHideElements from "@/home.js";

window.Alpine = Alpine;

Alpine.start();

// Show / Hide "forgot password" confirmation form

let forgotPassLink = document.getElementById('forgot-pass');
let loginLink      = document.getElementById('login-link');
let forgotPassForm = document.getElementById('forgot-password-container');
let loginForm      = document.getElementById('login-form');
let errMsg         = document.getElementById('err-msg');


forgotPassLink.addEventListener('click', () => {
    showHideElements(event, [forgotPassLink, loginForm, errMsg], [forgotPassForm, loginLink])
});

// Modal for excel file upload and delete confirmation forms

const modal = document.getElementById("po-modal");
const btn = document.getElementById("po-btn");
const close = document.getElementById('close');

btn.onclick = function() {
    modal.style.display = "block";
}

close.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
