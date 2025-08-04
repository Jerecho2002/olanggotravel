// Global variables
let locations = [
    {
        id: 1,
        name: "Island Eco-Tourism Park",
        category: "relaxation",
        address: "Asinan, Sabang",
        description: "A peaceful retreat surrounded by coconut trees, perfect for camping and stargazing.",
        activities: ["relaxation", "beach", "camping"],
        entrance: "₱15",
        image: "./images/island-eco-tourism-park.jpg",
        duration: "2-3 hours",
        bestTime: "Anytime",
        highlights: ["Camping ground", "Beach with shallow waters", "Grilling area", "Stargazing"]
    },
    {
        id: 2,
        name: "San Vicente Marine Sanctuary",
        category: "nature",
        address: "San Vicente, Olango",
        description: "A protected marine area with a wooden boardwalk through mangrove forests.",
        activities: ["nature", "wildlife", "photography"],
        entrance: "₱30",
        image: "./images/san-vicente-marine-sanctuary.jpg",
        duration: "1-2 hours",
        bestTime: "Early morning or late afternoon",
        highlights: ["Mangrove boardwalk", "Bird watching", "Marine conservation", "Educational tour"]
    },
    {
        id: 3,
        name: "Olango Wildlife Sanctuary",
        category: "nature",
        address: "Olango Island",
        description: "A 4,482-hectare protected area and key site for migratory birds from Siberia and China.",
        activities: ["nature", "wildlife", "photography"],
        entrance: "₱20",
        image: "./images/olango-wildlife-sanctuary.jpg",
        duration: "2-4 hours",
        bestTime: "November to February (migratory season)",
        highlights: ["97 bird species", "40,000+ migratory birds", "Ramsar Site wetland", "Bird watching towers"]
    },
    {
        id: 4,
        name: "Island Cycling Adventure",
        category: "adventure",
        address: "Candagaso, Talima",
        description: "Explore the northern part of the island with scenic coastal views and local villages.",
        activities: ["adventure", "cycling", "scenic"],
        entrance: "₱20/hour",
        image: "./images/island-cycling-adventure.jpg",
        duration: "3-4 hours",
        bestTime: "Early morning or late afternoon",
        highlights: ["Coastal cycling paths", "Local village tours", "Scenic viewpoints", "Cultural immersion"]
    },
    {
        id: 5,
        name: "Talima Historical Ruins",
        category: "cultural",
        address: "Talima",
        description: "Explore the remnants of ancient structures with scenic ocean views.",
        activities: ["cultural", "historical", "scenic"],
        entrance: "Free",
        image: "./images/talima-historical-ruins.jpg",
        duration: "1-2 hours",
        bestTime: "Sunset",
        highlights: ["Ancient stone structures", "Historical significance", "Ocean panorama", "Photography spots"]
    }
];

let currentEditingId = null;
let activities = [];

// DOM elements
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');
const navLinks = document.querySelectorAll('.nav-link');
const contentSections = document.querySelectorAll('.content-section');
const locationModal = document.getElementById('locationModal');
const confirmModal = document.getElementById('confirmModal');
const locationForm = document.getElementById('locationForm');
const locationsGrid = document.getElementById('locationsGrid');
const locationSearch = document.getElementById('locationSearch');
const categoryFilter = document.getElementById('categoryFilter');

// Initialize the application
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
    renderLocations();
    updateStats();
    setupEventListeners();
});

// Initialize application
function initializeApp() {
    // Set default active section
    showSection('dashboard');
    
    // Load activities from locations
    loadActivities();
    
    // Setup form validation
    setupFormValidation();
}

// Setup event listeners
function setupEventListeners() {
    // Mobile navigation toggle
    hamburger.addEventListener('click', toggleMobileNav);
    
    // Navigation links
    navLinks.forEach(link => {
        link.addEventListener('click', handleNavigation);
    });
    
    // Location form submission
    locationForm.addEventListener('submit', handleLocationSubmit);
    
    // Search and filter
    locationSearch.addEventListener('input', filterLocations);
    categoryFilter.addEventListener('change', filterLocations);
    
    // Close modals when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === locationModal) {
            closeLocationModal();
        }
        if (e.target === confirmModal) {
            closeConfirmModal();
        }
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLocationModal();
            closeConfirmModal();
        }
    });
}

