(function() {
    var toggle = document.querySelector('.menu-toggle');
    var nav = document.querySelector('.main-navigation');
    var search = document.querySelector('.header-search');
    var searchToggle = document.querySelector('.search-toggle');

    if (toggle && nav) {
        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            nav.classList.toggle('toggled');
            var expanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !expanded);

            if (search && search.classList.contains('mobile-visible')) {
                search.classList.remove('mobile-visible');
            }
        });
    }

    if (searchToggle && search) {
        searchToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            search.classList.toggle('mobile-visible');

            if (nav && nav.classList.contains('toggled')) {
                nav.classList.remove('toggled');
                if (toggle) toggle.setAttribute('aria-expanded', 'false');
            }

            if (search.classList.contains('mobile-visible')) {
                var input = search.querySelector('input');
                if (input) input.focus();
            }
        });
    }

    document.addEventListener('click', function(e) {
        if (nav && toggle && !nav.contains(e.target) && !toggle.contains(e.target)) {
            nav.classList.remove('toggled');
            toggle.setAttribute('aria-expanded', 'false');
        }

        if (search && searchToggle && !search.contains(e.target) && !searchToggle.contains(e.target)) {
            search.classList.remove('mobile-visible');
        }
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            if (nav) nav.classList.remove('toggled');
            if (toggle) toggle.setAttribute('aria-expanded', 'false');
            if (search) search.classList.remove('mobile-visible');
        }
    });
})();
