# [Bidding]  
A real-time auction system where users can bid on items, and admins can manage listings.  
- **Users**: Bid instantly, track ongoing auctions, and view bidding history.  
- **Admins**: Create/delete auctions, set time limits, and moderate bids.  
- **Real-time Updates**: Built with [WebSockets/Livewire] for live bid tracking. 

## Features  
- User Authentification


## Tech Stack  
- Laravel  
- PHP  
- MySQL

## Installation   
1. Install dependencies:  
   `git clone https://github.com/yourusername/live-bidding-app.git`
    `cd live-bidding-app`
    `composer install`
    `npm install && npm run build`
    `php artisan storage:link`
3. Set up the environment file:
    `cp .env.example .env`
    `php artisan key:generate`
4. Set the database (.env file):

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=biding
    DB_USERNAME=root
    DB_PASSWORD=

    `php artisan migrate`
5. Run the app:  
   `php artisan serve`
   `npm run dev`

   ## Future Improvements  
- **Payment Gateway**: Integrate Stripe/PayPal for real transactions.  
- **Email Notifications**: Send bid confirmations via Mailtrap/SendGrid.  
- **Dockerize**: Containerize the app for easier deployment. 