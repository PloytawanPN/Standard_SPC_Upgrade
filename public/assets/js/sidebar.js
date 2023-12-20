const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar"),
    toggle = body.querySelector(".toggle");

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

path = window.location.pathname;
if (path == "/spc/dashboard") {
    document.getElementById("dashboard").style.backgroundColor = "#fd1d1d";
    document.getElementById("dash_icon").style.color = "white";
    document.getElementById("dash_text").style.color = "white";
} else if (path == "/spc/chart") {
    document.getElementById("chart").style.backgroundColor = "#fd1d1d";
    document.getElementById("chart_icon").style.color = "white";
    document.getElementById("chart_text").style.color = "white";
} else if (path == "/spc/logger") {
    document.getElementById("logger").style.backgroundColor = "#fd1d1d";
    document.getElementById("log_icon").style.color = "white";
    document.getElementById("log_text").style.color = "white";
} else if (path == "/spc/parameter") {
    document.getElementById("parameter").style.backgroundColor = "#fd1d1d";
    document.getElementById("param_icon").style.color = "white";
    document.getElementById("param_text").style.color = "white";
} else if (path == "/spc/setting") {
    document.getElementById("setting").style.backgroundColor = "#fd1d1d";
    document.getElementById("set_icon").style.color = "white";
    document.getElementById("set_text").style.color = "white";
} else if (path == "/spc/approve") {
    document.getElementById("approve").style.backgroundColor = "#fd1d1d";
    document.getElementById("approve_icon").style.color = "white";
    document.getElementById("approve_text").style.color = "white";
} else if (path == "/spc/request") {
    document.getElementById("request").style.backgroundColor = "#fd1d1d";
    document.getElementById("request_icon").style.color = "white";
    document.getElementById("request_text").style.color = "white";
}
