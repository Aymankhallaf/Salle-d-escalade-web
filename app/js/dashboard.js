//listen to change in url.
window.addEventListener('load', () => {
    const currentHash = window.location.hash.substring(1);
    if (currentHash) {
        activateTab(currentHash);
    }
});
    const menuLinks = document.querySelectorAll('.dashboard-menu__a');
    const tabs = document.querySelectorAll('.js-tab-dashboard');

   
    
    menuLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            const targetTabId = this.getAttribute('href').substring(1);
            activateTab(targetTabId);

                     

        });
    });

    /**
     * Actives current section(tab) by adding class('tab-dashboard--active')
     * and disactives the others by adding(hidden) and change the color of the btn tab     
     * @param {string} tabId id section, href of a link html
     * @return {void}
     */
    function activateTab(tabId) {
                tabs.forEach(tab => {
                    if (tab.id !== tabId) {
                        tab.classList.add('hidden');
                        tab.classList.remove('tab-dashboard--active');
                    } 
                    else {
                       
                        tab.classList.remove('hidden');
                        tab.classList.add('tab-dashboard--active');
                    }
                    
                });
             
                menuLinks.forEach(link => {
                    
               if (link.getAttribute('href').substring(1) === tabId)
                 {
                   link.classList.add('active-btn-tab');
                 } else {
                   link.classList.remove('active-btn-tab');
                        }
                        });           
            }