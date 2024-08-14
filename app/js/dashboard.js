document.addEventListener('DOMContentLoaded', function () {
    const menuLinks = document.querySelectorAll('.dashboard-menu__a');
    const tabs = document.querySelectorAll('.tab-dashboard');

   

    menuLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); 
            const targetTabId = this.getAttribute('href').substring(1);
            activateTab(targetTabId);
        });
    });

    if (tabs.length > 0) {
        activateTab(tabs[0].id);
    }
});

function activateTab(tabId) {
    tabs.forEach(tab => {
        if (tab.id === tabId) {
            tab.classList.add('active');
        } else {
            tab.classList.remove('active');
        }
    });

    menuLinks.forEach(link => {
        if (link.getAttribute('href').substring(1) === tabId) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}