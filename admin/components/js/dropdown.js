function toggleDropdown() {
	var dropdownMenu = document.querySelector('.dropdown-menu');
	dropdownMenu.classList.toggle('show');
}

window.addEventListener('click', function(event) {
	var dropdownMenu = document.querySelector('.dropdown-menu');
	var profile = document.querySelector('.profile');
	if (!profile.contains(event.target) && !dropdownMenu.contains(event.target)) {
		dropdownMenu.classList.remove('show');
	}
});

document.querySelector('.profile').addEventListener('click', function(event) {
    event.stopPropagation(); 
    toggleDropdown();
});
