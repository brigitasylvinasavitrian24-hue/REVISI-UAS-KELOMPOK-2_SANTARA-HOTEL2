# Product Requirements Document (PRD)
## Santara Hotel Online Booking System

| **Dokumen** | Product Requirements Document |
|---|---|
| **Produk** | Santara Hotel Online Booking System |
| **Versi** | 1.0 (MVP) |
| **Status** | Draft |
| **Tanggal** | Juni 2026 |

---

## 1. Project Overview

### 1.1 Product Name
**Santara Hotel Online Booking System**

### 1.2 Objective
Membangun platform reservasi hotel berbasis web yang memungkinkan pelanggan melakukan pemesanan kamar dan layanan hotel secara **online, mudah, cepat, dan aman**. Sistem ini juga membantu pihak hotel dalam mengelola kamar, reservasi, pembayaran, serta data pelanggan secara **terpusat dan real-time**.

### 1.3 Target Users
- Masyarakat umum
- Wisatawan domestik dan internasional
- Pengguna yang terbiasa melakukan transaksi digital
- Staff dan administrator hotel
- Manajer hotel

### 1.4 Problem Statement
Proses reservasi hotel yang masih dilakukan secara manual sering menimbulkan berbagai kendala, seperti kesalahan pencatatan data, keterlambatan konfirmasi reservasi, serta kesulitan dalam memantau ketersediaan kamar secara real-time. Santara Hotel Online Booking System dirancang untuk **meningkatkan efisiensi operasional hotel** sekaligus memberikan **pengalaman pemesanan yang lebih praktis dan nyaman** bagi pelanggan.

### 1.5 Success Metrics
- **Okupansi kamar** meningkat minimal 15% dalam 6 bulan pertama
- **Waktu proses reservasi** berkurang dari rata-rata 15-30 menit (manual) menjadi <5 menit (online)
- **Kesalahan data reservasi** turun hingga <1%
- **Kepuasan pelanggan** terhadap proses booking ≥ 4.5/5

---

## 2. User Personas

### A. Customer (Guest)
| Aspek | Detail |
|---|---|
| **Usia** | 18–60 tahun |
| **Karakteristik** | Terbiasa menggunakan internet dan layanan digital |
| **Tujuan** | Mendapatkan proses pemesanan yang cepat dan mudah |
| **Kebutuhan** | Melihat ketersediaan kamar secara real-time; melakukan reservasi online; mendapat konfirmasi instan; mengelola riwayat pemesanan |

### B. Hotel Admin
| Aspek | Detail |
|---|---|
| **Peran** | Operasional reservasi hotel |
| **Kebutuhan** | Mengelola data kamar; mengelola reservasi pelanggan; memverifikasi pembayaran; mengelola data pelanggan |

### C. Hotel Manager
| Aspek | Detail |
|---|---|
| **Peran** | Performa bisnis hotel |
| **Kebutuhan** | Melihat laporan reservasi; memantau tingkat okupansi kamar; memantau pendapatan hotel; menganalisis tren pemesanan |

---

## 3. Core Features

### 3.1 Room Search & Availability
Pengguna dapat mencari kamar berdasarkan:
- Tanggal check-in
- Tanggal check-out
- Jumlah tamu
- Tipe kamar

Sistem akan menampilkan kamar yang tersedia secara **real-time** beserta harga dan fasilitas.

### 3.2 Online Reservation
- Pengguna memilih kamar
- Mengisi data tamu
- Meninjau detail pemesanan
- Menyelesaikan proses reservasi secara online

### 3.3 Secure Payment & Confirmation
Sistem mendukung pembayaran melalui **payment gateway** (Midtrans/Xendit). Setelah pembayaran berhasil diverifikasi, sistem akan mengirimkan **konfirmasi reservasi secara otomatis** melalui email.

### 3.4 Booking Management (User)
Pengguna dapat:
- Melihat riwayat reservasi
- Melihat status pembayaran
- Melihat detail pemesanan
- Melakukan pembatalan reservasi sesuai kebijakan hotel

### 3.5 Room Management (Admin)
Admin dapat:
- Menambah data kamar
- Mengubah data kamar
- Menghapus data kamar
- Mengatur status kamar (`Available`, `Occupied`, `Maintenance`)

### 3.6 Reservation Management (Admin)
Admin dapat:
- Melihat seluruh data reservasi
- Mengelola status reservasi
- Memverifikasi pembayaran
- Mengelola data pelanggan

