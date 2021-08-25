const navHeader = document.querySelector(".section-nav");

const fixedContainer = document.querySelector(".sub-header__container");

const nav = document.querySelector(".nav-btn");

const navHeight = nav.getBoundingClientRect().height;

// const options = {
//     root: null,
//     threshold: 0,
//     rootMargin: `-${navHeight}px`,
// };

// const stickyNav = function (entries) {
//     const [entry] = entries;

//     if (!entry.isIntersecting) nav.classList.add("sticky");
//     else nav.classList.remove("sticky");
// };

// const headerIntesection = new IntersectionObserver(stickyNav, options);

// headerIntesection.observe(navHeader);

// distance from top
const coords = fixedContainer.getBoundingClientRect();
// console.log(coords);

window.addEventListener("scroll", function () {
    // console.log(window.scrollY);

    if (window.scrollY >= 160) {
        nav.classList.add("sticky");
    } else {
        console.log("removed");
        nav.classList.remove("sticky");
    }
});

// prevent from forwarding to link
const downArrow = document.querySelectorAll(".nav-link .fas");

downArrow.forEach((e) =>
    e.addEventListener("click", function (event) {
        event.preventDefault();
    })
);
// console.log(downArrow);
