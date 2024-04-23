/*
	Student Name: Joseph Garwood
	Student Number: 041085246
	Date: March 14 2024
	Prof: Alem Legesse
	Course: CST 8285
*/

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
    
    /* if dark mode is enabed, set the icon to a sun */
    if(body.classList.contains('dark-mode')){
        toggleImage.src='../images/sun.png';
    /* if dark mode is not enabled, set icon to a moon */
    } else{
        toggleImage.src='../images/moon.png';
    }
}