### 3.7 Dashboard & Reporting (Manager)
Manajemen hotel dapat melihat:
- Total reservasi (harian/mingguan/bulanan)
- Tingkat okupansi kamar
- Pendapatan hotel
- Statistik operasional hotel
- Ekspor laporan ke Excel

---

## 4. Technology Stack

| Komponen | Teknologi |
|---|---|
| **Backend** | Laravel 12 & PHP 8.3+ |
| **Frontend** | Blade Template Engine, Tailwind CSS 4, Alpine.js |
| **Database** | MySQL 8 |
| **Authentication** | Laravel Breeze |
| **Payment Gateway** | Midtrans / Xendit (Alternatif) |
| **Admin Dashboard** | Filament v4 |
| **Additional** | Spatie Laravel Permission, Laravel Queue, Laravel Scheduler, Laravel Excel |

### 4.1 Architecture Overview
```
┌─────────────────────────────────────────────────────┐
│                   Client Browser                      │
├─────────────────────────────────────────────────────┤
│     Blade + Tailwind CSS 4 + Alpine.js (Frontend)   │
├─────────────────────────────────────────────────────┤
│                   Laravel 12 (Backend)               │
├─────────────────────────────────────────────────────┤
│         Filament v4 (Admin Dashboard)                │
├─────────────────────────────────────────────────────┤
│  Spatie Permission  │  Queue  │  Scheduler  │ Excel │
├─────────────────────────────────────────────────────┤
│                  MySQL 8 (Database)                  │
├─────────────────────────────────────────────────────┤
│         Midtrans / Xendit (Payment Gateway)          │
└─────────────────────────────────────────────────────┘
```

---

## 5. Database Design & Relationships

### 5.1 Entity Relationship Diagram (ERD)

```
┌──────────────┐       ┌──────────────┐       ┌──────────────┐
│     User      │       │   RoomType    │       │HotelService  │
├──────────────┤       ├──────────────┤       ├──────────────┤
│ id (PK)      │       │ id (PK)      │       │ id (PK)      │
│ name         │       │ name         │       │ name         │
│ email        │       │ description  │       │ price        │
│ phone        │       │ capacity     │       └──────────────┘
│ password     │       └──────┬───────┘              │
│ role         │              │                      │
└──────┬───────┘              │                      │
       │                      │                      │
       │ 1                    │ 1                    │ M
       │                      │                      │
       │ M                    │ M                    │
┌──────┴───────┐       ┌──────┴───────┐       ┌──────┴────────┐
│   Booking     │       │    Room       │       │BookingService │
├──────────────┤       ├──────────────┤       ├───────────────┤
│ id (PK)      │       │ id (PK)      │       │ booking_id(FK)│
│ user_id (FK) │───────│ room_type_id │       │ service_id(FK)│
│ room_id (FK) │       │ room_number  │       └───────────────┘
│ check_in     │       │ price        │
│ check_out    │       │ status       │
│ total_price  │       └──────────────┘
│ status       │
└──────┬───────┘
       │
       │ 1
       │
┌──────┴───────┐
│   Payment     │
├──────────────┤
│ id (PK)      │
│ booking_id   │
│ method       │
│ amount       │
│ status       │
│ reference    │
└──────────────┘
```

### 5.2 Tabel & Relasi

#### User
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigInteger, PK | Auto increment |
| `name` | string(255) | Nama lengkap |
| `email` | string(255), unique | Email login |
| `phone` | string(20), nullable | Nomor telepon |
| `password` | string(255) | Password ter-hash |
| `role` | enum: customer, admin, manager | Role pengguna |
| `timestamps` | - | created_at, updated_at |

**Relasi:** `User hasMany Booking`

#### RoomType
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigInteger, PK | Auto increment |
| `name` | string(255) | Nama tipe kamar (Deluxe, Suite, etc.) |
| `description` | text, nullable | Deskripsi tipe kamar |
| `capacity` | integer | Kapasitas maksimal tamu |
| `timestamps` | - | created_at, updated_at |

**Relasi:** `RoomType hasMany Room`

#### Room
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigInteger, PK | Auto increment |
| `room_number` | string(20), unique | Nomor kamar |
| `room_type_id` | bigInteger, FK → RoomType.id | Tipe kamar |
| `price` | decimal(12,2) | Harga per malam |
| `status` | enum: available, occupied, maintenance | Status kamar |
| `timestamps` | - | created_at, updated_at |

**Relasi:**
- `Room belongsTo RoomType`
- `Room hasMany Booking`

