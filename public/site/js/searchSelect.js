$(".select").each(function () {
    var $this = $(this),
        numberOfOptions = $(this).children("option").length;

    $this.addClass("select-hidden");
    $this.wrap('<div class="select"></div>');
    $this.after('<div class="select-styled"></div>');

    var $styledSelect = $this.next("div.select-styled");
    $styledSelect.text($this.children("option").eq(0).text());

    var $list = $("<ul />", {
        class: "select-options",
    }).insertAfter($styledSelect);

    for (var i = 0; i < numberOfOptions; i++) {
        $("<li />", {
            text: $this.children("option").eq(i).text(),
            rel: $this.children("option").eq(i).val(),
        }).appendTo($list);
    }

    var $listItems = $list.children("li");

    $styledSelect.click(function (e) {
        e.stopPropagation();
        $("div.select-styled.active")
            .not(this)
            .each(function () {
                $(this).removeClass("active").next("ul.select-options").hide();
            });
        $(this).toggleClass("active").next("ul.select-options").toggle();
    });

    $listItems.click(function (e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass("active");
        $this.val($(this).attr("rel"));
        $list.hide();
        // console.log($this.val());
    });

    $(document).click(function () {
        $styledSelect.removeClass("active");
        $list.hide();
    });
});

// fixed search
const stickySearchBtn = document.querySelector(".sticky-search");

const searchForm = document.querySelector(".sticky-form");

const searchBox = document.querySelector(".searchIcon");

const myForm = document.querySelector(".myForm");

function toggleSearchBox(event, closestClass, activateBox) {
    const click = event.target.closest(closestClass);

    const insideClick = event.target.closest(".header-section__form");

    // console.log("Am here");
    if (!click) return activateBox.classList.remove("show");

    if (click && !insideClick) {
        return activateBox.classList.toggle("show");
    }

    if (!insideClick && !click) return activateBox.classList.remove("show");

    activateBox.classList.add("show");

    // console.log("Am here");
}

document.addEventListener("click", function (e) {
    toggleSearchBox(e, ".sticky-search", searchForm);
});

// another
document.addEventListener("click", function (e) {
    toggleSearchBox(e, ".searchIcon", myForm);
});

// for clearing search input
const clearBtn = document.querySelectorAll(".delete__search");

const inputForm = document.querySelectorAll(".header-section__form input");
clearBtn.forEach((c) => {
    c.addEventListener("click", function (e) {
        inputForm.forEach((v) => {
            v.value = "";
        });
    });
});
