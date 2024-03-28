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
