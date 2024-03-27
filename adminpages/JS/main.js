document.addEventListener('DOMContentLoaded', () => {
    const thumbnails = document.querySelectorAll('.img-thumbnail');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            const popupImage = thumbnail.cloneNode();
            popupImage.classList.add('img-popup');
            popupImage.classList.remove('img-thumbnail');
            document.body.appendChild(popupImage);
            popupImage.style.display = 'block';

            // Close popup on click
            popupImage.addEventListener('click', () => {
                popupImage.remove();
            });
        });
    });
});

/*
* This function sets the currently selected menu item to the 'active' state.
* It should be called whenever the page first loads.
*/
function activateMenu()
{
const navLinks = document.querySelectorAll('nav a');
navLinks.forEach(link =>
{
if (link.href === location.href)
{
link.classList.add('active');
}
})
}
