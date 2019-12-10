const song = document.querySelector("audio");
const fillBar = document.getElementById("fill");

$(".play").on("click", function() {
  let linkElement = this;
  let song = this.parentElement.parentElement.previousElementSibling;

  if (song.paused) {
    song.play();
    $(linkElement)
      .children()
      .attr("src", "../img/pause.png");
  } else {
    song.pause();
    $(linkElement)
      .children()
      .attr("src", "../img/play.png");
  }
});

song.addEventListener("timeupdate", function() {
  const position = song.currentTime / song.duration;
  fillBar.style.width = position * 100 + "%";
});
