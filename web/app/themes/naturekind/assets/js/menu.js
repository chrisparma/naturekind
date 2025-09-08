(function () {
    'use strict';

    var header = document.getElementById('header');
    if (!header) return; // Exit if header is not found

    var header_h = header.offsetHeight;

    adjustMenu(header_h);
    window.addEventListener('scroll', function () {
        adjustMenu(header_h);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('navbar');
    
        if (navbar) {
            navbar.addEventListener('show.bs.collapse', function () {
                document.body.classList.add('menu-open');
            });
    
            navbar.addEventListener('hide.bs.collapse', function () {
                document.body.classList.remove('menu-open');
            });
        }
    });

    function adjustMenu(header_h) {
        // Use window.scrollY for better cross-browser support
        var navbar = document.getElementById('navbar');
        if (window.scrollY >= header_h) {
            document.body.classList.add('stack-header');
            document.body.style.paddingTop=header_h+'px';
            adjustNavbarHeight(true, 500);
        } 
        else {
            document.body.classList.remove('stack-header');
            document.body.style.removeProperty('padding-top');
            navbar.classList.remove('show');
            adjustNavbarHeight(false);
        }
    }

    function adjustNavbarHeight(show, delay = 0) {
        const styleId = 'navbar-dynamic-height-style';
        const existingStyle = document.getElementById(styleId);

        if (show) {
            setTimeout(() => {
                const adjusted_header_h = document.getElementsByClassName('navbar-brand')[0].offsetHeight;
                const css = `
                    body.menu-open {
                        padding-right: 8px;
                        overflow-y: hidden;
                    }
                    body.menu-open #header {
                        right: 4px;
                    }
                    body #header #navbar.show {
                        height: calc(100vh - ${adjusted_header_h}px) !important;
                    }
                `;

                // If the style already exists, update it
                if (existingStyle) {
                    existingStyle.innerHTML = css;
                } else {
                    const style = document.createElement('style');
                    style.id = styleId;
                    style.innerHTML = css;
                    document.head.appendChild(style);
                }
            }, delay);
        } else {
            // Remove the style element if it exists
            if (existingStyle) {
                existingStyle.remove();
            }
        }
    }
})();