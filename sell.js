// Get all the house blocks
const houseBlocks = document.querySelectorAll('.house-block');

// Function to check if element is in viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Function to handle scroll event
function onScroll() {
    // Loop through each house block
    houseBlocks.forEach((block) => {
        // If the block is in the viewport, add a class to make it appear
        if (isInViewport(block)) {
            block.classList.add('visible');
        }
    });
}

// Add scroll event listener
window.addEventListener('scroll', onScroll);

// Initially check if any elements are in viewport on page load
window.addEventListener('DOMContentLoaded', onScroll);
