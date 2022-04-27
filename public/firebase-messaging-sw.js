// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({

    apiKey: "AIzaSyDPKfiRablFs_8otlOSNEisJOO6hLLt2LA",
    authDomain: "laravelnotifications-6681d.firebaseapp.com",
    projectId: "laravelnotifications-6681d",
    storageBucket: "laravelnotifications-6681d.appspot.com",
    messagingSenderId: "625141864942",
    appId: "1:625141864942:web:b9463a1c0ed38b150596ff",
    measurementId: "G-1VC4XKJH60",

    databaseURL: 'https://project-id.firebaseio.com',
});

firebase.initializeApp(firebaseConfig);

// Retrieve firebase messaging
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log("Received background message ", payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
