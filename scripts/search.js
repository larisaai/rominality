$("#searchInput").keyup(function() {
  let parentResults = document.getElementById("searchResults");
  parentResults.innerHTML = "";
  value = $(this).val();
  console.log(value);
  if (value != "") {
    $.ajax({
      method: "GET",
      url: "../includes/searchForSong.php?currentSearch=" + value
    }).done(function(data) {
      var result = $.parseJSON(data);

      let songs = result.items;
      if (songs.length > 0) {
        songs.forEach(song => {
          let p = document.createElement("p");
          p.classList.add("foundItem");
          parentResults.appendChild(p);

          p.innerHTML = song.song_title;
        });
      } else {
        let p = document.createElement("p");
        parentResults.appendChild(p);
        p.innerHTML = "No items found";
      }

      //pentru fiecare element pe care il primesti prin forEach, append <p> la div-ul searchedItems
    });
  } else {
    parentResults.innerHTML = "";
  }
});

$("#searchResults").on("click", ".foundItem", function() {
  console.log(this.innerHTML);
  document.getElementById("searchInput").value = this.innerHTML;
  document.getElementById("searchResults").innerHTML = "";
});

function createAudioElement(
  songTitle,
  artistName,
  songPath,
  songId,
  songPrice
) {
  let parentDiv = document.createElement("div");
  parentDiv.setAttribute("class", "player-component");
  document.getElementById("songs-container").appendChild(parentDiv);

  let songTitleElement = document.createElement("h3");
  songTitleElement.innerHTML = songTitle;
  parentDiv.appendChild(songTitleElement);

  let tagsContainer = document.createElement("div");
  tagsContainer.setAttribute("class", "tags-container");
  parentDiv.appendChild(tagsContainer);

  var artistName = document.createElement("p");
  artistName.innerHTML = artistName + " - " + songTitle;
  tagsContainer.appendChild(artistName);

  let tagsDiv = document.createElement("div");
  tagsDiv.setAttribute("class", "tags");
  tagsContainer.appendChild(tagsDiv);

  //I will fill uo the tags div with the attributes later - Razvan

  //now you start from seek bar
  let seekBarDiv = document.createElement("div");
  seekBarDiv.setAttribute("id", "seek-bar");
  parentDiv.appendChild(seekBarDiv);

  let fillSeekBar = document.createElement("div");
  fillSeekBar.setAttribute("id", "fill");
  seekBarDiv.appendChild(fillSeekBar);

  let handleSeekBar = document.createElement("div");
  handleSeekBar.setAttribute("id", "handle");
  seekBarDiv.appendChild(handleSeekBar);

  let audioFile = document.createElement("audio");
  parentDiv.appendChild(audioFile);

  let sourceAudioFile = document.createElement("source");
  sourceAudioFile.setAttribute("src", "../uploads/" + songPath + ".mp3");
  sourceAudioFile.setAttribute("type", "audio/mpeg");
  audioFile.appendChild(sourceAudioFile);

  let infoAboutSongDiv = document.createElement("div");
  infoAboutSongDiv.setAttribute("class", "infoAboutSong");
  parentDiv.appendChild(infoAboutSongDiv);

  let playerDiv = document.createElement("div");
  playerDiv.setAttribute("id", "player");
  infoAboutSongDiv.appendChild(playerDiv);

  let aTagPlay = document.createElement("a");
  aTagPlay.setAttribute("id", "play");
  aTagPlay.setAttribute("class", "play");
  playerDiv.appendChild(aTagPlay);

  let imgTagPlay = document.createElement("img");
  imgTagPlay.setAttribute("src", "../img/play.png");
  aTagPlay.appendChild(imgTagPlay);

  let aTagLike = document.createElement("a");
  infoAboutSongDiv.appendChild(aTagLike);

  let imgTagLike = document.createElement("img");
  imgTagLike.setAttribute("class", "like");
  imgTagLike.setAttribute("src", "../img/like.svg");
  aTagLike.appendChild(imgTagLike);

  let detailsContainer = document.createElement("details");
  infoAboutSongDiv.appendChild(detailsContainer);

  let summaryDiv = document.createElement("summary");
  summaryDiv.innerHTML = "Add comment";
  detailsContainer.appendChild(summaryDiv);

  let commentDiv = document.createElement("div");
  commentDiv.setAttribute("class", "commentDiv");
  commentDiv.setAttribute("songId", +songId);
  detailsContainer.appendChild(commentDiv);

  let pTagCommentDiv = document.createElement("p");
  commentDiv.appendChild(pTagCommentDiv);

  // CHECK IF SPANS  with username and comment WORK, if NOT you need to add them

  let addCommentDiv = document.createElement("div");
  detailsContainer.appendChild(addCommentDiv);

  let inputComment = document.createElement("input");
  inputComment.setAttribute("type", "text");
  inputComment.setAttribute("placeholder", "Add comment here");
  inputComment.setAttribute("id", "commentId");
  inputComment.setAttribute("songId", songId);
  addCommentDiv.appendChild(inputComment);

  let buttonAddComment = document.createElement("button");
  buttonAddComment.setAttribute("class", "addComment");
  buttonAddComment.innerHTML = "Add";
  addCommentDiv.appendChild(buttonAddComment);

  let pTagPrice = document.createElement("p");
  pTagPrice.innerHTML = songPrice + "EUR";
  infoAboutSongDiv.appendChild(pTagPrice);

  let aTagAddToCart = document.createElement("a");
  aTagAddToCart.setAttribute("class", "cartButton");
  aTagAddToCart.setAttribute("id", "upload-btn");
  aTagAddToCart.setAttribute("value", songId);
}
