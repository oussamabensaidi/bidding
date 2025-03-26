
document.addEventListener('DOMContentLoaded', function () {
    const commentLive = document.getElementById('commentLive');
    if (commentLive) {
        setTimeout(() => {
            commentLive.scrollTop = commentLive.scrollHeight;
        }, 100); // Small delay to ensure rendering
    }
});

document.getElementById('openModal').addEventListener('click', () => {
    document.getElementById('paymentModal').classList.remove('hidden');
});

document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('paymentModal').classList.add('hidden');
});
document.getElementById('paybutton').addEventListener('click', () => {
    document.getElementById('bidForm').submit();
});
        