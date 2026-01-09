<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create desainer users
        $desainer1 = User::create([
            'name' => 'Desainer One',
            'email' => 'desainer1@example.com',
            'password' => bcrypt('password'),
            'role' => 'desainer',
        ]);

        $desainer2 = User::create([
            'name' => 'Desainer Two',
            'email' => 'desainer2@example.com',
            'password' => bcrypt('password'),
            'role' => 'desainer',
        ]);

        $desainer3 = User::create([
            'name' => 'Desainer Three',
            'email' => 'desainer3@example.com',
            'password' => bcrypt('password'),
            'role' => 'desainer',
        ]);

        $desainer4 = User::create([
            'name' => 'Desainer Four',
            'email' => 'desainer4@example.com',
            'password' => bcrypt('password'),
            'role' => 'desainer',
        ]);

        $desainer5 = User::create([
            'name' => 'Desainer Five',
            'email' => 'desainer5@example.com',
            'password' => bcrypt('password'),
            'role' => 'desainer',
        ]);

        // Create regular users
        $user1 = User::create([
            'name' => 'Regular User 1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Regular User 2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $user3 = User::create([
            'name' => 'Regular User 3',
            'email' => 'user3@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $user4 = User::create([
            'name' => 'Regular User 4',
            'email' => 'user4@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Create services (20+ items)
        $services = [
            [
                'designer_id' => $desainer1->id,
                'title' => 'Logo Design Service',
                'description' => 'Professional logo design for your business. Kami menyediakan desain logo yang modern, unik dan professional. Cocok untuk startup hingga perusahaan besar.',
                'price' => 50000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer1->id,
                'title' => 'Banner Design',
                'description' => 'Eye-catching banner designs untuk website dan media sosial. Desain yang menarik perhatian dan meningkatkan engagement.',
                'price' => 30000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer1->id,
                'title' => 'Business Card Design',
                'description' => 'Desain kartu nama profesional yang membuat kesan pertama bagus. Include design konsep dan revisi unlimited.',
                'price' => 25000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer1->id,
                'title' => 'Social Media Kit',
                'description' => 'Paket lengkap design untuk social media (template Instagram, Facebook, Twitter). Konsisten dan menarik.',
                'price' => 75000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer2->id,
                'title' => 'Website UI/UX',
                'description' => 'Complete website design dan user experience dengan pendekatan modern. Responsive design untuk semua device.',
                'price' => 150000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer2->id,
                'title' => 'Mobile App UI Design',
                'description' => 'Desain interface aplikasi mobile yang user-friendly. Prototype dan wireframe included.',
                'price' => 120000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer2->id,
                'title' => 'Brand Identity Package',
                'description' => 'Paket lengkap branding: logo, color palette, typography, style guide, dan semua aset visual brand.',
                'price' => 250000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer3->id,
                'title' => 'Flyer & Poster Design',
                'description' => 'Desain flyer dan poster yang eye-catching. Printing ready dan digital ready.',
                'price' => 40000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer3->id,
                'title' => 'Packaging Design',
                'description' => 'Desain kemasan produk yang menarik dan professional. Meningkatkan perceived value produk.',
                'price' => 100000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer3->id,
                'title' => 'Infographic Design',
                'description' => 'Desain infografis yang menarik untuk menjelaskan data kompleks dengan cara visual yang mudah dipahami.',
                'price' => 80000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer4->id,
                'title' => 'Video Thumbnail Design',
                'description' => 'Desain thumbnail yang catchy untuk video YouTube. Meningkatkan click-through rate.',
                'price' => 20000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer4->id,
                'title' => 'Email Template Design',
                'description' => 'Custom email template yang responsive dan professional. Cocok untuk newsletter dan marketing email.',
                'price' => 60000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer4->id,
                'title' => 'Landing Page Design',
                'description' => 'Desain landing page yang converting dan optimized untuk sales. Inkludi copywriting advice.',
                'price' => 90000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer5->id,
                'title' => 'Presentation Design',
                'description' => 'Desain presentasi profesional untuk pitch, seminar, atau business meeting.',
                'price' => 70000,
                'status' => 'pending',
            ],
            [
                'designer_id' => $desainer5->id,
                'title' => 'Resume/CV Design',
                'description' => 'Desain resume yang modern dan eye-catching untuk meningkatkan peluang job interview.',
                'price' => 35000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer5->id,
                'title' => 'Icon Set Design',
                'description' => 'Custom icon set yang konsisten dan versatile. Cocok untuk website, app, atau branding.',
                'price' => 85000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer1->id,
                'title' => 'Illustration Service',
                'description' => 'Custom illustration untuk berbagai kebutuhan. Unique, original, dan sesuai brand identity Anda.',
                'price' => 110000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer2->id,
                'title' => 'Brochure Design',
                'description' => 'Desain brochure berkualitas tinggi untuk marketing dan presentasi produk.',
                'price' => 65000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer3->id,
                'title' => 'Book Cover Design',
                'description' => 'Desain cover buku yang menarik dan profesional. Printing dan digital ready.',
                'price' => 95000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer4->id,
                'title' => 'Certificate Design',
                'description' => 'Desain sertifikat profesional untuk penghargaan atau program pelatihan.',
                'price' => 45000,
                'status' => 'approved',
            ],
            [
                'designer_id' => $desainer5->id,
                'title' => 'T-Shirt Design',
                'description' => 'Desain kaos/t-shirt yang keren dan printing ready. Cocok untuk merchandise atau event.',
                'price' => 30000,
                'status' => 'approved',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Create orders
        $orders = [
            ['user_id' => $user1->id, 'service_id' => 1, 'status' => 'menunggu'],
            ['user_id' => $user1->id, 'service_id' => 2, 'status' => 'diproses'],
            ['user_id' => $user2->id, 'service_id' => 5, 'status' => 'selesai'],
            ['user_id' => $user2->id, 'service_id' => 6, 'status' => 'menunggu'],
            ['user_id' => $user3->id, 'service_id' => 8, 'status' => 'diproses'],
            ['user_id' => $user3->id, 'service_id' => 9, 'status' => 'selesai'],
            ['user_id' => $user4->id, 'service_id' => 10, 'status' => 'menunggu'],
            ['user_id' => $user4->id, 'service_id' => 11, 'status' => 'diproses'],
            ['user_id' => $user1->id, 'service_id' => 15, 'status' => 'selesai'],
            ['user_id' => $user2->id, 'service_id' => 16, 'status' => 'menunggu'],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}

