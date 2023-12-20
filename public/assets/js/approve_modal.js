var update_btn = document.getElementsByClassName("update_detail");
var insert_btn = document.getElementsByClassName("insert_detail");
var upsert_detail = document.getElementsByClassName("upsert_detail");
var insert_file_detail = document.getElementsByClassName("insert_file_detail");
var modal_update = document.getElementById("modal_update");
var modal_insert = document.getElementById("modal_insert");
var modal_upsert = document.getElementById("modal_upsert");
var modal_insert_file = document.getElementById("modal_insert_file");
var close_icon = document.getElementById("close_icon");
var close_insert = document.getElementById("close_insert");
var close_upsert = document.getElementById("close_upsert");
var close_insert_file = document.getElementById("close_insert_file");
var dropdown = document.querySelectorAll(".dropdown");

for (let i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", () => {
        dropdown[i].classList.toggle("close");
    });
}

for (var i = 0; i < update_btn.length; i++) {
    update_btn[i].onclick = function () {
        modal_update.style.display = "block";
        document.querySelector("body").style.overflowY = "hidden";
    };
}
for (var j = 0; j < insert_btn.length; j++) {
    insert_btn[j].onclick = function () {
        modal_insert.style.display = "block";
        document.querySelector("body").style.overflowY = "hidden";
    };
}
for (var k = 0; k < insert_file_detail.length; k++) {
    insert_file_detail[k].onclick = function () {
        modal_insert_file.style.display = "block";
        document.querySelector("body").style.overflowY = "hidden";
    };
}
for (var x = 0; x < upsert_detail.length; x++) {
    upsert_detail[x].onclick = function () {
        modal_upsert.style.display = "block";
        document.querySelector("body").style.overflowY = "hidden";
    };
}
close_insert_file.onclick = function () {
    modal_insert_file.style.display = "none";
    document.querySelector("body").style.overflowY = "scroll";
};
close_icon.onclick = function () {
    modal_update.style.display = "none";
    document.querySelector("body").style.overflowY = "scroll";
};
close_insert.onclick = function () {
    modal_insert.style.display = "none";
    document.querySelector("body").style.overflowY = "scroll";
};
close_upsert.onclick = function () {
    modal_upsert.style.display = "none";
    document.querySelector("body").style.overflowY = "scroll";
};
