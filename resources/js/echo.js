import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

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
    const currentUserId = document.getElementById('currentUserId').value;  
    window.Echo.channel(`bids.${item_id}`)
        .listen('BidPlaced', (e) => {
            if (parseInt(e.user_id) !== parseInt(currentUserId)) { 
            console.log('New bid:', e.bidAmount, 'on item:', e.itemId);
            alert('New bid placed!');
            const bidAmountElement = document.getElementById('current-bid-amount');
            bidAmountElement.innerHTML = `<strong>Current price<strong/>: $${e.bidAmount}`;
        }
        });
});
