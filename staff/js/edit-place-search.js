document.addEventListener('DOMContentLoaded', function () {
    // Configuration
    const config = {
        itemsPerPage: 2
    };

    // DOM Elements
    const searchInput = document.getElementById('searchInput');
    const placesTable = document.getElementById('placesTable');
    const placesTableBody = document.getElementById('placesTableBody');
    const noResults = document.getElementById('noResults');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const pageInfo = document.getElementById('pageInfo');

    // State
    let currentPage = 1;
    let totalPages = 1;
    let allPlaces = window.placesData || [];
    let filteredPlaces = [];

    // Filter places by current location_id if set
    if (window.currentLocationId) {
        allPlaces = allPlaces.filter(place => place.location_id == window.currentLocationId);
    }

    // Initialize places table as visible
    placesTable.style.display = 'table';
    noResults.style.display = 'none';

    // Search input event listener
    searchInput.addEventListener('input', function () {
        currentPage = 1;
        filterPlaces();
    });

    // Previous button click handler
    prevBtn.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            renderPlaces();
            updatePagination();
        }
    });

    // Next button click handler
    nextBtn.addEventListener('click', function () {
        if (currentPage < totalPages) {
            currentPage++;
            renderPlaces();
            updatePagination();
        }
    });

    // Filter places based on search input
    function filterPlaces() {
        const searchTerm = searchInput.value.toLowerCase();

        filteredPlaces = allPlaces.filter(place => {
            return searchTerm === '' ||
                place.place_name.toLowerCase().includes(searchTerm);
        });

        updatePagination();
        renderPlaces();
    }

    // Render places for current page
    function renderPlaces() {
        const startIndex = (currentPage - 1) * config.itemsPerPage;
        const endIndex = startIndex + config.itemsPerPage;
        const placesToShow = filteredPlaces.slice(startIndex, endIndex);

        placesTableBody.innerHTML = '';

        if (placesToShow.length === 0 && searchInput.value !== '') {
            noResults.style.display = 'block';
            placesTable.style.display = 'none';
        } else {
            noResults.style.display = 'none';
            placesTable.style.display = 'table';

            placesToShow.forEach(place => {
                const row = document.createElement('tr');
                row.addEventListener('click', function () {
                    // Remove selected class from all rows
                    document.querySelectorAll('#placesTableBody tr').forEach(r => {
                        r.classList.remove('selected-place');
                    });

                    // Add selected class to clicked row
                    row.classList.add('selected-place');

                    // Redirect to edit page with place ID
                    window.location.href = `edit-place-details.php?place_id=${place.place_id}`;
                });

                row.innerHTML = `
                            <td><img src="../assets/images/${place.place_img}" alt="${place.place_name}" style="width:60px;height:60px;object-fit:cover;"></td>
                            <td>${place.place_name}</td>
                        `;

                placesTableBody.appendChild(row);
            });
        }
    }

    // Update pagination controls
    function updatePagination() {
        totalPages = Math.max(1, Math.ceil(filteredPlaces.length / config.itemsPerPage));
        currentPage = Math.max(1, Math.min(currentPage, totalPages));

        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
        prevBtn.disabled = currentPage <= 1;
        nextBtn.disabled = currentPage >= totalPages;

        // Show/hide based on whether pagination is needed
        const showPagination = filteredPlaces.length > config.itemsPerPage;
        prevBtn.style.display = showPagination ? 'block' : 'none';
        nextBtn.style.display = showPagination ? 'block' : 'none';
        pageInfo.style.display = showPagination ? 'block' : 'none';
    }

    // Initial render
    filterPlaces();
});