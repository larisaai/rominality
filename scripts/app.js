

var fbButton = document.getElementById('fb-share-button');
var url = window.location.href;

fbButton.addEventListener('click', function() {
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + url,
        'facebook-share-dialog',
        'width=800,height=600'
    );
    return false;
});


//delete account button functionality
document.querySelector(".delete-btn").addEventListener("click", function(){
  document.querySelector(".delete-account-container").style.display = "block";
});

document.querySelector(".cancel-btn").addEventListener("click", function(){
  document.querySelector(".delete-account-container").style.display = "none";
});
