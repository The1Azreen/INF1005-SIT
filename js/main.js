document.addEventListener("DOMContentLoaded", function () {
    registerEventListeners();

    function registerEventListeners() {
        images = document.getElementsByClassName("img-thumbnail");
        for (var i = 0; i < images.length; i++) {
            images[i].addEventListener("click", popup);
        }

        document.body.onclick = function (event) {
            if (event.target.className !== "popupImg_class" && event.target.className !== "img-thumbnail") {
                popups = document.getElementsByClassName("popupImg_class");
                if (popups.length > 0) {
                    for (var j = 0; j < popups.length; j++) {
                        popups[j].remove();
                    }
                }
            }
        };
    }

    function popup() {
        popups = document.getElementsByClassName("popupImg_class");
        if (popups.length > 0) {
            for (var j = 0; j < popups.length; j++) {
                popups[j].remove();
            }
        }

        popup_span = document.createElement("div");
        popup_span.className = "popupImg_class";
        popup_img = document.createElement("img");
        popup_img.alt = this.alt + "_Large";
        popup_img.src = "images/" + this.alt.toLowerCase() + "_large.jpg";

        popup_span.appendChild(popup_img);
        document.body.appendChild(popup_span);
    }
});
