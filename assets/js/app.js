window.addEventListener("DOMContentLoaded", (e) => {

    /*--================== ADMINISTRATION ====================--*/
    if (document.querySelector('.admin')) {

        const delete_data = document.querySelectorAll('#delete_data');

        for (const del_button of delete_data) {

            del_button.addEventListener('click', () => {

                if (!confirm('Confirmer la suppression ?')) { // if return False

                    del_button.removeAttribute('href');
                    document.location.reload();

                }
            });
        }
    }

    /*--================== ARTICLE ====================--*/

    // if (document.querySelector('#alert-js')) {

    //     let alert = document.querySelector('#alert-js');

    //     setTimeout(() => {
    //         alert.style.display = "none";
    //     }, 2500);
    // }

});