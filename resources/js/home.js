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


