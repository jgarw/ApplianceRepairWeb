/* Ensure reviews are hidden on page load */
document.addEventListener("DOMContentLoaded", function() {
    const reviews = document.getElementById('reviews');
    reviews.style.display = 'none';
});

/* Create a function to show the reviews when button is clicked */
function toggleReviews(){

    /* If button is clicked and reviews ARE NOT shown, show them.*/
    if(reviews.style.display =='none'){
        reviews.style.display = "block";
    }else{ /* If button is clicked and reviews ARE shown, hide them. */
        reviews.style.display = "none";
    }

}

/* create a function to enable/disable dark-mode on the site */
function darkMode(){

            const body = document.body;
            document.body.classList.toggle('dark-mode');

            const toggleImage = document.getElementById('toggle-image').getElementsByTagName('img')[0];

            if(body.classList.contains('dark-mode')){
                toggleImage.src='images/sun.png';
            } else{
                toggleImage.src='images/moon.png';
            }

}