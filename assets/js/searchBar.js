document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('place-search');
    const searchResults = document.getElementById('search-results');
    const places = window.searchPlacesData || [];
    let debounceTimer;

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const query = this.value.trim().toLowerCase();
        
        if (query.length < 2) {
            searchResults.classList.remove('active');
            return;
        }
        
        debounceTimer = setTimeout(() => {
            const results = searchPlaces(query);
            displayResults(results, query);
        }, 300);
    });

    function searchPlaces(query) {
        return places.filter(place => 
            place.place_name.toLowerCase().includes(query)
        ).slice(0, 6);
    }

    function highlightText(text, query) {
        if (!query) return text;
        const regex = new RegExp(`(${query})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }

    function displayResults(results, query) {
        searchResults.innerHTML = '';
        
        if (results.length === 0) {
            const noResults = document.createElement('div');
            noResults.className = 'search-no-results';
            noResults.innerHTML = `
                <i class="fas fa-search"></i>
                <span>No destinations found<br>Try different keywords</span>
            `;
            searchResults.appendChild(noResults);
        } else {
            results.forEach((place, index) => {
                const resultItem = document.createElement('a');
                resultItem.className = 'search-result-item';
                resultItem.href = `otherPages/place-choice.php?place_id=${place.place_id}`;
                resultItem.style.animationDelay = `${index * 0.05}s`;
                resultItem.innerHTML = `
                    <div class="search-result-img">
                        <img src="assets/images/${place.place_img}" alt="${place.place_name}">
                    </div>
                    <div class="search-result-text">
                        <h4>${highlightText(place.place_name, query)}</h4>
                    </div>
                `;
                searchResults.appendChild(resultItem);
            });
        }
        
        searchResults.classList.add('active');
    }

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target)) {
            searchResults.classList.remove('active');
        }
    });
});