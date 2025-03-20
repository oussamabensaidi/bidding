🏷️ Bidding System

📜 Introduction
A real-time auction system built with 🛠️ Laravel where users can bid on items, and admins can manage listings. Features live updates using WebSockets for seamless bid tracking and interaction.
📌 Requirements

    🐘 PHP: ^8.2

    🌐 Laravel: ^11.31

    🗄️ Database: MySQL (default) / PostgreSQL

    📦 Dependencies:

        🏗️ Laravel Breeze (Authentication)

        📡 Laravel Reverb (Real-time WebSockets)

        🛡️ Google reCAPTCHA v3 (Bot protection)

        🚀 Laravel Sail (Local development)

        🧪 PestPHP (Testing)

        🎨 TailwindCSS (Styling)

        💿 Livewire (Optional for reactive components)

🛠️ Installation

    Clone the repository:

    git clone https://github.com/oussamabensaidi/bidding.git
    cd bidding

    Install dependencies:

    composer install
    npm install && npm run build

    Configure environment:

    cp .env.example .env
    php artisan key:generate

        Update .env with your database credentials:
        ini
        Copy

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=biding
        DB_USERNAME=root
        DB_PASSWORD=

    Set up database:

    php artisan migrate
    php artisan storage:link

    Start the app:

    php artisan serve
    npm run dev


    Run real-time services:

    php artisan queue:listen
    php artisan reverb:start

⭐ Core Features
👤 User Features

    🔐 Secure authentication with Laravel Breeze.

    💰 Real-time bidding: Place bids and see instant updates via WebSockets.

    📜 Bid history: Track past and ongoing auctions.

    💬 Live comments: Discuss items in real-time.

    🖼️ Image uploads: Attach images to items.

👑 Admin Features

    📦 CRUD Item Management: Create, update, or delete auction items.

    ⏳ Auction scheduling: Set pre-bid periods and bidding durations.

    🚦 Visibility control: Mark items as active/closed.

🛠️ Technical Features

    📡 WebSocket integration with Laravel Reverb.

    🤖 Bot protection using reCAPTCHA v3.

    🧪 Test-driven development with PestPHP.

🤯 Challenges Faced
    🎨 TailwindCSS Styling Conflicts

        Issue: Default Tailwind styles clashed with custom designs.

        Fix: Overrode Breeze templates and used @apply directives.

        Lesson: Customize framework internals for better control.

    📤 File Uploads in Breeze

        Issue: Profile pictures overwrote existing data.

        Fix: Used fill($request->except('profile_picture')).

        Lesson: Exclude non-fillable fields during updates.

    📡 Real-Time Syncing

        Issue: Syncing bids/comments across users.

        Fix: Leveraged Laravel Reverb and event broadcasting.

        Lesson: WebSockets require queue workers for scalability.


🖥️ Usage

    Users: Bid on items, comment, and track auctions in real-time.

    Admins: Manage items via /items routes, set auction rules, and moderate content.

📡 API Endpoints
🔐 Authentication & Profile

    GET /profile – View profile.

    PATCH /profile – Update profile.

    DELETE /profile – Delete account.

📦 Item Management (Admin)

    GET /items – List all items.

    POST /items – Create item.

    DELETE /items/{item} – Delete item.

💰 Bidding (User)

    GET /items/clientShow/{item} – View item details.

    PATCH /items/bid/{item} – Place bid.

💬 Comments

    POST /comment – Post comment.

🌐 WebSocket Channels

    bids.{itemId} – Live bid updates.

    comment.{itemId} – Real-time comments.

🚀 Deployment

    Configure production .env (set APP_ENV=production).

    Run php artisan optimize:clear.

    Start queue workers and WebSocket server:
    bash
    Copy

    php artisan queue:work --daemon
    php artisan reverb:start

    Use Nginx/Apache to serve the app.


For support, email bensaidioussama7@gmail.com