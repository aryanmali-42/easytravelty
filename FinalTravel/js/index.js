
// DISCOUNT MEDIA
const video = document.querySelector('.video');
const button = document.querySelector('.video-control');
button.addEventListener("click", playpausevideo);
function playpausevideo() {
    if (video.paused) {
        button.innerHTML = "  <i class='bx bx-pause'></i>"
        video.play();
    } else {
        button.innerHTML = "  <i class='bx bx-play'></i>"
        video.pause();
    }
}
const scroll = ScrollReveal({
    distance: "100px",
    duration: 2500,
    reset: true,
});

scroll.reveal(`.content h1, .content .btn`, {
    origin: "top",
    interval: 100,
});
scroll.reveal(`.info .container h2, .info .container h3`, {
    origin: "top",
    interval: 100,
});
scroll.reveal(`.info .container p`, {
    origin: "bottom ",
    interval: 100,
});
scroll.reveal(`.about  .anima1`, {
    origin: "top",
    interval: 100,

});
scroll.reveal(`.about .anima`, {
    origin: "bottom",
    interval: 100,
});
scroll.reveal(
    `.about :anima,.contact .location,.more .col:last-child,.newsletter .form`,
    {
        origin: "bottom",
    }
);

scroll.reveal(`.service img,.contact .title`, {
    origin: "top",
});

scroll.reveal(`.service .col,.trip .row`, {
    origin: "bottom",
});

scroll.reveal(`.trip .title,.more .col:first-child,.newsletter .col`, {
    origin: "left",
});
scroll.reveal(`.title`, {
    origin: "top",
});

scroll.reveal(`.cardhome`, {
    origin: "bottom",
});
