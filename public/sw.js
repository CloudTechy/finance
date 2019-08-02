const version = "v1::" //Change if you want to regenerate cache
const staticCacheName = `${version}static-resources`;

self.addEventListener('install', event => {
  event.waitUntil(
    caches
      .open('my-site-name')
      .then(cache =>
        cache.addAll([
          'favicon.ico',
          '/css/app.css',
          // '/js/app.js',
          // 'http://localhost:8000/',
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
        return response
      }
      return fetch(event.request)
    })
  )
})