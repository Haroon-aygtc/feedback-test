import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App.js';
import './localization/i18n.js';
import reportWebVitals from './reportWebVitals.js';
import { DevSupport } from "@react-buddy/ide-toolbox";
import { ComponentPreviews, useInitial } from "./dev/index.js";

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <DevSupport ComponentPreviews={ComponentPreviews} useInitialHook={useInitial}>
      <App />
    </DevSupport>
  </React.StrictMode>
);

// Enhanced service worker registration with update handling
const registerServiceWorker = async () => {
  if ('serviceWorker' in navigator) {
    try {
      // Unregister old service workers
      const registrations = await navigator.serviceWorker.getRegistrations();
      for (let registration of registrations) {
        await registration.unregister();
      }

      // Register new service worker
      const registration = await navigator.serviceWorker.register('/service-worker.js', {
        scope: '/'
      });

      // Handle updates
      registration.addEventListener('updatefound', () => {
        const newWorker = registration.installing;
        newWorker.addEventListener('statechange', () => {
          if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
            // New content is available
            if (window.confirm('New version available! Would you like to update?')) {
              window.location.reload();
            }
          }
        });
      });

      console.log('ServiceWorker registration successful:', registration);

      // Handle controller change
      let refreshing = false;
      navigator.serviceWorker.addEventListener('controllerchange', () => {
        if (!refreshing) {
          refreshing = true;
          window.location.reload();
        }
      });

    } catch (error) {
      console.error('ServiceWorker registration failed:', error);
    }
  }
};

// Initialize PWA
const initializePWA = () => {
  // Register service worker
  registerServiceWorker();

  // Add PWA install prompt handling
  let deferredPrompt;
  window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    // Optionally show your own install button here
    // showInstallButton();
  });

  // Handle PWA installation
  window.addEventListener('appinstalled', () => {
    deferredPrompt = null;
    console.log('PWA installed successfully');
  });
};

// Start PWA initialization
initializePWA();

// Performance monitoring
reportWebVitals(console.log);