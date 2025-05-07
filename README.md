<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel Profile Viewer App

This is a simple **Profile Viewer App** built using the **Laravel** framework. The application allows users to view profile details for a list of profiles, all stored in a static array. It is an excellent practice project to learn about routing, controllers, and Blade views in Laravel.

### Features

- **Profiles List (Unregistered Users):**
  - Visitors can access `/profiles` to see a list of all available profiles.
  
- **View Individual Profiles:**
  - Visitors can view individual profiles by accessing `/profiles/{id}` where `{id}` is the profile ID (e.g., `/profiles/1`). This will show the name, age, and email of the selected profile.

- **No Authentication or Database:**
  - The application does not require authentication or a database.
  - All data is stored in an array inside the controller.

---

## 🚀 How to Run the Project

1. **Clone the repository:**

```bash
git clone https://github.com/your-username/profile-viewer.git
cd profile-viewer
