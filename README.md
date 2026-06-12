# Product Requirements Document (PRD)
## Santara Hotel Online Booking System

---

## 1. Project Overview

### Product Name
Santara Hotel Online Booking System

### Objective
Membangun platform reservasi hotel berbasis web yang memungkinkan pelanggan melakukan pemesanan kamar dan layanan hotel secara online dengan mudah, cepat, dan aman. Sistem ini juga membantu pihak hotel dalam mengelola kamar, reservasi, pembayaran, serta data pelanggan secara terpusat dan real-time.

### Target Users
* Masyarakat umum
* Wisatawan domestik dan internasional
* Pengguna yang terbiasa melakukan transaksi digital
* Staff dan administrator hotel
* Manajer hotel

### Problem Statement
Proses reservasi hotel yang masih dilakukan secara manual sering menimbulkan berbagai kendala, seperti kesalahan pencatatan data, keterlambatan konfirmasi reservasi, serta kesulitan dalam memantau ketersediaan kamar secara real-time. Santara Hotel Online Booking System dirancang untuk meningkatkan efisiensi operasional hotel sekaligus memberikan pengalaman pemesanan yang lebih praktis dan nyaman bagi pelanggan.

---

## 2. User Personas

### A. Customer (Guest)
* **Karakteristik:**
  * Usia 18–60 tahun
  * Terbiasa menggunakan internet dan layanan digital
  * Membutuhkan proses pemesanan yang cepat dan mudah
* **Kebutuhan:**
  * Melihat ketersediaan kamar secara real-time
  * Melakukan reservasi secara online
  * Mendapatkan konfirmasi pemesanan secara instan
  * Mengelola data dan riwayat pemesanan

### B. Hotel Admin
* **Karakteristik:**
  * Bertanggung jawab atas operasional reservasi hotel
* **Kebutuhan:**
  * Mengelola data kamar
  * Mengelola reservasi pelanggan
  * Memverifikasi pembayaran
  * Mengelola data pelanggan

### C. Hotel Manager
* **Karakteristik:**
  * Bertanggung jawab terhadap performa bisnis hotel
* **Kebutuhan:**
  * Melihat laporan reservasi
  * Memantau tingkat okupansi kamar
  * Memantau pendapatan hotel
  * Menganalisis tren pemesanan

---

## 3. Core Features

### 1. Room Search & Availability
Pengguna dapat mencari kamar berdasarkan tanggal check-in, tanggal check-out, jumlah tamu, dan tipe kamar. Sistem akan menampilkan kamar yang tersedia secara real-time.

### 2. Online Reservation
Pengguna dapat memilih kamar, mengisi data tamu, meninjau detail pemesanan, dan menyelesaikan proses reservasi secara online.

### 3. Secure Payment & Confirmation
Sistem mendukung pembayaran melalui payment gateway. Setelah pembayaran berhasil diverifikasi, sistem akan mengirimkan konfirmasi reservasi secara otomatis.

### 4. Booking Management
Pengguna dapat:
* Melihat riwayat reservasi
* Melihat status pembayaran
* Melihat detail pemesanan
* Melakukan pembatalan reservasi sesuai kebijakan hotel

### 5. Room Management (Admin)
Admin dapat:
* Menambah data kamar
* Mengubah data kamar
* Menghapus data kamar
* Mengatur status kamar (*Available, Occupied, Maintenance*)

### 6. Reservation Management (Admin)
Admin dapat:
* Melihat seluruh data reservasi
* Mengelola status reservasi
* Memverifikasi pembayaran
* Mengelola data pelanggan

### 7. Dashboard & Reporting
Manajemen hotel dapat melihat:
* Total reservasi
* Tingkat okupansi kamar
* Pendapatan hotel
* Statistik operasional hotel

---

## 4. Technology Stack

* **Backend:** Laravel 12 & PHP 8.3+
* **Frontend:** Blade Template Engine, Tailwind CSS 4, Alpine.js
* **Database:** MySQL 8
* **Authentication:** Laravel Breeze
* **Payment Gateway:** Midtrans / Xendit (Alternatif)
* **Dashboard Framework:** Filament v4
* **Additional Packages:** Spatie Laravel Permission, Laravel Queue, Laravel Scheduler, Laravel Excel

---

## 5. Database Design & Relationships

### `User`
* **Attributes:** id, name, email, phone, role
* **Relationship:** User `hasMany` Bookings

### `RoomType`
* **Attributes:** id, name, description, capacity
* **Relationship:** RoomType `hasMany` Rooms

### `Room`
* **Attributes:** id, room_number, room_type_id, price, status
* **Relationship:** 
  * Room `belongsTo` RoomType
  * Room `hasMany` Bookings

### `Booking`
* **Attributes:** id, user_id, room_id, check_in, check_out, total_price, booking_status
* **Relationship:** 
  * Booking `belongsTo` User
  * Booking `belongsTo` Room
  * Booking `hasOne` Payment

### `Payment`
* **Attributes:** id, booking_id, payment_method, amount, payment_status, transaction_reference
* **Relationship:** Payment `belongsTo` Booking

### `HotelService`
* **Attributes:** id, name, price

### `BookingService`
* **Attributes:** booking_id, service_id
* **Relationship:** *Many-to-Many* antara Booking dan HotelService

---

## 6. User Flows

* **A. Room Booking Flow**
  > Homepage → Cari Kamar → Lihat Ketersediaan → Pilih Kamar → Isi Data Tamu → Review Booking → Pembayaran → Konfirmasi Reservasi
* **B. Payment Flow**
  > Booking Dibuat → Pilih Metode Pembayaran → Redirect ke Payment Gateway → Pembayaran Berhasil → Status Booking Diperbarui → Konfirmasi Reservasi
* **C. Admin Room Management Flow**
  > Login Admin → Dashboard → Kelola Kamar → Tambah/Edit Data Kamar → Update Status Kamar → Data Tersimpan dan Ditampilkan di Website

---

## 7. Out of Scope (MVP Exclusions)

Fitur berikut tidak termasuk dalam versi Minimum Viable Product (MVP):
* Aplikasi mobile (Android/iOS)
* Loyalty & Membership Program
* AI Chatbot Customer Service
* Dynamic Pricing
* Integrasi OTA (Traveloka, Agoda, Booking.com)
* Multi-Hotel Management
* Self Check-In dengan QR Code
* Housekeeping Management System
* Integrasi POS Restoran Hotel
* Dukungan multi-bahasa selain Bahasa Indonesia dan Bahasa Inggris
