document.addEventListener('DOMContentLoaded', function() {
    const activityFilters = document.querySelectorAll('.activity-filter');
    const categoryFilters = document.querySelectorAll('.category-filter');
    const clearBtn = document.querySelector('.clear-btn');
    const placeContainer = document.querySelector('.places-container');
    const noSelectionMsg = document.getElementById('no-selection-message');

    function filterPlaces() {
        const selectedActivities = Array.from(document.querySelectorAll('.activity-filter:checked'))
                                      .map(el => el.value);
        const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked'))
                                      .map(el => el.value);

        // Toggle containers
        if (selectedActivities.length === 0 && selectedCategories.length === 0) {
            placeContainer.style.display = 'none';
            noSelectionMsg.style.display = 'block';
            return;
        } else {
            placeContainer.style.display = 'grid';
            noSelectionMsg.style.display = 'none';
        }

        // Filter places
        const placeCards = document.querySelectorAll('.place-card');
        placeCards.forEach(card => {
            const cardActivities = card.dataset.activities.split(',');
            const cardCategories = card.dataset.categories.split(',');

            const showCard = 
                (selectedActivities.length === 0 || selectedActivities.some(a => cardActivities.includes(a))) &&
                (selectedCategories.length === 0 || selectedCategories.some(c => cardCategories.includes(c)));

            card.style.display = showCard ? 'block' : 'none';
        });
    }

    // Event listeners
    activityFilters.forEach(filter => filter.addEventListener('change', filterPlaces));
    categoryFilters.forEach(filter => filter.addEventListener('change', filterPlaces));
    
    clearBtn.addEventListener('click', function() {
        activityFilters.forEach(filter => filter.checked = false);
        categoryFilters.forEach(filter => filter.checked = false);
        filterPlaces();
    });
});