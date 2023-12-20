var btn = document.getElementById("myBtn");
var modal = document.getElementById("myModal");
var close_btn_1 = document.getElementById("close_btn_1");
var close_btn_2 = document.getElementById("close_btn_2");
var close_btn_3 = document.getElementById("close_btn_3");
var insert_btn = document.getElementById("insert_btn");
var upload_btn = document.getElementById("upload_btn");
var insert_modal = document.getElementById("insert_modal");
var upload_modal = document.getElementById("upload_modal");

btn.onclick = function () {
    modal.style.display = "block";
    document.querySelector("body").style.overflowY="hidden"
};
close_btn_1.onclick = function () {
    modal.style.display = "none";
    document.querySelector("body").style.overflowY="scroll"
};
close_btn_2.onclick = function () {
    insert_modal.style.display = "none";
    document.querySelector("body").style.overflowY="scroll"
};
close_btn_3.onclick = function () {
    upload_modal.style.display = "none";
    document.querySelector("body").style.overflowY="scroll"
};
upload_btn.onclick = function () {
    upload_modal.style.display = "block";
    document.querySelector("body").style.overflowY="hidden"
};
insert_btn.onclick = function () {
    insert_modal.style.display = "block";
    document.querySelector("body").style.overflowY="hidden"
};
/* var close_btn = document.getElementsByClassName("close_btn")[0];
var close_confirm = document.getElementsByClassName("close_btn")[1];
var close_add = document.getElementsByClassName("close_btn")[2];
var close_register = document.getElementsByClassName("close_btn")[3];
var save_btn = document.getElementById("save_btn");
var card_btn = document.getElementsByClassName("card");
var confirm_modal = document.getElementById("confirm_modal");
var upload_modal = document.getElementById("upload_modal");
var upload_btn = document.getElementById("upload_btn");
var add_confirm = document.getElementById("add_confirm");
var insert_modal = document.getElementById("insert_modal");
var insert_btn = document.getElementById("insert_btn");
var register = document.getElementById("register");
var cancel_confirm_file = document.getElementById("cancel_confirm_file");

close_register.onclick = function () {
    insert_modal.style.display = "none";
};
insert_btn.onclick = function () {
    insert_modal.style.display = "block";
};
btn.onclick = function () {
    modal.style.display = "block";
    document.querySelector("body").style.overflowY="hidden"
};
close_btn.onclick = function () {
    modal.style.display = "none";
    document.querySelector("body").style.overflowY="scroll"
};
save_btn.onclick = function () {
    modal.style.display = "none";
    confirm_modal.style.display = "block";
};
for (var i = 0; i < card_btn.length; i++) {
    card_btn[i].onclick = function () {
        modal.style.display = "block";
    };
}
close_confirm.onclick = function () {
    confirm_modal.style.display = "none";
    document.querySelector("body").style.overflowY="scroll"
};

upload_btn.onclick = function () {
    upload_modal.style.display = "block";
    document.querySelector("body").style.overflowY="hidden"
};

close_add.onclick = function () {
    upload_modal.style.display = "none";
    document.querySelector("body").style.overflowY="scroll"
};

close_add_confirm.onclick = function () {
    upload_modal.style.display = "none";
    add_confirm.style.display = "none";
    document.querySelector("body").style.overflowY="scroll"
};
cancel_confirm_file.onclick = function () {
    upload_modal.style.display = "none";
};

 */






