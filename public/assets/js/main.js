(function() {
	"use strict";
  
	var Wizard = {
	    init: function() {
		  this.Basic.init();  
		  this.registerServiceWorker();
	    },
  
	    Basic: {
		  init: function() {
			this.preloader();
			this.NeedJobSlide();
			this.FileUpload();
		  },
		  // ... your existing Basic methods remain unchanged ...
	    },
  
	    registerServiceWorker: function() {
		  if ('serviceWorker' in navigator) {
			window.addEventListener('load', function() {
			    // Updated path to service-worker.js in public folder
			    navigator.serviceWorker.register('/service-worker.js', {
				  scope: '/'
			    })
			    .then(function(registration) {
				  console.log('ServiceWorker registration successful with scope: ', registration.scope);
				  
				  // Handle updates
				  registration.addEventListener('updatefound', () => {
					const newWorker = registration.installing;
					newWorker.addEventListener('statechange', () => {
					    if (newWorker.state === 'installed') {
						  if (navigator.serviceWorker.controller) {
							Wizard.showUpdateNotification();
						  }
					    }
					});
				  });
			    })
			    .catch(function(error) {
				  console.error('ServiceWorker registration failed: ', error);
			    });
  
			    // Handle controller change
			    let refreshing = false;
			    navigator.serviceWorker.addEventListener('controllerchange', () => {
				  if (!refreshing) {
					refreshing = true;
					window.location.reload();
				  }
			    });
			});
		  }
	    },
  
	    showUpdateNotification: function() {
		  if (document.querySelector('.update-notification')) return;
  
		  const notification = document.createElement('div');
		  notification.className = 'update-notification';
		  notification.innerHTML = `
			<div class="update-notification-content">
			    <p>New version available! Click to update.</p>
			    <button id="update-btn">Update Now</button>
			</div>
		  `;
  
		  document.head.insertAdjacentHTML('beforeend', `
			<style>
			    .update-notification {
				  position: fixed;
				  bottom: 20px;
				  right: 20px;
				  background: #333;
				  color: white;
				  padding: 15px;
				  border-radius: 5px;
				  z-index: 9999;
				  box-shadow: 0 2px 10px rgba(0,0,0,0.2);
			    }
			    .update-notification button {
				  background: #4CAF50;
				  border: none;
				  color: white;
				  padding: 5px 15px;
				  border-radius: 3px;
				  cursor: pointer;
				  margin-top: 10px;
			    }
			    .update-notification button:hover {
				  background: #45a049;
			    }
			</style>
		  `);
  
		  document.body.appendChild(notification);
  
		  document.getElementById('update-btn').addEventListener('click', function() {
			if (navigator.serviceWorker.controller) {
			    navigator.serviceWorker.controller.postMessage({ type: 'SKIP_WAITING' });
			    notification.remove();
			}
		  });
	    }
	};
  
	jQuery(document).ready(function() {
	    Wizard.init();
	});
  })();