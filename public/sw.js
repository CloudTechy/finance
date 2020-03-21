const version = "v1:1:9" //Change if you want to regenerate cache
const staticCacheName = `${version}static-resources`;

self.addEventListener('install', event => {
    event.waitUntil(
        caches
        .open('my-site-name')
        .then(cache =>
            cache.addAll([
                '/css/animate.css',
                '/css/main.css',
                '/js/jquery.js',
                '/js/fancybox.js',
                '/js/owl.carousel.min.js',
                '/js/clipboard.min.js',
                '/css/app.css',
                '/img/logo.png',
                '/img/logo-hover.png',
                '/img/btc-small.png',
                '/img/key-1.png',
                '/img/flower.jpg',
                '/img/key-4.png',
                '/img/home.png',
                '/img/key-2.png',
                '/img/percentages.png',
                '/img/partners.png',
                '/img/map.png',
                '/img/dcs-1.png',
                '/img/support-marker.png',
                '/img/dcs-3.png',
                '/img/dcs-2.png',
                '/img/support-mail.png',
                '/img/bitcoin.png',
                '/img/footer-logo.png',
                'https://fonts.googleapis.com/css?family=Nunito',
                'https://fonts.googleapis.com/css?family=Raleway:300,400,600',
                'https://fonts.gstatic.com/s/nunito/v10/XRXV3I6Li01BKofINeaB.woff2'
               
            ])
        )
    )
})

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response => {
            if (response) {
                //we found an entry in the cache!
                //return response
            }
            return fetch(event.request)
        })
    )
})
