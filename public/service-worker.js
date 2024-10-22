// service-worker.js
const CACHE_NAME = 'cs-feedback-v1';
const urlsToCache = [
  '/',
  '/index.html',
  '/static/js/main.chunk.js',
  '/static/js/bundle.js',
  '/static/css/main.chunk.css',
  '/favicon/favicon.ico',
  '/favicon/web-app-manifest-192x192.png',
  '/favicon/web-app-manifest-512x512.png'
];

const VERSION = 'v1.0.1'; // Increment this when you make changes

// Install service worker and cache resources
self.addEventListener('install', event => {
  console.log(`Service Worker ${VERSION}: Install event fired`);
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
      .then(() => {
        console.log(`Service Worker ${VERSION}: All files cached`);
      })
      .catch(error => {
        console.error(`Service Worker ${VERSION}: Install error:`, error);
      })
  );
});

// Cache and return requests with error handling
self.addEventListener('fetch', event => {
  // Skip chrome-extension requests
  if (event.request.url.startsWith('chrome-extension://') || 
      event.request.url.includes('extension') ||
      event.request.url.includes('chrome')) {
    return;
  }

  // Only handle GET requests
  if (event.request.method !== 'GET') {
    return;
  }

  // Handle http(s) requests only
  if (!event.request.url.startsWith('http')) {
    return;
  }

  event.respondWith(
    caches.match(event.request)
      .then(response => {
        // Return cached response if found
        if (response) {
          return response;
        }

        // Clone the request because it can only be used once
        const fetchRequest = event.request.clone();

        // Fetch and cache new requests
        return fetch(fetchRequest)
          .then(response => {
            // Check if we received a valid response
            if (!response || response.status !== 200 || response.type !== 'basic') {
              return response;
            }

            // Clone the response because it can only be used once
            const responseToCache = response.clone();

            // Don't cache chrome extension resources
            if (!fetchRequest.url.startsWith('chrome-extension://')) {
              caches.open(CACHE_NAME)
                .then(cache => {
                  cache.put(event.request, responseToCache);
                })
                .catch(err => console.error('Caching error:', err));
            }

            return response;
          })
          .catch(error => {
            console.error('Fetch error:', error);
            // Return offline fallback if available
            return caches.match('offline.html')
              .then(offlineResponse => {
                return offlineResponse || new Response('Offline');
              });
          });
      })
  );
});

// Clean old caches
self.addEventListener('activate', event => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});

// Add this new event listener
self.addEventListener('message', (event) => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});
