// const song = document.querySelector("audio");
// const fillBar = document.getElementById("fill");

// document.getElementById("play").addEventListener("click", function() {
//   console.log(this.parentElement.parentElement.previousElementSibling);
// });
function stopSong(song) {

}

$("#songs-container").on("click", ".play", function () {

  let linkElement = this;
  let song = this.parentElement.parentElement.previousElementSibling;




  setTimeout(stopSong(song), 2000);

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

  song.addEventListener("timeupdate", function () {
    const position = song.currentTime / song.duration;
    let bar = this.previousElementSibling.firstElementChild;
    bar.style.width = position * 100 + "%";
    if (song.getAttribute('bought') == 0 && song.currentTime >= 45) {
      song.currentTime = 0;
      bar.style.width = 0 + '%';
      song.pause();
      $(linkElement)
        .children()
        .attr("src", "../img/play.png")
    }

  });

});