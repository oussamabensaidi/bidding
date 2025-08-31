# 🏷️ Bidding System

![Laravel](https://img.shields.io/badge/Laravel-11.x-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## 📜 Overview

A real-time auction system built with Laravel where users can bid on items, and admins can manage listings. Features live updates using WebSockets for seamless bid tracking and interaction.

### 🎯 Key Highlights
- Real-time bidding with WebSocket integration
- Role-based access control (Admin/Client)
- Bot protection with reCAPTCHA
- Live comments and notifications
- Responsive design with TailwindCSS

## 🖼️ Screenshots

> **Note:** Add screenshots of your application here:
> - Dashboard view
> - Bidding interface
> - Admin panel
> - Real-time updates in action

## 🚀 Live Demo

> **Note:** If you have a live demo, add the link here:
> - [Live Demo](https://your-demo-link.com)
> - Test Admin: `admin@example.com` / `password123`
> - Test Client: `client@example.com` / `password123`

## 🛠️ Technical Stack

- **Backend:** Laravel 11.x (PHP 8.2+)
- **Frontend:** Blade templates, TailwindCSS, Alpine.js
- **Authentication:** Laravel Breeze
- **Real-Time:** Laravel Reverb (WebSockets), Echo.js
- **Bot Protection:** Google reCAPTCHA v2
- **Database:** MySQL (default), Eloquent ORM
- **Testing:** PestPHP
- **File Storage:** Laravel Storage (public disk)
- **Queue Management:** Laravel queue workers

## 📋 Prerequisites

- PHP ^8.2
- Composer
- npm
- MySQL
- Git

## 🚀 Quick Start

### 1. Clone & Install
```bash
git clone https://github.com/oussamabensaidi/bidding.git
cd bidding
composer install
npm install && npm run build
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration
Update your `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bidding_system
DB_USERNAME=root
DB_PASSWORD=

# Add these for reCAPTCHA (optional)
RECAPTCHA_SITE_KEY=your_site_key
RECAPTCHA_SECRET_KEY=your_secret_key

# WebSocket Configuration
REVERB_APP_ID=your_app_id
REVERB_APP_KEY=your_app_key
REVERB_APP_SECRET=your_app_secret
```

### 4. Database Migration
```bash
php artisan migrate
php artisan storage:link
```

### 5. Start the Application
```bash
# Terminal 1: Start the web server
php artisan serve

# Terminal 2: Build assets
npm run dev

# Terminal 3: Start WebSocket server
php artisan reverb:start

# Terminal 4: Start queue worker
php artisan queue:listen
```

Visit `http://localhost:8000` to access the application.

## 🎯 Core Features

### 👤 Client Features
- **🔐 Authentication:** Secure registration/login with email verification
- **💰 Real-Time Bidding:** Place bids with instant WebSocket updates
- **💬 Live Comments:** Real-time discussion on auction items
- **📊 Bid History:** Track your bidding activity
- **👤 Profile Management:** Upload profile pictures, manage balance
- **🛡️ Bot Protection:** reCAPTCHA integration for secure bidding

### 👑 Admin Features
- **📦 Item Management:** Full CRUD operations for auction items
- **📅 Auction Scheduling:** Set start/end times and pre-bid periods
- **🖼️ Media Management:** Upload multiple images per item
- **📊 Dashboard:** View statistics and manage active auctions
- **🔄 Status Control:** Activate/deactivate items

### 🔧 Technical Features
- **📡 WebSocket Integration:** Real-time updates via Laravel Reverb
- **🔒 Role-Based Access:** Secure admin/client role separation
- **📱 Responsive Design:** Mobile-friendly interface
- **🧪 Test Coverage:** PestPHP testing framework
- **⚡ Performance:** Optimized queries and caching

## 📡 API Reference

### Authentication
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/profile` | View user profile |
| PATCH | `/profile` | Update profile |
| DELETE | `/profile` | Delete account |

### Items (Admin Only)
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/items` | List all items |
| POST | `/items` | Create new item |
| PUT | `/items/{id}` | Update item |
| DELETE | `/items/{id}` | Delete item |

### Bidding (Client)
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/items/clientShow/{id}` | View item details |
| PATCH | `/items/bid/{id}` | Place a bid |

### Comments
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/comment` | Post comment |

## 🔌 WebSocket Channels

- **`bids.{itemId}`** - Real-time bid updates
- **`comment.{itemId}`** - Live comment notifications

## 🧪 Testing

Run the test suite:
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/BiddingTest.php

# Run with coverage
php artisan test --coverage
```

## 🚀 Deployment

### Production Setup
1. Set environment to production:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Optimize application:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

3. Start services:
```bash
# Start queue worker as daemon
php artisan queue:work --daemon

# Start WebSocket server
php artisan reverb:start --host=0.0.0.0 --port=8080
```

4. Configure web server (Nginx/Apache) to serve the application.

## 🏗️ Project Structure

```
bidding/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Events/              # WebSocket events
│   └── Listeners/           # Event listeners
├── resources/
│   ├── views/               # Blade templates
│   ├── js/                  # Frontend JavaScript
│   └── css/                 # Stylesheets
├── routes/
│   ├── web.php              # Web routes
│   └── channels.php         # WebSocket channels
├── database/
│   └── migrations/          # Database migrations
└── tests/                   # Test files
```

## 🤯 Development Challenges & Solutions

### 🎨 TailwindCSS Integration
**Challenge:** Default Tailwind styles conflicted with Laravel Breeze templates.
**Solution:** Customized Breeze templates and used `@apply` directives for better control.

### 📤 File Upload Handling
**Challenge:** Profile picture uploads were overwriting existing user data.
**Solution:** Used `fill($request->except('profile_picture'))` to exclude non-fillable fields.

### 📡 Real-Time Synchronization
**Challenge:** Syncing bids and comments across multiple users in real-time.
**Solution:** Implemented Laravel Reverb with event broadcasting and queue workers.

## 🔧 Configuration

### reCAPTCHA Setup
1. Get your keys from [Google reCAPTCHA](https://www.google.com/recaptcha/)
2. Add to `.env`:
```env
RECAPTCHA_SITE_KEY=your_site_key
RECAPTCHA_SECRET_KEY=your_secret_key
```

### WebSocket Configuration
Ensure your `.env` has proper WebSocket settings:
```env
BROADCAST_DRIVER=reverb
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=database
```

## 📝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/new-feature`
3. Commit changes: `git commit -am 'Add new feature'`
4. Push to branch: `git push origin feature/new-feature`
5. Submit a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation for API changes
- Use conventional commit messages

## ⚠️ Known Issues

- [ ] File upload validation inconsistencies
- [ ] Client maximum bid enforcement needs completion
- [ ] Mobile responsiveness improvements needed
- [ ] Accessibility enhancements required

## 📚 Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Reverb Guide](https://laravel.com/docs/reverb)
- [TailwindCSS Documentation](https://tailwindcss.com/docs)
- [PestPHP Testing](https://pestphp.com/)

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Oussama Ben Saidi**
- Email: bensaidioussama7@gmail.com
- GitHub: [@oussamabensaidi](https://github.com/oussamabensaidi)
- Portfolio: https://bensaidioussama-portfolio.vercel.app/

## 🙏 Acknowledgments

- Laravel team for the amazing framework
- TailwindCSS for the utility-first CSS framework
- Contributors and testers

---

⭐ **If this project helped you, please give it a star!**