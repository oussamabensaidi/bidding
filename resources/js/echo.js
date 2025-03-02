import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;
window.Echo = new Echo({

    broadcaster: 'reverb',

    key: import.meta.env.VITE_REVERB_APP_KEY,

    wsHost: import.meta.env.VITE_REVERB_HOST,

    wsPort: import.meta.env.VITE_REVERB_PORT,

    wssPort: import.meta.env.VITE_REVERB_PORT,

    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',

    enabledTransports: ['ws', 'wss'],

});

// document.addEventListener('DOMContentLoaded', function () {
//     const userID = window.userID;

//     window.Echo.private(`bids${itemId}`)
//         .listen('.user.notification', (response) => {
//             console.log("Event received:", response);
//             showNotification(response);
//         });
// })