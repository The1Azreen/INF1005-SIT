document.addEventListener("DOMContentLoaded", function () {
  registerEventListeners(); // You need to write this function…
  activateMenu();
});

/*
* This function sets the currently selected menu item to the 'active' state.
* It should be called whenever the page first loads.
*/
function activateMenu() {
  const navLinks = document.querySelectorAll('nav a');
  navLinks.forEach(link => {
    if (link.href === location.href) {
      link.classList.add('active');
    }
  })
}

function registerEventListeners() {

  var images = document.getElementsByClassName("myImages");
  if (images !== null && images.length > 0) {
    for (var i = 0; i < images.length; i++) {
      var image = images[i];
      image.addEventListener("click", togglePopup);
    }
  }
  document.addEventListener("click", function (e) {
    const target = e.target.closest("#popupContainer");
    if (target) {
      var popupContainer = document.getElementById("popupContainer");
      popupContainer.remove();
    }
  });
}

function togglePopup(e) {
  var idCaption = "popupContainer";
  var popupContainer = document.getElementById(idCaption);

  if (popupContainer === null) {
    popupContainer = document.createElement('span');
    popupContainer.setAttribute('class', 'img-popup');
    popupContainer.setAttribute('id', idCaption);
    document.body.appendChild(popupContainer);

    var mySrc = "images/" + e.target.alt + "_large.jpg";

    var popupImage = document.createElement('img');
    popupImage.setAttribute('src', mySrc);
    popupImage.setAttribute('alt', e.target.alt);


    popupContainer.appendChild(popupImage);
    popupContainer.style.display = 'block';
  } else {
    popupContainer.remove();
  }
}

