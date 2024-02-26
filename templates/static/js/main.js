
//--- Scroll ----
ScrollReveal({
  reset: true,
  distance: '80px',
  duration: 3000,
  delay:100
});
ScrollReveal().reveal('.welcomePara, .welcomeTxt', { origin: 'top' });
ScrollReveal().reveal('.logoHome img', { origin: 'left' });
ScrollReveal().reveal('.testBtn a', { origin: 'bottom'});
ScrollReveal().reveal('.sayGoodbye, .boxView', { origin: 'right' });
ScrollReveal().reveal('.mainServiceWrapper h2', { origin: 'top'});
ScrollReveal().reveal('.aboutSection h2', { origin: 'top'});
ScrollReveal().reveal('.aboutSection img', { origin: 'bottom'});
ScrollReveal().reveal('.aboutSection p', { origin: 'right'});
ScrollReveal().reveal('.containerContact h2', { origin: 'top'});

// Image Uploading Section
function uploadImage() {
  const fileInput = document.getElementById("chooseFile");
  const uploadedImage = document.getElementById("toUpld");
  const upLdImage = document.querySelector(".upLdImage");

  if (fileInput.files.length > 0) {
    const file = fileInput.files[0];
    if (file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = function(event) {
        uploadedImage.src = event.target.result;
        upLdImage.style.display = "block"; 
      };
      reader.readAsDataURL(file);
    } else {
      alert("Please select an image file.");
    }
  } else {
    alert("Please choose a file to upload.");
  }
}

//---- Create Menu ----
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}
function closeNav() {
  document.getElementById("myNav").style.width = "0";
}