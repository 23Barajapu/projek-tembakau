import "./bootstrap";

// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyA6f8HrtK1h_1EbBLp_r-gWHQGeVJhRG_U",
    authDomain: "pengelolaantembakau.firebaseapp.com",
    projectId: "pengelolaantembakau",
    storageBucket: "pengelolaantembakau.firebasestorage.app",
    messagingSenderId: "414217535251",
    appId: "1:414217535251:web:edac898df66cae64aaa4e6",
    measurementId: "G-NCFYJ70HJX",
};

// Initialize Firebaseyo
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

onMessage(messaging, (payload) => {
    console.log("Message received. ", payload);
    alert("Ada notifikasi baru");
});

getToken(messaging, {
    vapidKey:
        "BFcQ_4Dr9UgPgflwYZoSz_0Uy3N7iy5OwjmFM4vGSBLeS_8_3oT_zRYItlyx47d7tbuzbw2TEXjt9wh3CRyXeNA",
})
    .then((currentToken) => {
        if (currentToken) {
            // Send the token to your server and update the UI if necessary
            // ...
            console.log(currentToken);
            sentTokenToServer(currentToken);
        } else {
            // Show permission request
            requestPermission();
            console.log(
                "No registration token available. Request permission to generate one."
            );
            // ...
        }
    })
    .catch((err) => {
        console.log("An error occurred while retrieving token. ", err);
        // ...
    });

function requestPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === "granted") {
            console.log("Notification permission granted.");
            // TODO(developer): Retrieve a registration token for use with FCM.
            // ...
        } else {
            alert(
                "Silakan izinkan notification untuk mendaoatkan notification terbaru dari kami,"
            );
        }
    });
}

function sentTokenToServer(token) {
    var csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    let formData = new FormData();
    formData.append("token", token);
    fetch("/tokenweb", {
        headers: {
            "X-CSRF-Token": csrf,
            _method: "_POST",
        },
        method: "post",
        credentials: "same-origin",
        body: formData,
    }).then((response) => {
        console.log(response.status);
    });
}