#### Booking
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigInteger, PK | Auto increment |
| `booking_code` | string(20), unique | Kode unik reservasi |
| `user_id` | bigInteger, FK → User.id | Pemesan |
| `room_id` | bigInteger, FK → Room.id | Kamar yang dipesan |
| `check_in` | date | Tanggal check-in |
| `check_out` | date | Tanggal check-out |
| `total_price` | decimal(12,2) | Total harga |
| `status` | enum: pending, confirmed, checked_in, checked_out, cancelled | Status reservasi |
| `timestamps` | - | created_at, updated_at |

**Relasi:**
- `Booking belongsTo User`
- `Booking belongsTo Room`
- `Booking hasOne Payment`
- `Booking belongsToMany HotelService` (through BookingService)

#### Payment
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigInteger, PK | Auto increment |
| `booking_id` | bigInteger, FK → Booking.id | Reservasi terkait |
| `payment_method` | string(50) | Metode pembayaran (credit_card, bank_transfer, etc.) |
| `amount` | decimal(12,2) | Jumlah pembayaran |
| `status` | enum: pending, success, failed, refunded | Status pembayaran |
| `transaction_reference` | string(255), nullable | Referensi dari payment gateway |
| `paid_at` | timestamp, nullable | Waktu pembayaran |
| `timestamps` | - | created_at, updated_at |

**Relasi:** `Payment belongsTo Booking`

#### HotelService
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigInteger, PK | Auto increment |
| `name` | string(255) | Nama layanan (Extra Bed, Breakfast, etc.) |
| `price` | decimal(12,2) | Harga layanan |
| `timestamps` | - | created_at, updated_at |

**Relasi:** `HotelService belongsToMany Booking` (through BookingService)

#### BookingService (Pivot)
| Kolom | Tipe | Keterangan |
|---|---|---|
| `booking_id` | bigInteger, FK → Booking.id | ID booking |
| `service_id` | bigInteger, FK → HotelService.id | ID layanan |

**Relasi:** Many-to-Many antara Booking dan HotelService

---

## 6. User Flows

### A. Room Booking Flow

```
┌─────────┐    ┌──────────┐    ┌──────────────┐    ┌──────────┐
│Homepage │───→│Cari Kamar│───→│Lihat Tersedia│───→│Pilih Kamar│
└─────────┘    └──────────┘    └──────────────┘    └──────────┘
                                                         │
                                                         ▼
                                                    ┌──────────┐
                                                    │Isi Data   │
                                                    │Tamu      │
                                                    └──────────┘
                                                         │
                                                         ▼
┌──────────────┐    ┌──────────┐    ┌─────────────────┐
│Konfirmasi    │←───│Pembayaran│←───│Review Booking   │
│Reservasi     │    │         │    │Detail           │
└──────────────┘    └──────────┘    └─────────────────┘
```

### B. Payment Flow

```
┌───────────┐    ┌───────────────┐    ┌──────────────────┐
│Booking    │───→│Pilih Metode   │───→│Redirect ke       │
│Dibuat     │    │Pembayaran     │    │Payment Gateway   │
└───────────┘    └───────────────┘    └──────────────────┘
                                             │
                                             ▼
                                    ┌──────────────────┐
                                    │Pembayaran Berhasil│
                                    └──────────────────┘
                                             │
                                             ▼
┌──────────────────┐    ┌──────────────────┐
│Email Konfirmasi  │←───│Status Booking    │
│Reservasi         │    │Diperbarui        │
└──────────────────┘    └──────────────────┘
```

### C. Admin Room Management Flow

```
┌───────────┐    ┌───────────┐    ┌──────────────┐
│Login Admin│───→│Dashboard  │───→│Kelola Kamar  │
└───────────┘    └───────────┘    └──────────────┘
                                         │
                         ┌───────────────┼───────────────┐
                         ▼               ▼               ▼
                   ┌──────────┐   ┌──────────┐   ┌──────────┐
                   │Tambah    │   │Edit Data │   │Update    │
                   │Kamar     │   │Kamar     │   │Status    │
                   └──────────┘   └──────────┘   └──────────┘
                         │               │               │
                         └───────────────┼───────────────┘
                                         ▼
                               ┌──────────────────┐
                               │Data Tersimpan &  │
                               │Tampil di Website │
                               └──────────────────┘
```

---

## 7. UI / Page Specifications

