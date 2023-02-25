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
