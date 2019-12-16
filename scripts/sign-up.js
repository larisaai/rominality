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
  