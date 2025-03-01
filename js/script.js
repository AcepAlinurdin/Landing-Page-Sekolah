
// document.addEventListener("DOMContentLoaded", function () {
//     const contactForm = document.getElementById("contact-form");

//     if (contactForm) {
//         contactForm.addEventListener("submit", function (e) {
//             e.preventDefault();

//             const submitButton = contactForm.querySelector("button");
//             submitButton.disabled = true; 
            
//             const formData = new FormData(contactForm);
//             const responseMessage = document.getElementById("response-message");

//             fetch("php/contact.php", {
//                 method: "POST",
//                 body: formData
//             })
//             .then(response => response.json())
//             .then(data => {
//                 responseMessage.textContent = data.message;
//                 responseMessage.style.color = data.status === "success" ? "green" : "red";

//                 if (data.status === "success") {
//                     contactForm.reset(); 
//                 }

//                 submitButton.disabled = false; 
//             })
//             .catch(error => {
//                 responseMessage.textContent = "Terjadi kesalahan, coba lagi.";
//                 responseMessage.style.color = "red";
//                 console.error("Error:", error);
//                 submitButton.disabled = false;
//             });
//         });
//     }
// });
