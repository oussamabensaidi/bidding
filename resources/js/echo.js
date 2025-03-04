import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'reverb',
//     key: import.meta.env.VITE_REVERB_APP_KEY,
//     wsHost: import.meta.env.VITE_REVERB_HOST,
//     wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
//     wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: false,
    disableStats: true,
});
document.addEventListener('DOMContentLoaded', function () {
    const item_id = document.getElementById('item_id').value;  
    window.Echo.channel(`bids.${item_id}`)
        .listen('BidPlaced', (e) => {
            console.log('New bid:', e.bidAmount, 'on item:', e.itemId);
            // alert('New bid placed!');
            const bidAmountElement = document.getElementById('current-bid-amount');
            bidAmountElement.innerText = `Current price: $${e.bidAmount}`;

        });

});
