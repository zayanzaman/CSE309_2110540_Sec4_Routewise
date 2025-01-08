const hamburger = document.querySelector(".hamburger");
const navMenu = document.getElementById("nav-menu");

hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("open");

    // Menu visibility will be managed via CSS transitions
    if (navMenu.classList.contains("open")) {
        navMenu.style.visibility = "visible"; // Menu is visible when opening
    } else {
        setTimeout(() => {
            navMenu.style.visibility = "hidden"; // Menu is hidden after transition
        }, 300); // Match the CSS transition time
    }
});

document.querySelector('.filter-button').addEventListener('click', function(e) {
    e.preventDefault();

    let filters = new URLSearchParams();

    document.querySelectorAll('.filter-options input:checked').forEach(input => {
        filters.set(input.name, input.value);
    });

    let newUrl = window.location.pathname + '?' + filters.toString();
    window.history.pushState(null, '', newUrl);

    window.location.reload();
});

function resetFilters() {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.delete('acfacility');
    urlParams.delete('capacity');
    urlParams.delete('studentpass');
    urlParams.delete('wheelchair');

    window.location.search = urlParams.toString();
}

document.querySelectorAll('.faq-toggle').forEach(button => {
    button.addEventListener('click', () => {
        const answer = button.nextElementSibling;

        if (answer.style.display === "block") {
            answer.style.display = "none";
        } else {
            answer.style.display = "block";
        }
    });
});

document.querySelectorAll('.faq-title.faq-toggle').forEach((button) => {
    button.addEventListener('click', () => {
        const faqTitle = button;
        const arrow = faqTitle.querySelector('::after');

        faqTitle.classList.toggle('rotated');
    });
});
