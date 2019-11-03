function menuClick() {
    console.log("Click");
    let arr = [];
    arr.push((document.getElementsByClassName("navigation")[0]));
    arr.push(document.getElementById("hamburger-nav"));
    arr.forEach((e) => e.classList.toggle("open"));
    let lines = document.getElementsByClassName("hamburger-nav-line");
    let links = document.getElementsByClassName("nav-link");
    for (let i = 0; i < lines.length; i++) {
        lines[i].classList.toggle("open");
    }
    for (let i = 0; i < links.length; i++) {
        links[i].classList.toggle("open");
    }
}

function playCrunch() {
    let crunchAudio = document.getElementById("crunch-audio");
    crunchAudio.play()
}

function scrollPastHeader() {
    let height = (document.getElementsByClassName("header-img")[0]).clientHeight;
    let offset = document.getElementById("dark-box").clientHeight;
    let scrollY = height - offset;
    window.scrollTo({
        top: scrollY,
        behavior: 'smooth'
    });
}

function showDarkBox() {
    let darkBox = document.getElementById("dark-box");
    let windowY = window.scrollY;
    if (darkBox) {
        darkBox.style.opacity = (windowY > 0) ? "0.6" : "0";
    }
}

document.addEventListener("DOMContentLoaded",
    () => window.addEventListener("scroll", showDarkBox));