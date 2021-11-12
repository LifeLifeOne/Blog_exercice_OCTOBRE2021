document.addEventListener('DOMContentLoaded', () => {

    // Message Success Comments
    if (document.querySelector('#js-success')) {

        setTimeout(() => {
            document.querySelector('#js-success').style.display = 'none';
        }, 2500);

    }

});