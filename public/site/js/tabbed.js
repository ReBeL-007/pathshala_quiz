// tabbed component

const tabsContainer = document.querySelector(".operations__tab-container");
const tabs = document.querySelectorAll(".operations__tab");
const tabsContent = document.querySelectorAll(".operations__content");

console.log(tabsContainer);

tabsContainer.addEventListener("click", function (e) {
  const clicked = e.target.closest(".operations__tab");

  if (!clicked) return;

  tabs.forEach((tab) => tab.classList.remove("operations__tab--active"));
  clicked.classList.add("operations__tab--active");
  // console.log();
  tabsContent.forEach((tc) =>
    tc.classList.remove("operations__content--active")
  );

  document
    .querySelector(`.operations__content--${clicked.dataset.tab}`)
    .classList.add("operations__content--active");
});

// responsive
const headingContainer = document.querySelector(".operations");
const headingBtn = document.querySelectorAll(".operations__header");
const mobileContent = document.querySelectorAll(".hide-content");

headingContainer.addEventListener("click", function (e) {
  const clicked = e.target.closest(".operations__header");
  const nextElementCheck = clicked.nextElementSibling;
  if (!clicked) return;

  if (nextElementCheck.classList.contains("display--content")) {
    console.log("removed");
    clicked.classList.remove("operations__header-active");
    nextElementCheck.classList.remove("display--content");
    return;
  }

  headingBtn.forEach((h) => {
    h.classList.remove("operations__header-active");
  });

  clicked.classList.add("operations__header-active");
  console.log("hey");
  mobileContent.forEach((c) => {
    c.classList.remove("display--content");
  });

  document
    .querySelector(`.display--${clicked.dataset.click}`)
    .classList.add("display--content");
});
