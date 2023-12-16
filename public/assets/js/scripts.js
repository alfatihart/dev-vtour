/*!
    * Start Bootstrap - SB Admin Pro v2.0.5 (https://shop.startbootstrap.com/product/sb-admin-pro)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under SEE_LICENSE (https://github.com/StartBootstrap/sb-admin-pro/blob/master/LICENSE)
    */
    window.addEventListener('DOMContentLoaded', event => {
    // Activate feather
    feather.replace();

    // Enable tooltips globally
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Enable popovers globally
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sidenav-toggled'));
        });
    }

    // Close side navigation when width < LG
    const sidenavContent = document.body.querySelector('#layoutSidenav_content');
    if (sidenavContent) {
        sidenavContent.addEventListener('click', event => {
            const BOOTSTRAP_LG_WIDTH = 992;
            if (window.innerWidth >= 992) {
                return;
            }
            if (document.body.classList.contains("sidenav-toggled")) {
                document.body.classList.toggle("sidenav-toggled");
            }
        });
    }

    // Add active state to sidbar nav links
    // let activatedPath = location.pathname.split('/');
    // let url = location.origin +  '/' + activatedPath[1];

    // $('div#accordionSidenav a').each(function() {
    //     if($(this).attr('href').indexOf(url) !== -1){
    //         $(this).parent().addClass('active').parent().parent('a').addClass('active')
    //     }
    // })

    // let activatedPath = window.location.pathname.match(/([\w-]+\.html)/, '$1');

    // if (activatedPath) {
    //     activatedPath = activatedPath[0];
    // } else {
    //     activatedPath = '/';
    // }

    let activatedPath = location.pathname.split('/');
    // console.log(activatedPath[1]);
    let url = location.origin +  '/' + activatedPath[1];
    // console.log(url);
    const targetAnchors = document.body.querySelectorAll('[href="' + url + '"].nav-link');
    // console.log(targetAnchors);
    targetAnchors.forEach(targetAnchor => {
        let parentNode = targetAnchor.parentNode;
        // console.log('init: ' + parentNode.nodeName);
        while (parentNode !== null && parentNode !== document.documentElement) {
            if (parentNode.classList.contains('collapse')) {
                parentNode.classList.add('show');
                const parentNavLink = document.body.querySelector(
                    '[data-bs-target="#' + parentNode.id + '"]'
                );
                parentNavLink.classList.remove('collapsed');
                parentNavLink.classList.add('active');
            }
            parentNode = parentNode.parentNode;
            // console.log(n + ' ' + parentNode.nodeName);
        }
        targetAnchor.classList.add('active');
    });


});
