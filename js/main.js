const stars = document.querySelectorAll(".star-rating i");

stars.forEach((star, index) => {
  star.addEventListener("mouseover", () => {
    stars.forEach((el) => el.classList.remove("active"));
    for (let i = 0; i <= index; i++) {
      stars[i].classList.add("active");
    }
  });

  star.addEventListener("click", () => {
    for (let i = 0; i <= index; i++) {
      stars[i].classList.add("active");
    }

    for (let i = index + 1; i < stars.length; i++) {
      stars[i].classList.remove("active");
    }

    // Here you can add the code to submit the rating to the server
    const rating = document.querySelector(".rating-value");
    rating.value = index + 1;
    submitForm();
  });

  star.addEventListener("mouseout", () => {
    stars.forEach((el) => el.classList.remove("active"));
  });
});
