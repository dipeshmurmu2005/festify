# Festify 🎉

Festify is a web-based **Event Management System** developed as a college project. It helps organizers create and manage events while allowing participants to discover, register, and pay for events easily.

The platform also includes a **secure wallet-based payment system** where payments made by participants are temporarily held by the platform and released to the organizer after the successful completion of the event.

---

## ✨ Features

### Event Management
- Create, edit, and manage events
- Add event details, schedules, and participant limits
- Manage event registrations

### User Registration
- Users can browse and join events
- Simple and responsive event discovery interface

### eSewa Payment Integration
- Secure event payments using **eSewa**
- Seamless digital payment experience for participants

### Wallet System
- Built-in wallet for handling platform transactions
- Organizers can receive funds in their wallet

### Payment Hold Mechanism
- Event payments are **held by the platform wallet**
- Ensures security and prevents misuse

### Payment Release
- After successful completion of the event
- Funds are **released to the organizer’s wallet**

### Transaction Tracking
- Records of all wallet transactions
- Transparent credit and debit history

### Organizer Dashboard
- Manage events
- View registrations
- Track earnings

### Admin Controls
- Manage users and events
- Monitor transactions and platform activity

---

## 🛠 Tech Stack

**Backend**
- Laravel (PHP)

**Frontend**
- Blade Templates
- Tailwind CSS

**Database**
- MySQL

**Payment Gateway**
- eSewa

**Build Tool**
- Vite

---

## 🛠 Setup Instructions

Follow these steps to get Festify running locally:

1. **Clone the repository**
```bash
git clone https://github.com/your-username/festify.git
cd festify
```

2. **Copy the environment file**
```bash
cp .env.example .env
```

3. **Install PHP dependencies**
```bash
composer install
```

4. **Generate application key**
```bash
php artisan key:generate
```

5. **Migrate tables and seed fake data**
```bash
php artisan mi:fr --seed
```
> This command will migrate the database tables and populate them with sample data for testing.

6. **Start the development server**
```bash
php artisan serve
```

7. **Access the application**  
Open your browser and visit `http://localhost:8000` to see Festify in action.

> ⚡ **Note:** Make sure you have PHP, Composer, and a MySQL database configured before running these steps.

---

## 🎯 Project Objective

The objective of Festify is to demonstrate the development of a full-stack web application with real-world features such as:

- Event management systems
- Secure digital payment integration
- Wallet-based transaction handling
- Admin and organizer dashboards

---

## 🚀 Future Improvements

- QR Code based event tickets
- Email and SMS notifications
- Event analytics dashboard
- Mobile application support
- Multiple payment gateway integration

---

## 📚 License

This project is developed for **educational purposes as a college project**.
