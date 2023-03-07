import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Delete confirm and file upload form modal control

let forgotPassLink = document.getElementById('forgot-pass');
let loginLink = document.getElementById('login-link');
let forgotPassForm = document.getElementById('forgot-password-container');
let loginForm = document.getElementById('login-form');
let errMsg = document.getElementById('err-msg');
let modal = document.getElementById("po-modal");
let btn = document.getElementById("po-btn");
let close = document.getElementById('close');

function showHideElements(e, hide, unhide) {
    e.preventDefault();
    // hide
    if (hide != null) {
        hide.forEach((element) => {
            if (element != null && !element.classList.contains('hide')) {
                element.classList.add('hide');
            }
        });
    }

    // unhide
    if (unhide != null) {
        unhide.forEach((element) => {
            if (element != null && element.classList.contains('hide')) {
                element.classList.remove('hide');
            }
        })
    }
}

if (btn != null && close != null && modal != null) {

    btn.onclick = function (event) {
        showHideElements(event, [], [modal]);
    }

    close.onclick = function (event) {
        showHideElements(event, [modal]);
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            showHideElements(event, [modal])
        }
    };
}

if (forgotPassLink != null) {
    forgotPassLink.onclick = function (event) {
        showHideElements(event, [forgotPassLink, loginForm, errMsg], [forgotPassForm, loginLink])
    };
}




