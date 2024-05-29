// SIDEBAR DROPDOWN
document.addEventListener('DOMContentLoaded', function() {
    var dropdownToggles = document.querySelectorAll('#sidebar .side-menu > li');

    dropdownToggles.forEach(function(item) {
        item.addEventListener('click', function(event) {
            var dropdown = this.querySelector('.side-dropdown');
            var submenuItems = dropdown.querySelectorAll('li');
            var isActive = false;
            submenuItems.forEach(function(submenuItem) {
                if (submenuItem.classList.contains('active')) {
                    isActive = true;
                }
            });
            if (!isActive) {
                if (dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                } else {
                    // Close all other dropdowns
                    var allDropdowns = document.querySelectorAll('#sidebar .side-dropdown');
                    allDropdowns.forEach(function(d) {
                        d.classList.remove('show');
                    });
                    
                    dropdown.classList.add('show');
                }
            }
        });
    });

    // close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        var clickedElement = event.target;
        if (!clickedElement.closest('.side-menu')) {
            var allDropdowns = document.querySelectorAll('#sidebar .side-dropdown');
            allDropdowns.forEach(function(d) {
                d.classList.remove('show');
            });
        }
    });
});

// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const allSideDivider = document.querySelectorAll('#sidebar .divider');

if(sidebar.classList.contains('hide')) {
	allSideDivider.forEach(item=> {
		item.textContent = '-'
	})
	allDropdown.forEach(item=> {
		const a = item.parentElement.querySelector('a:first-child');
		a.classList.remove('active');
		item.classList.remove('show');
	})
} else {
	allSideDivider.forEach(item=> {
		item.textContent = item.dataset.text;
	})
}

toggleSidebar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');

	if(sidebar.classList.contains('hide')) {
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})

		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
	} else {
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})

sidebar.addEventListener('mouseleave', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})
	}
})

sidebar.addEventListener('mouseenter', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})

// PROFILE DROPDOWN
const profile = document.querySelector('nav .profile');
const dropdownProfile = profile.querySelector('.profile-link');
const arrowIcon = profile.querySelector('.arrow');

arrowIcon.addEventListener('click', function () {
    dropdownProfile.classList.toggle('show');
});


// MENU
const allMenu = document.querySelectorAll('main .content-data .head .menu');

allMenu.forEach(item=> {
	const icon = item.querySelector('.icon');
	const menuLink = item.querySelector('.menu-link');

	icon.addEventListener('click', function () {
		menuLink.classList.toggle('show');
	})
})

window.addEventListener('click', function (e) {
	if(e.target !== imgProfile) {
		if(e.target !== dropdownProfile) {
			if(dropdownProfile.classList.contains('show')) {
				dropdownProfile.classList.remove('show');
			}
		}
	}

	allMenu.forEach(item=> {
		const icon = item.querySelector('.icon');
		const menuLink = item.querySelector('.menu-link');

		if(e.target !== icon) {
			if(e.target !== menuLink) {
				if (menuLink.classList.contains('show')) {
					menuLink.classList.remove('show')
				}
			}
		}
	})
})

// dropdown menu with the class "dropdown-menu"
let dropdownMenu = document.querySelector('.dropdown-menu');
dropdownMenu.addEventListener('change', function() {
    if (dropdownMenu.value !== '') {
        dropdownMenu.classList.add('select-filled');
    } else {
        dropdownMenu.classList.remove('select-filled');
    }
});

//display patient info
document.addEventListener('DOMContentLoaded', function () {
    const inputFields = document.querySelectorAll('.input-field1 input[type="text"], .input-field1 input[type="date"]');
    inputFields.forEach(function (inputField) {
        inputField.addEventListener('focus', function () {
            inputField.parentElement.classList.add('focus');
        });
        inputField.addEventListener('blur', function () {
            inputField.parentElement.classList.remove('focus');
        });
    });
});

//back button
document.addEventListener('DOMContentLoaded', function() {
    // Back Button
    document.querySelector('.back-button').addEventListener('click', function() {
        window.history.back(); // Go back to the previous page
    });
});

