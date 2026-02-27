(function() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    var header = document.querySelector('.site-header');
    if (header) {
        var lastScroll = 0;
        window.addEventListener('scroll', function() {
            var currentScroll = window.pageYOffset;
            if (currentScroll > 100) {
                header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            } else {
                header.style.boxShadow = '0 1px 2px 0 rgba(0, 0, 0, 0.05)';
            }
            lastScroll = currentScroll;
        });
    }

    var ratingBars = document.querySelectorAll('.rating-bar-fill');
    if (ratingBars.length > 0) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.style.width = entry.target.style.width || '0%';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        ratingBars.forEach(function(bar) {
            observer.observe(bar);
        });
    }
})();
