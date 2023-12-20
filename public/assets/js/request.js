var dropdown = document.querySelectorAll(".dropdown");
var modal_cancel = document.getElementById("modal_cancel");
var close_modal = document.getElementById("close_modal");

var insert_detail = document.getElementsByClassName("insert_detail");
var insert_file_detail = document.getElementsByClassName("insert_file_detail");

var upsert_detail = document.getElementsByClassName("upsert_detail");
var update_detail = document.getElementsByClassName("update_detail");

for (let i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", () => {
        dropdown[i].classList.toggle("close");
    });
}
close_modal.onclick = function () {
    modal_cancel.style.display = "none";
    document.querySelector("body").style.overflowY = "scroll";
};

for (let i = 0; i < update_detail.length; i++) {
    update_detail[i].onclick = function () {
        modal_cancel.style.display = "block";
        document.querySelector("body").style.overflowY = "hidden";
    };
}
for (let i = 0; i < upsert_detail.length; i++) {
    upsert_detail[i].onclick = function () {
        modal_cancel.style.display = "block";
        document.querySelector("body").style.overflowY = "hidden";
    };
}
for (let i = 0; i < insert_detail.length; i++) {
    insert_detail[i].onclick = function () {
        modal_cancel.style.display = "block";
        document.querySelector("body").style.overflowY = "hidden";
    };
}
for (let i = 0; i < insert_file_detail.length; i++) {
    insert_file_detail[i].onclick = function () {
        modal_cancel.style.display = "block";
        document.querySelector("body").style.overflowY = "hidden";
    };
}
