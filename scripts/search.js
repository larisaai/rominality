$("#searchInput").keyup(function () {
  let parentResults = document.getElementById("searchResults");
  parentResults.innerHTML = "";
  value = $(this).val();
  // console.log(value);
  if (value != "") {
    $.ajax({
      method: "GET",
      url: "../includes/searchForSong.php?currentSearch=" + value
    }).done(function (data) {
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
    });
  } else {
    parentResults.innerHTML = "";
  }
});

$("#searchResults").on("click", ".foundItem", function () {
  document.getElementById("searchInput").value = this.innerHTML;
  document.getElementById("searchResults").innerHTML = "";
});

$("#buttonSearch").on('click', function () {
  let searchBar = document.getElementById('searchInput');
  value = $(searchBar).val();

  if (value != "") {
    $.ajax({
      method: "GET",
      url: "../includes/searchForSong.php?currentSearch=" + value
    }).done(function (data) {
      var result = $.parseJSON(data);
      let songs = result.items;

      if (songs.length > 0) {
        document.getElementById('songs-container').innerHTML = '';
        songs.forEach(song => {
          document.getElementById('loadMore').style.display = 'none';
          createAudioElement(song.song_title, song.artist_name, song.path_id, song.id, song.price, getAttributesForSongId(song.id), song[0].profile_picture);
        });
      }
      addValueToCartButtons();
    });

  }
})

function getAttributesForSongId(id) {

  var s = $.ajax({
    async: false,
    method: "GET",
    url: "../includes/getAttributesForSong.php?id=" + id
  })
  var result = $.parseJSON(s.responseText);
  return result.attributesHTML;
}

$(function () {
  $("#songs-container").on('click', ".cartButton", function () {
    let buttonElement = $(this);
    let songId = $(this).attr('value');
    $.ajax({
        method: "GET",
        url: "../includes/addToCart.php?songId=" + songId
      })
      .done(function (data) {
        var result = $.parseJSON(data);
        if (result.status == 1) {
          document.getElementById('cartItems').innerHTML = result.itemNumber;

          buttonElement.addClass("addedToCart");
          buttonElement.html('Added to cart');
        }
      })
  })
})

function checkIfElementIsInCart(id, element) {
  $.ajax({
    url: '../includes/checkIfElementIsInCart.php?song_id=' + id
  }).done(function (data) {
    var result = $.parseJSON(data);
    if (result.status == 1) {
      element.classList.remove('notAddedToCart')
      element.classList.add('addedToCart');
      element.innerHTML = 'Added to cart';
    } else {
      element.classList.remove('addedToCart');
      element.classList.add('notAddedToCart');
      element.innerHTML = 'Add to cart';
    }
  })
}

function addValueToCartButtons() {
  cartButtons = document.querySelectorAll('.cartButton');
  cartButtons.forEach(item => {
    checkIfElementIsInCart(item.getAttribute('value'), item);
  })
}
setTimeout(addValueToCartButtons, 100);


function readComments() {
  let userComment = $('.user-comment');
  $.ajax({
      url: "../includes/getAllComents.php"
    })
    .done(function (data) {
      var result = $.parseJSON(data);
      let comments = result.comments;
      let commentDiv = document.querySelectorAll('.commentDiv');

      commentDiv.forEach(element => {
        let thisDiv = element;
        let songId = thisDiv.getAttribute('songId');
        thisDiv.innerHTML = '';

        comments.forEach(comment => {

          if (songId == comment.song_id) {
            var p = document.createElement('p');
            thisDiv.appendChild(p);

            var name = document.createElement('span');
            let nameDb = getUserNameById(comment.user_id)
            name.innerHTML = nameDb;
            p.append(name);

            var dash = " - ";
            p.append(dash)

            var commentBody = document.createElement('span');
            commentBody.innerHTML = comment.comment_body;
            p.append(commentBody);
          }
        })

      })
    })
}
readComments();
setInterval(readComments, 1000);

$(function () {
  $('#songs-container').on('click', ".addComment", function () {
    let currentElement = $(this).siblings();

    let songId = $(this).siblings('#commentId').attr('songId');
    let commentBody = $(this).siblings('#commentId').val();


    $.ajax({
        method: "GET",
        url: "../includes/addComment.php?songId=" + songId + "&&commentBody=" + commentBody + "",
      })
      .done(function (data) {
        var result = $.parseJSON(data);
        readComments();
      })
    currentElement.val('');
  })
})

function getUserNameById(user_id) {

  var s = $.ajax({
    async: false,
    method: "GET",
    url: "../includes/getUserNameByIdAPI.php?user_id=" + user_id
  })
  var result = $.parseJSON(s.responseText);
  return result.name;
}


function createAudioElement(
  songTitle,
  artistName,
  songPath,
  songId,
  songPrice,
  attributeHTML,
  profileUrl
) {

  let parentParentDiv = document.createElement("div");
  parentParentDiv.setAttribute("class", "player-component");
  document.getElementById("songs-container").appendChild(parentParentDiv);

  let parentDiv = document.createElement("div");
  parentDiv.setAttribute("class", "details-player-component");
  parentParentDiv.appendChild(parentDiv);

  let imageDiv = document.createElement("div");
  imageDiv.setAttribute("class", "image-artist");
  parentParentDiv.appendChild(imageDiv);

  let imageArtist = document.createElement('img');
  imageArtist.setAttribute('src', '..' + profileUrl);
  imageDiv.appendChild(imageArtist);


  let songTitleElement = document.createElement("h3");
  songTitleElement.innerHTML = songTitle;
  parentDiv.appendChild(songTitleElement);

  let tagsContainer = document.createElement("div");
  tagsContainer.setAttribute("class", "tags-container");
  parentDiv.appendChild(tagsContainer);

  let artist = document.createElement("p");
  artist.innerHTML = artistName + " - " + songTitle;
  tagsContainer.appendChild(artist);

  let tagsDiv = document.createElement("div");
  tagsDiv.setAttribute("class", "tags");
  tagsContainer.appendChild(tagsDiv);

  tagsDiv.innerHTML = attributeHTML;

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
  aTagAddToCart.innerHTML = 'Add to cart';
  infoAboutSongDiv.appendChild(aTagAddToCart);
}