let lightSwitch;

document.addEventListener('DOMContentLoaded', () => {
    lightSwitch = document.getElementById('lightSwitch');
    if (!lightSwitch) {
        console.log('lightSwitch not found');
        return;
    }

    lightSwitch.addEventListener('change', () => {
        if (lightSwitch.checked) {
            convertToDarkMode();
        } else {
            convertToLightMode();
        }
    });

    if (localStorage.getItem('lightSwitch') === 'dark') {
        convertToDarkMode();
    }
});

function convertToDarkMode() {
    document.querySelectorAll('.navbar-light').forEach((element) => {
        element.classList.replace('navbar-light', 'navbar-dark');
        element.classList.replace('bg-white', 'bg-black');
        element.classList.add('border-bottom', 'border-primary');
    });

    document.querySelectorAll('.btn-transparent-dark').forEach((element) => {
        element.classList.replace('btn-transparent-dark', 'btn-transparent-light');
    });

    document.querySelectorAll('.sidenav-light').forEach((element) => {
        element.classList.replace('sidenav-light','sidenav-dark');
    });

    document.querySelectorAll('#main-head').forEach((element) => {
        element.classList.replace('page-header-light', 'page-header-dark');
        element.classList.replace('bg-white', 'bg-black');
    });

    document.querySelectorAll('.card').forEach((element) => {
        element.classList.add('text-bg-black');
    });

    document.querySelectorAll('.card-title').forEach((element) => {
        element.classList.add('text-white');
    });

    document.querySelectorAll('.footer-light').forEach((element) => {
        element.classList.replace('footer-light', 'footer-dark');
        element.classList.replace('link-secondary', 'link-light');
    });

    document.querySelectorAll('.link-dark').forEach((element) => {
        element.classList.replace('link-dark', 'text-white');
    });

    document.body.classList.add('bg-dark');
    document.body.classList.replace('text-dark', 'text-light');

    document.querySelectorAll('table').forEach((table) => {
        table.classList.add('table-dark');
    });

    if (!lightSwitch.checked) {
        lightSwitch.checked = true;
    }
    localStorage.setItem('lightSwitch', 'dark');
}

function convertToLightMode() {
    document.querySelectorAll('.navbar-dark').forEach((element) => {
        element.classList.replace('navbar-dark', 'navbar-light');
        element.classList.replace('bg-black', 'bg-white');
        element.classList.remove('border-bottom', 'border-primary');
    });

    document.querySelectorAll('.btn-transparent-light').forEach((element) => {
        element.classList.replace('btn-transparent-light', 'btn-transparent-dark');
    });

    document.querySelectorAll('.sidenav-dark').forEach((element) => {
        element.classList.replace('sidenav-dark','sidenav-light');
    });

    document.querySelectorAll('#main-head').forEach((element) => {
        element.classList.replace('page-header-dark', 'page-header-light');
        element.classList.replace('bg-black', 'bg-white');
    });

    document.querySelectorAll('.card').forEach((element) => {
        element.classList.remove('text-bg-black');
    });

    document.querySelectorAll('.footer-dark').forEach((element) => {
        element.classList.replace('footer-dark', 'footer-light');
        element.classList.replace('link-secondary', 'link-dark');
    });

    document.querySelectorAll('.link-light').forEach((element) => {
        element.classList.replace('link-light', 'text-white');
    });

    document.body.classList.remove('bg-dark');
    document.body.classList.replace('text-light', 'text-dark');

    document.querySelectorAll('table').forEach((table) => {
        table.classList.remove('table-dark');
    });

    if (lightSwitch.checked) {
        lightSwitch.checked = false;
    }
    localStorage.setItem('lightSwitch', 'light');
}

function onToggleMode() {
    if (lightSwitch.checked) {
        convertToDarkMode();
    } else {
        convertToLightMode();
    }
}

function getSystemDefaultTheme() {
    const darkThemeMq = window.matchMedia('(prefers-color-scheme: dark)');
    return darkThemeMq.matches ? 'dark' : 'light';
}

function setup() {
    const lightSwitch = document.getElementById('lightSwitch');

    if (!lightSwitch) {
        console.log('lightSwitch not found');
        return;
    }

    const settings = localStorage.getItem('lightSwitch') || getSystemDefaultTheme();

    if (settings === 'dark') {
        lightSwitch.checked = true;
    }

    lightSwitch.addEventListener('change', onToggleMode);
    onToggleMode();
}

document.addEventListener('DOMContentLoaded', setup);
