let search = document.getElementsByClassName('search-input')[0]; //variables
const searchbtn = document.getElementsByClassName('search-btn')[0];

searchbtn.addEventListener('click', function(event) { //event listener
    event.preventDefault();
    if (search.value=='') {
        alert('Please enter a search term.');
    } else {
        alert(`Couldn\'t find any results for "${search.value}". Please try again.`);
    }
});



function openwhatsapp() { //reusuable function to open whatsapp chat
    const phoneNumber = "919703060818"; 
    const message = encodeURIComponent(
      "Hi! I’m interested in buying this book. Please share more details."
    );

    const url = `https://wa.me/${phoneNumber}?text=${message}`;
    window.open(url, "_blank");
  }

    function subscribed(event){
        alert("Thank you for subscribing!"); //pop up message
    }
