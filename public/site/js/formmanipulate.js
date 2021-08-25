const inputSelect = document.querySelector(".form__input--select");

const selectLabel = document.querySelector(".select-effect");

const hiddenForm = document.querySelector(".hide--form");

// const multiSelectContainer = document.querySelector(".multi__select-container");

let focusStyle = "";

function hiddenFormSelect(value = "", selectSelecter, labelSelecter) {
    if (value === "") {
        labelSelecter.classList.add("select-label__hide");
        selectSelecter.style.color = "#999";
        return;
    }
    labelSelecter.classList.remove("select-label__hide");
    selectSelecter.style.color = "#000";
}

function perform(value = "") {
    if (value == "3") {
        return hiddenForm.classList.add("show");
    }

    hiddenForm.classList.remove("show");

    // console.log(inputSelect.value);
}

// labelTransform("", selectLabel, inputSelect);

inputSelect.addEventListener("change", function (e) {
    // console.log(e.target.value);
    hiddenFormSelect(e.target.value, inputSelect, selectLabel);
    perform(e.target.value);
});

let selectValue;

let formLabel;

// selectV();
// multiSelectContainer

function moveLabel(label) {
    label.classList.add("move-label");
}

// let newLabel;

multiSelectContainer.addEventListener("click", function (e) {
    const mainElement = e.target.closest(".select2-container");
    if (!mainElement) {
        // console.log(mainElement);
        return;
    }

    let previousElement = mainElement.previousElementSibling;
    // siblingText = siblings.map((e) => e.innerHTML);
    const selectInput = mainElement.querySelector("input");
    const label = previousElement.previousElementSibling;
    selectValue = previousElement.value;
    // console.log(previousElement.value);
    // if (mainElement.classList.contains("select-label__hide")) {
    //   console.log("hey");
    //   mainElement.classList.remove("select-label__hide");
    // }

    // newLabel = label;

    // if (!previousElement.value) {
    //   return label.classList.remove("move-label");
    // }

    moveLabel(label);
});

// const addBtn = document.querySelector(".add-fields");

// console.log(levels)
// const addFields = `
// <div class="multi__select-container">
//     <div class="wrap">
//     <div class="form__group">

//     <label
//       for="level"
//       class="form__label"
//       >Teaching Level*</label
//     >
//     <select
//       name="teaching_level[]"
//       id="level"
//       class="form__input form__input--select"

//     >
//       <option value="" disabled selected></option>

//       @foreach($levels as $level)
//           <option value="$level"></option>
//       @endforeach
//     </select>
//   </div>
//         <div class="form__group">
//                 <?php
//                 $subjects = \App\ProductTag::all();
//                 ?>
//                 <label
//                 for="subject"
//                 class="form__label"
//                 >Subject*</label
//                 >
//                 <select
//                 name="subject[]"
//                 class="mul-select form__input form__input--select"
//                 multiple="true"
//                 id="subject"
//                 >
//                 <option value="" disabled>Subject*</option>
//                 @foreach($subjects as $subject)
//                     <option value="{{$subject->id}}">{{$subject->name}}</option>
//                 @endforeach
//                 </select>
//         </div>
//         <button class="delete__div">Delete</button>
//     </div>
// </div>
// `;

// addBtn.addEventListener("click", function (e) {
//     e.preventDefault();
//     multiSelectContainer.insertAdjacentHTML("beforeend", addFields);
//     $(document).ready(function () {
//         $(".mul-select").select2({
//             placeholder: "", //placeholder
//             tags: true,
//             tokenSeparators: ["/", ",", ";", " "],
//         });
//     });
// });

hiddenForm.addEventListener("click", function (e) {
    const clickSelect = e.target.closest(".form__input--select");
    if (!clickSelect) return;

    const label = clickSelect.nextElementSibling;

    if (!label) {
        const label2 = clickSelect.previousElementSibling;
        moveLabel(label2);
        return;
    }

    if (clickSelect.classList.contains("")) {
        return;
    }
    // console.log(clickSelect, label, e.target.value);

    hiddenFormSelect(e.target.value, clickSelect, label);
});
