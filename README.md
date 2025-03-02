# 📊 Admin Analytics Dashboard

## 📝 Description

A comprehensive admin analytics dashboard built with Laravel, offering powerful insights and data visualization for business metrics. This platform provides real-time analytics, user management, and detailed reporting capabilities.

## 📸 Screenshots

### 📈 Dashboard Overview

![Dashboard](/screenshots/dashboard.png)
_Main dashboard view with key performance indicators and metrics_

### 📊 Product Analytics

![Product Analytics](/screenshots/product-analytics.png)
_Detailed product performance and inventory analytics_

### 💰 Revenue Analytics

![Revenue](/screenshots/revenue-analytics.png)
_Revenue tracking and financial performance metrics_

### 📱 Sales & Marketing

![Sales](/screenshots/sales-marketing.png)
_Sales trends and marketing campaign performance_

### 👥 User Management

![Users](/screenshots/user-management.png)
_User administration and role management interface_

## 🚀 Technologies Used

### Backend & Framework

-   🎯 Laravel 10.x
-   🐘 PHP 8.1+
-   🗃️ MySQL Database
-   🔐 Laravel Breeze for Authentication

### Frontend

-   🎨 Tailwind CSS
-   🎯 Alpine.js
-   📊 Chart.js for Data Visualization
-   🎭 AdminLTE Template Integration

### Development Tools

-   🔄 Vite for Asset Bundling
-   🧪 PHPUnit for Testing
-   🔍 Laravel Pint for Code Style

## 🛠️ Prerequisites

-   PHP 8.1 or higher
-   Composer
-   Node.js & NPM
-   MySQL

## ⚙️ Installation

1. **Clone the repository**

```bash
git clone <repository-url>
cd admin-analytics-dashboard
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install NPM dependencies**

```bash
npm install
```

4. **Environment Setup**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure Database**

Update .env with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Run Migrations**

```bash
php artisan migrate --seed
```

## 🚀 Running the Application

1. **Start the development server**

```bash
php artisan serve
```

2. **Compile assets**

```bash
npm run dev
```

Access the application at: http://localhost:8000

## 🔍 Key Features

-   📊 Real-time Analytics Dashboard
-   📈 Sales and Revenue Tracking
-   📦 Product Performance Metrics
-   👥 User Management System
-   📱 Responsive Design
-   🔒 Role-based Access Control
-   📊 Customizable Reports
-   📈 Data Visualization

## 🗂️ Project Structure

```
Admin_Analytics_Dashboard/
├── app/
│   ├── Http/
│   ├── Models/
│   └── Providers/
├── config/
├── database/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
└── tests/
```

## 🔐 Security

-   ✔️ CSRF Protection
-   🔒 SQL Injection Prevention
-   🛡️ XSS Protection
-   📝 Input Validation
-   🔑 Role-based Authorization

## 🧪 Testing

Run the test suite:

```bash
php artisan test
```

## 📝 API Documentation

### Analytics Endpoints

-   GET /api/analytics/dashboard - Dashboard overview data
-   GET /api/analytics/sales - Sales metrics
-   GET /api/analytics/revenue - Revenue data
-   GET /api/analytics/products - Product performance

### User Management

-   GET /api/users - List all users
-   POST /api/users - Create new user
-   PUT /api/users/{id} - Update user
-   DELETE /api/users/{id} - Delete user

## 👥 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📄 License

This project is licensed under the MIT License.

## 📞 Support

For support or questions, please open an issue in the repository.

---

⌨️ con ❤️ por [Michael Vairo]