### 7.1 Public Pages (Customer)
| No | Halaman | Deskripsi |
|---|---|---|
| 1 | **Homepage** | Hero section, form pencarian kamar, promo, layanan unggulan |
| 2 | **Room List** | Daftar kamar tersedia dengan filter (tipe, harga, kapasitas) |
| 3 | **Room Detail** | Informasi detail kamar, fasilitas, harga, form booking |
| 4 | **Booking Form** | Formulir data tamu, review booking, ringkasan harga |
| 5 | **Payment** | Pilih metode pembayaran, redirect ke payment gateway |
| 6 | **Booking Success** | Konfirmasi sukses, detail reservasi, instruksi |
| 7 | **My Bookings** | Riwayat reservasi pengguna, status, aksi (detail/cancel) |
| 8 | **Login / Register** | Autentikasi pengguna |
| 9 | **Contact / About** | Informasi hotel, kontak, lokasi |

### 7.2 Admin Pages (Filament Dashboard)
| No | Halaman | Deskripsi |
|---|---|---|
| 1 | **Dashboard** | Ringkasan statistik (total booking, pendapatan, okupansi) |
| 2 | **Room Management** | CRUD kamar, status kamar |
| 3 | **Room Type Management** | CRUD tipe kamar |
| 4 | **Booking Management** | Daftar reservasi, detail, update status, verifikasi bayar |
| 5 | **User Management** | Daftar pelanggan, detail |
| 6 | **Payment Management** | Riwayat transaksi, status pembayaran |
| 7 | **Hotel Services** | CRUD layanan tambahan |
| 8 | **Reports** | Laporan reservasi, pendapatan, okupansi (export Excel) |

---

## 8. Non-Functional Requirements

| Kategori | Requirement |
|---|---|
| **Performance** | Waktu muat halaman < 3 detik; query database < 500ms |
| **Security** | Enkripsi password (bcrypt); proteksi CSRF; XSS filtering; HTTPS; role-based access control (Spatie Permission) |
| **Availability** | Uptime ≥ 99.5% |
| **Scalability** | Mendukung pertumbuhan hingga 10.000 reservasi/bulan |
| **Responsiveness** | Tampilan responsif di desktop, tablet, dan mobile |
| **SEO** | Meta tags, sitemap, URL friendly |
| **Backup** | Backup database harian otomatis |

---

## 9. Milestones & Timeline

| Fase | Kegiatan | Estimasi |
|---|---|---|
| **Fase 1** | Setup project, database schema, authentication (Breeze) | Minggu 1 |
| **Fase 2** | Room & RoomType CRUD, Room Search & Availability | Minggu 2 |
| **Fase 3** | Booking system, Payment Gateway Integration | Minggu 3-4 |
| **Fase 4** | Filament Admin Dashboard, Reporting | Minggu 5 |
| **Fase 5** | User Booking Management, Email Notification | Minggu 6 |
| **Fase 6** | Testing, Bug Fixing, Deployment | Minggu 7 |
| **Fase 7** | UAT (User Acceptance Testing) & Go-Live | Minggu 8 |

---

## 10. Out of Scope (MVP Exclusions)

Fitur berikut **tidak** termasuk dalam versi Minimum Viable Product (MVP):

- ❌ Aplikasi mobile native (Android/iOS)
- ❌ Loyalty & Membership Program
- ❌ AI Chatbot Customer Service
- ❌ Dynamic Pricing
- ❌ Integrasi OTA (Traveloka, Agoda, Booking.com)
- ❌ Multi-Hotel Management
- ❌ Self Check-In dengan QR Code
- ❌ Housekeeping Management System
- ❌ Integrasi POS Restoran Hotel
- ❌ Multi-bahasa selain Bahasa Indonesia & Bahasa Inggris

---

## 11. Glossary

| Istilah | Definisi |
|---|---|
| **Check-in** | Waktu tamu mulai menempati kamar |
| **Check-out** | Waktu tamu meninggalkan kamar |
| **Okupansi** | Persentase kamar terisi terhadap total kamar tersedia |
| **Payment Gateway** | Layanan pihak ketiga untuk memproses pembayaran online |
| **OTA** | Online Travel Agent (Traveloka, Agoda, dll.) |
| **UAT** | User Acceptance Testing — pengujian oleh pengguna akhir |
| **MVP** | Minimum Viable Product — versi produk dengan fitur minimal yang layak rilis |

---

> **Dokumen ini disusun sebagai acuan pengembangan Santara Hotel Online Booking System versi MVP. Seluruh fitur dan spesifikasi dapat berubah sesuai kebutuhan bisnis dan masukan dari stakeholder.**
