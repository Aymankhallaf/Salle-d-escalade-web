function getQueryParams() {
    const queryString = window.location.hash.split('?')[1];
    const params = {};
    if (queryString) {
        const pairs = queryString.split('&');
        pairs.forEach(pair => {
            const [key, value] = pair.split('=');
            params[decodeURIComponent(key)] = decodeURIComponent(value);
        });
    }
    return params;
}

if (window.location.hash.startsWith('#reservation-details')) {
    console.log(getQueryParams());
}