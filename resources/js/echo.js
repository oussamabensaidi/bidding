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
            if (parseInt(e.userId) !== parseInt(currentUserId)) { 
            console.log('New bid:', e.bidAmount, 'on item:', e.itemId);
            console.log("Connecting to channel: bids." + item_id);
            alert('New bid placed!');
            const bidAmountElement = document.getElementById('current-bid-amount');
            bidAmountElement.innerHTML = `<strong>Current price<strong/>: $${e.bidAmount}`;
        }
        });
});



document.addEventListener('DOMContentLoaded', function () {
    const itemId = document.getElementById('item_id');
    const   = document.getElementById('currentUserId');
    if (!itemId || !currentUserId) return; // Check if elements exist
    const commentLive = document.getElementById('commentLive');
    if (!commentLive) return; // Check if the container exists
    const item_id = itemId.value;
    const current_user_id = currentUserId.value;
    window.Echo.channel(`comment.${item_id}`)
        .listen('placeComment', (e) => {
            if (parseInt(e.userId) !== parseInt(current_user_id)) { 
                console.log("Connecting to channel: comment");
                // alert('New comment placed!'); 
                const node = document.createElement("p");
                node.textContent = e.comment;     
                commentLive.appendChild(node);
            }
        });
});

