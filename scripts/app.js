

var fbButton = document.getElementById('fb-share-button');
var url = window.location.href;

fbButton.addEventListener('click', function() {
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + url,
        'facebook-share-dialog',
        'width=800,height=600'
    );
    return false;
});



//signup as a user or as a producer
document.querySelector(".producer-sigup-btn-container").addEventListener("click", function(){
  document.querySelector(".user-signup").classList.remove("active");
  document.querySelector(".producer-sigup-btn-container").classList.add("active");
  document.querySelector(".producer-signup").classList.add("active");
  document.querySelector(".user-sigup-btn-container").classList.remove("active");
  
});

document.querySelector(".user-sigup-btn-container").addEventListener("click", function(){
  document.querySelector(".user-signup").classList.add("active");
  document.querySelector(".producer-sigup-btn-container").classList.remove("active");
  document.querySelector(".producer-signup").classList.remove("active");
  document.querySelector(".user-sigup-btn-container").classList.add("active");
});



//delete account button functionality
document.querySelector(".delete-btn").addEventListener("click", function(){
  document.querySelector(".delete-account-container").style.display = "block";
});

document.querySelector(".cancel-btn").addEventListener("click", function(){
  document.querySelector(".delete-account-container").style.display = "none";
});

