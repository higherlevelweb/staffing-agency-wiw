// ** main.js - JavaScript Page Functions ** //
// Window listener for resize event to reset responsive menu and arrtibute tags 
document.addEventListener("DOMContentLoaded", function (event) {
    // This method should be debounced for permormance, so that it doesn't have to execute on every resize event, but only once the user is done resizing.
    var removeResponsiveAttributes = debounce(function () {
        var element = document.getElementById("site-navigation");
        if (window.innerWidth >= 768 && element.classList.contains('toggled')) {
            element.classList.remove('toggled')
        }
    }, 200);
    window.addEventListener('resize', removeResponsiveAttributes);
});

// Reusable debouncing function (for window resize event)
// This function returns a function, that, as long as it continues to be invoked, will not be triggered. 
// It will only be called after it stops being called for N milliseconds. 
function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this, args = arguments;
        var later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

document.addEventListener('wpcf7mailsent', function (event) {
    document.querySelectorAll("form.wpcf7-form > :not(.wpcf7-response-output)").forEach(el => {
        el.style.display = 'none';
    });
}, false);

