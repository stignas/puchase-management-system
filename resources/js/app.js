import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Delete confirm and file upload form modal control

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

// Show / Hide "forgot password" confirmation form

let forgotPassLink = document.getElementById('forgot-pass');
let loginLink      = document.getElementById('login-link');
let forgotPassForm = document.getElementById('forgot-password-container');
let loginForm      = document.getElementById('login-form');
let errMsg         = document.getElementById('err-msg');

function showHideElements(e, hide, unhide) {
    e.preventDefault();
    // hide
    hide.forEach((element) => {
        if (element != null && !element.classList.contains('hide')) {
            console.log(element);
            element.classList.add('hide');
        }
    });

    // unhide
    unhide.forEach((element) => {
        if (element != null && element.classList.contains('hide')) {
            console.log(element);
            element.classList.remove('hide');
        }
    });
}

forgotPassLink.addEventListener('click', () => {
    showHideElements(event, [forgotPassLink, loginForm, errMsg], [forgotPassForm, loginLink])
});