// Toggle mobile navigation
function toggleMobileNav() {
    hamburger.classList.toggle('active');
    navMenu.classList.toggle('active');
}

// Handle navigation
function handleNavigation(e) {
    e.preventDefault();
    const href = e.target.getAttribute('href');
    if (href && href.startsWith('#')) {
        const sectionId = href.substring(1);
        showSection(sectionId);
        
        // Close mobile menu if open
        if (navMenu.classList.contains('active')) {
            toggleMobileNav();
        }
    }
}

// Show specific section
function showSection(sectionId) {
    // Update navigation
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${sectionId}`) {
            link.classList.add('active');
        }
    });
    
    // Update content sections
    contentSections.forEach(section => {
        section.classList.remove('active');
        if (section.id === sectionId) {
            section.classList.add('active');
        }
    });
    
    // Load section-specific data
    if (sectionId === 'locations') {
        renderLocations();
    } else if (sectionId === 'analytics') {
        loadAnalytics();
    }
}

// Load activities from locations
function loadActivities() {
    const activitySet = new Set();
    locations.forEach(location => {
        location.activities.forEach(activity => {
            activitySet.add(activity);
        });
    });
    activities = Array.from(activitySet);
}

// Update dashboard stats
function updateStats() {
    document.getElementById('totalLocations').textContent = locations.length;
    
    // Simulate other stats
    const visitors = Math.floor(Math.random() * 500) + 1000;
    const bookings = Math.floor(Math.random() * 50) + 50;
    const rating = (Math.random() * 0.5 + 4.5).toFixed(1);
    
    document.getElementById('totalVisitors').textContent = visitors.toLocaleString();
    document.getElementById('totalBookings').textContent = bookings;
    document.getElementById('avgRating').textContent = rating;
}

// Render locations grid
function renderLocations() {
    const filteredLocations = getFilteredLocations();
    
    locationsGrid.innerHTML = '';
    
    if (filteredLocations.length === 0) {
        locationsGrid.innerHTML = `
            <div class="no-results">
                <i class="fas fa-search"></i>
                <h3>No locations found</h3>
                <p>Try adjusting your search criteria or add a new location.</p>
            </div>
        `;
        return;
    }
    
    filteredLocations.forEach(location => {
        const locationCard = createLocationCard(location);
        locationsGrid.appendChild(locationCard);
    });
}

// Create location card element
function createLocationCard(location) {
    const card = document.createElement('div');
    card.className = 'location-card';
    card.innerHTML = `
        <img src="${location.image}" alt="${location.name}" class="location-image" 
             onerror="this.style.background='linear-gradient(135deg, #667eea, #764ba2)'; this.style.display='flex'; this.style.alignItems='center'; this.style.justifyContent='center'; this.innerHTML='<i class=\\"fas fa-image\\" style=\\"color: white; font-size: 2rem;\\"></i>'">
        <div class="location-content">
            <div class="location-header">
                <div>
                    <h3 class="location-title">${location.name}</h3>
                    <span class="location-category">${formatCategoryName(location.category)}</span>
                </div>
            </div>
            <div class="location-details">
                <p><i class="fas fa-map-marker-alt"></i> ${location.address}</p>
                <p><i class="fas fa-clock"></i> ${location.duration}</p>
                <p><i class="fas fa-ticket-alt"></i> ${location.entrance}</p>
                <p class="description">${location.description}</p>
            </div>
            <div class="location-actions">
                <button class="edit-btn" onclick="editLocation(${location.id})">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="delete-btn" onclick="confirmDeleteLocation(${location.id})">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        </div>
    `;
    return card;
}

// Get filtered locations based on search and category
function getFilteredLocations() {
    const searchTerm = locationSearch.value.toLowerCase();
    const selectedCategory = categoryFilter.value;
    
    return locations.filter(location => {
        const matchesSearch = location.name.toLowerCase().includes(searchTerm) ||
                            location.address.toLowerCase().includes(searchTerm) ||
                            location.description.toLowerCase().includes(searchTerm);
        
        const matchesCategory = !selectedCategory || location.category === selectedCategory;
        
        return matchesSearch && matchesCategory;
    });
}

// Filter locations
function filterLocations() {
    renderLocations();
}

// Format category name for display
function formatCategoryName(category) {
    const categoryNames = {
        'water': 'Water Activities',
        'nature': 'Nature & Wildlife',
        'adventure': 'Adventure',
        'cultural': 'Cultural',
        'relaxation': 'Relaxation',
        'dining': 'Dining'
    };
    return categoryNames[category] || category.charAt(0).toUpperCase() + category.slice(1);
}

// Show add location modal
function showAddLocationModal() {
    currentEditingId = null;
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus"></i> Add New Location';
    locationForm.reset();
    showModal(locationModal);
}

// Edit location
function editLocation(id) {
    const location = locations.find(loc => loc.id === id);
    if (!location) return;
    
    currentEditingId = id;
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit"></i> Edit Location';
    
    // Populate form with location data
    document.getElementById('locationName').value = location.name;
    document.getElementById('locationCategory').value = location.category;
    document.getElementById('locationAddress').value = location.address;
    document.getElementById('entranceFee').value = location.entrance;
    document.getElementById('locationDescription').value = location.description;
    document.getElementById('duration').value = location.duration;
    document.getElementById('bestTime').value = location.bestTime;
    document.getElementById('activities').value = location.activities.join(', ');
    document.getElementById('highlights').value = location.highlights.join('\\n');
    document.getElementById('locationImage').value = location.image;
    
    showModal(locationModal);
}

// Confirm delete location
function confirmDeleteLocation(id) {
    const location = locations.find(loc => loc.id === id);
    if (!location) return;
    
    document.getElementById('confirmTitle').textContent = 'Delete Location';
    document.getElementById('confirmMessage').textContent = `Are you sure you want to delete "${location.name}"? This action cannot be undone.`;
    
    const confirmButton = document.getElementById('confirmButton');
    confirmButton.onclick = () => {
        deleteLocation(id);
        closeConfirmModal();
    };
    
    showModal(confirmModal);
}

// Delete location
function deleteLocation(id) {
    locations = locations.filter(loc => loc.id !== id);
    renderLocations();
    updateStats();
    addActivity('Location deleted', 'delete');
    showNotification('Location deleted successfully', 'success');
}

// Handle location form submission
function handleLocationSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(locationForm);
    const locationData = {
        name: document.getElementById('locationName').value,
        category: document.getElementById('locationCategory').value,
        address: document.getElementById('locationAddress').value,
        entrance: document.getElementById('entranceFee').value || 'Free',
        description: document.getElementById('locationDescription').value,
        duration: document.getElementById('duration').value || '1-2 hours',
        bestTime: document.getElementById('bestTime').value || 'Anytime',
        activities: document.getElementById('activities').value.split(',').map(a => a.trim()).filter(a => a),
        highlights: document.getElementById('highlights').value.split('\\n').filter(h => h.trim()),
        image: document.getElementById('locationImage').value || './images/default-location.jpg'
    };
    
    if (currentEditingId) {
        // Update existing location
        const index = locations.findIndex(loc => loc.id === currentEditingId);
        if (index !== -1) {
            locations[index] = { ...locations[index], ...locationData };
            addActivity(`Location updated: ${locationData.name}`, 'edit');
            showNotification('Location updated successfully', 'success');
        }
    } else {
        // Add new location
        const newLocation = {
            id: Date.now(),
            ...locationData
        };
        locations.push(newLocation);
        addActivity(`New location added: ${locationData.name}`, 'add');
        showNotification('Location added successfully', 'success');
    }
    
    renderLocations();
    updateStats();
    closeLocationModal();
}

// Setup form validation
function setupFormValidation() {
    const requiredFields = ['locationName', 'locationCategory', 'locationAddress', 'locationDescription'];
    
    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('blur', validateField);
            field.addEventListener('input', clearFieldError);
        }
    });
}

// Validate individual field
function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    
    if (!value) {
        showFieldError(field, 'This field is required');
    } else {
        clearFieldError(field);
    }
}

// Show field error
function showFieldError(field, message) {
    clearFieldError(field);
    
    field.style.borderColor = '#dc3545';
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.color = '#dc3545';
    errorDiv.style.fontSize = '0.875rem';
    errorDiv.style.marginTop = '0.25rem';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
}

// Clear field error
function clearFieldError(field) {
    field.style.borderColor = '#e9ecef';
    const errorDiv = field.parentNode.querySelector('.field-error');
    if (errorDiv) {
        errorDiv.remove();
    }
}

// Show modal
function showModal(modal) {
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
    document.body.style.overflow = 'hidden';
}

// Close location modal
function closeLocationModal() {
    locationModal.classList.remove('show');
    setTimeout(() => {
        locationModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
    
    // Clear form errors
    const errorDivs = locationModal.querySelectorAll('.field-error');
    errorDivs.forEach(div => div.remove());
    
    const fields = locationModal.querySelectorAll('input, textarea, select');
    fields.forEach(field => {
        field.style.borderColor = '#e9ecef';
    });
}

// Close confirm modal
function closeConfirmModal() {
    confirmModal.classList.remove('show');
    setTimeout(() => {
        confirmModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}

// Add activity to recent activity list
function addActivity(message, type) {
    const activityList = document.getElementById('activityList');
    const activityItem = document.createElement('div');
    activityItem.className = 'activity-item';
    
    const iconClass = type === 'add' ? 'fa-plus-circle' : 
                     type === 'edit' ? 'fa-edit' : 
                     type === 'delete' ? 'fa-trash' : 'fa-info-circle';
    
    activityItem.innerHTML = `
        <div class="activity-icon">
            <i class="fas ${iconClass}"></i>
        </div>
        <div class="activity-content">
            <p><strong>${message}</strong></p>
            <span class="activity-time">Just now</span>
        </div>
    `;
    
    activityList.insertBefore(activityItem, activityList.firstChild);
    
    // Keep only the last 5 activities
    while (activityList.children.length > 5) {
        activityList.removeChild(activityList.lastChild);
    }
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 90px;
        right: 20px;
        background: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        z-index: 10001;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        max-width: 300px;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Load analytics data
function loadAnalytics() {
    // Simulate loading analytics data
    setTimeout(() => {
        showNotification('Analytics data loaded', 'success');
    }, 500);
}

// Export data
function exportData() {
    const dataStr = JSON.stringify(locations, null, 2);
    const dataBlob = new Blob([dataStr], {type: 'application/json'});
    const url = URL.createObjectURL(dataBlob);
    
    const link = document.createElement('a');
    link.href = url;
    link.download = 'olango-locations-export.json';
    link.click();
    
    URL.revokeObjectURL(url);
    showNotification('Data exported successfully', 'success');
}

// Show analytics
function showAnalytics() {
    showSection('analytics');
}

// Logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        showNotification('Logging out...', 'info');
        setTimeout(() => {
            window.location.href = 'index.html';
        }, 1000);
    }
}

// Utility functions
function generateId() {
    return Date.now() + Math.random().toString(36).substr(2, 9);
}

function formatDate(date) {
    return new Intl.DateTimeFormat('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }).format(date);
}

// Auto-save functionality
let autoSaveTimer;
function scheduleAutoSave() {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(() => {
        localStorage.setItem('olango-locations', JSON.stringify(locations));
        console.log('Data auto-saved');
    }, 5000);
}

// Load data from localStorage on page load
function loadSavedData() {
    const savedData = localStorage.getItem('olango-locations');
    if (savedData) {
        try {
            const parsedData = JSON.parse(savedData);
            if (Array.isArray(parsedData) && parsedData.length > 0) {
                locations = parsedData;
                console.log('Loaded saved data');
            }
        } catch (e) {
            console.error('Error loading saved data:', e);
        }
    }
}

// Initialize saved data on load
document.addEventListener('DOMContentLoaded', function() {
    loadSavedData();
});

// Save data whenever locations change
function saveData() {
    scheduleAutoSave();
}

// Override location modification functions to include auto-save
const originalDeleteLocation = deleteLocation;
deleteLocation = function(id) {
    originalDeleteLocation(id);
    saveData();
};

const originalHandleLocationSubmit = handleLocationSubmit;
handleLocationSubmit = function(e) {
    originalHandleLocationSubmit(e);
    saveData();
};

