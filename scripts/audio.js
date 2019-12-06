const song = document.querySelector("audio");

// document.getElementById("play").addEventListener("click", function() {
//   console.log(this.parentElement.parentElement.previousElementSibling);
// });
$(".play").on("click", function() {
  let linkElement = this;
  let song = this.parentElement.parentElement.previousElementSibling;
  //   console.log(song);
  if (song.paused) {
    song.play();
    $(linkElement)
      .children()
      .attr("src", "../img/pause.png");
    // $("#play img").attr("src", "../img/pause.png");
  } else {
    song.pause();
    $(linkElement)
      .children()
      .attr("src", "../img/play.png");
    // $("#play img").attr("src", "../img/play.png");
  }
});
// function playOrPause() {
//   console.log(this);
//   if (song.paused) {
//     song.play();
//     $("#play img").attr("src", "../img/pause.png");
//   } else {
//     song.pause();
//     $("#play img").attr("src", "../img/play.png");
//   }
// }

song.addEventListener("timeupdate", function() {
  const position = song.currentTime / song.duration;
  fill.style.width = position * 100 + "%";
});
