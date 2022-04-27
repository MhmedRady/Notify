// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.11/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.11/firebase-analytics.js";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyDPKfiRablFs_8otlOSNEisJOO6hLLt2LA",
    authDomain: "laravelnotifications-6681d.firebaseapp.com",
    projectId: "laravelnotifications-6681d",
    storageBucket: "laravelnotifications-6681d.appspot.com",
    messagingSenderId: "625141864942",
    appId: "1:625141864942:web:b9463a1c0ed38b150596ff",
    measurementId: "G-1VC4XKJH60"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
