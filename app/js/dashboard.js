window.addEventListener('load', () => {
    const currentHash = window.location.hash.substring(1);
    if (currentHash) {
        activateTab(currentHash);
    }
});
    const menuLinks = document.querySelectorAll('.dashboard-menu__a');
    const tabs = document.querySelectorAll('.js-tab-dashboard');

   
console.log(menuLinks);
    
    menuLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const targetTabId = this.getAttribute('href').substring(1);
            activateTab(targetTabId);

                     

        });
    });

    function activateTab(tabId) {
                tabs.forEach(tab => {
                    if (tab.id !== tabId) {
                        tab.classList.add('hidden');
                        tab.classList.remove('tab-dashboard--active');
                    } 
                    else {
                        console.log("yes");
                        tab.classList.remove('hidden');
                        tab.classList.add('tab-dashboard--active');
                    }
                    
                });
                const currentUrl = window.location.hash.substring(1);
             
                menuLinks.forEach(link => {
                    
               if (link.getAttribute('href').substring(1) === tabId)
                 {
                   link.classList.add('active-btn-tab');
                 } else {
                   link.classList.remove('active-btn-tab');
                        }
                        });           
            }