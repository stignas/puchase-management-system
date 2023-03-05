export default function showHideElements(e, hide, unhide) {
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

const modal = document.getElementById("po-modal");
const btn = document.getElementById("po-btn");
const close = document.getElementById('close');

// Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
close.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}
