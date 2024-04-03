$(document).ready(function () {
  $(".navbar-toggler").click(function () {
    $("#navbarTogglerDemo01").collapse("toggle");
  });
});

// Add a "submit" event listener to the form
const form = document.querySelector("#add-review");

form.addEventListener("submit", submitForm);

const stars = document.querySelectorAll(".star-rating i");
const ratingInput = document.querySelector("[name='rating']");

stars.forEach((star, index) => {
  star.addEventListener("mouseover", () => {
    stars.forEach((el) => el.classList.remove("active"));
    for (let i = 0; i <= index; i++) {
      stars[i].classList.add("active");
    }
  });

  star.addEventListener("click", () => {
    ratingInput.value = index + 1;

    for (let i = index + 1; i < stars.length; i++) {
      stars[i].classList.remove("active");
    }

    // Submit the rating to the server
    // const rating = document.querySelector(".rating-value");
    // rating.value = index + 1;
    submitForm();
  });

  star.addEventListener("mouseout", () => {
    stars.forEach((el) => el.classList.remove("active"));
  });
});

// to get the product id from the url
const images = document.querySelectorAll(".img-responsive");

images.forEach(function (image) {
  image.addEventListener("click", function () {
    const imageSrc = this.src;
    const urlParams = new URLSearchParams(imageSrc.split("?")[1]);
    const productId = urlParams.get("product_id");
    window.location.href = `product_description.php?product_id=${productId}`;
  });
});
document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("filterForm")
    .addEventListener("change", function (e) {
      // Get selected category names
      var category_names = [];
      var checkboxes = document.querySelectorAll(
        'input[name="category[]"]:checked'
      );
      checkboxes.forEach(function (checkbox) {
        category_names.push(checkbox.value);
      });

      // Create the query string
      var queryString = category_names
        .map(function (name) {
          return "category[]=" + encodeURIComponent(name);
        })
        .join("&");

      // Create a new XMLHttpRequest
      var xhr = new XMLHttpRequest();
      xhr.open(
        "GET",
        window.location.href.split("?")[0] + "?" + queryString,
        true
      );
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

      // Handle the response
      xhr.onload = function () {
        if (this.status >= 200 && this.status < 400) {
          // Success!
          var products = JSON.parse(this.response);

          // Clear the products table
          var productTable = document.getElementById("productTable");
          while (productTable.firstChild) {
            productTable.removeChild(productTable.firstChild);
          }

          // Add each product to the table
          products.forEach(function (product) {
            // Generate the HTML for the product
            var productHtml =
              "<tr>" +
              "<td>" +
              '<div class="product-card">' +
              '<div class="product-image" style="text-align: center; margin: 0 auto;">' +
              '<a href="product_description.php?product_id=' +
              product.product_id +
              '">' +
              '<img src="' +
              product.image +
              '" alt="' +
              product.image +
              '" width="200" height="200">' +
              "</a>" +
              "</div>" +
              '<div class="product-info" style="text-align: center;">' +
              '<h2 class="product-title">' +
              product.name +
              "</h2>" +
              '<p class="product-price">' +
              product.price +
              "</p>" +
              '<button class="btn btn-primary" style="text-align: center;" onclick="addToCart(' +
              product.product_id +
              ", '" +
              product.name +
              "', " +
              product.price +
              ')">Add to Cart</button>' +
              "</div>" +
              "</div>" +
              "</td>" +
              "</tr>";

            // Add the product to the table
            productTable.innerHTML += productHtml;
            // Set the checked property of the checkboxes
            checkboxes.forEach(function (checkbox) {
              checkbox.checked = response.selectedCategories.includes(
                checkbox.value
              );
            });
          });
        } else {
          // We reached our target server, but it returned an error
          console.error("Server returned an error");
        }
      };

      // Handle network errors
      xhr.onerror = function () {
        console.error("Network error");
      };

      // Send the AJAX request
      xhr.send();
    });
});
