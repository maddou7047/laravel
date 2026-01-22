<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Keuzedeel;
use App\Models\Enrollment;
use App\Models\EnrollmentPeriod;
use App\Models\CompletedKeuzedeel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create admin users
        User::create([
            'name' => 'Admin TCR',
            'email' => 'admin@tcr.nl',
            'password' => bcrypt('password'),
            'Role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin Beheerder',
            'email' => 'beheer@tcr.nl',
            'password' => bcrypt('password'),
            'Role' => 'admin',
        ]);

        // Create SLB user
        User::create([
            'name' => 'SLB Mentor',
            'email' => 'slb@tcr.nl',
            'password' => bcrypt('password'),
            'Role' => 'slb',
            'Opleiding' => 'Software Development',
        ]);

        // Create student users
        $students = [
            ['name' => 'Jan Jansen', 'email' => 'jan@tcr.nl', 'klas' => 'SO2A'],
            ['name' => 'Emma de Vries', 'email' => 'emma@tcr.nl', 'klas' => 'SO2A'],
            ['name' => 'Mohammed Ali', 'email' => 'mohammed@tcr.nl', 'klas' => 'SO2B'],
            ['name' => 'Sophie Peters', 'email' => 'sophie@tcr.nl', 'klas' => 'SO2B'],
            ['name' => 'Lucas van Dam', 'email' => 'lucas@tcr.nl', 'klas' => 'SO2C'],
            ['name' => 'Maya Cohen', 'email' => 'maya@tcr.nl', 'klas' => 'SO2C'],
            ['name' => 'Daan Bakker', 'email' => 'daan@tcr.nl', 'klas' => 'SO3A'],
            ['name' => 'Lisa Smit', 'email' => 'lisa@tcr.nl', 'klas' => 'SO3A'],
            ['name' => 'Ahmed Hassan', 'email' => 'ahmed@tcr.nl', 'klas' => 'SO3B'],
            ['name' => 'Anna de Jong', 'email' => 'anna@tcr.nl', 'klas' => 'SO3B'],
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => bcrypt('password'),
                'Role' => 'student',
                'KlasCode' => $student['klas'],
                'Opleiding' => 'Software Development',
            ]);
        }

        // Create keuzedelen
        $keuzedelen = [
            [
                'Code' => '25604K0059',
                'Name' => 'Verdieping Software',
                'Description' => 'Verdiep je kennis in moderne softwareontwikkeling',
                'Content' => 'Je leert geavanceerde programmeerconcepten, design patterns, en best practices voor professionele softwareontwikkeling.',
                'Periode' => 2,
                'IsRepeatable' => true,
            ],
            [
                'Code' => '25604K0060',
                'Name' => 'Basis Programmeren',
                'Description' => 'Leer de fundamenten van programmeren',
                'Content' => 'In dit keuzedeel maak je kennis met variabelen, loops, functies en basis datastructuren.',
                'Periode' => 2,
                'IsRepeatable' => false,
            ],
            [
                'Code' => '25604K0061',
                'Name' => 'Web Development',
                'Description' => 'Bouw moderne websites met HTML, CSS en JavaScript',
                'Content' => 'Je leert responsive websites bouwen, frameworks gebruiken zoals Laravel, en RESTful APIs maken.',
                'Periode' => 2,
                'IsRepeatable' => false,
            ],
            [
                'Code' => '25604K0062',
                'Name' => 'Game Development',
                'Description' => 'Maak je eigen games met Unity of Unreal Engine',
                'Content' => 'Leer game design principes, physics, AI voor NPCs, en multiplayer networking.',
                'Periode' => 2,
                'IsRepeatable' => false,
            ],
            [
                'Code' => '25604K0063',
                'Name' => 'Data Science Basics',
                'Description' => 'Ontdek de wereld van data analyse en machine learning',
                'Content' => 'Python voor data analyse, pandas, numpy, visualisatie met matplotlib, en introductie machine learning.',
                'Periode' => 3,
                'IsRepeatable' => false,
            ],
            [
                'Code' => '25604K0064',
                'Name' => 'Mobile App Development',
                'Description' => 'Bouw native apps voor iOS en Android',
                'Content' => 'React Native of Flutter, API integratie, app store deployment, en mobile UX design.',
                'Periode' => 3,
                'IsRepeatable' => false,
            ],
            [
                'Code' => '25604K0065',
                'Name' => 'Cybersecurity Fundamentals',
                'Description' => 'Leer over ethical hacking en beveiliging',
                'Content' => 'Netwerk security, penetration testing, encryptie, en beveiligde code schrijven.',
                'Periode' => 3,
                'IsRepeatable' => false,
            ],
            [
                'Code' => '25604K0066',
                'Name' => 'Cloud Computing (AWS)',
                'Description' => 'Deploy applicaties naar de cloud',
                'Content' => 'AWS services, serverless architectuur, containers met Docker, en CI/CD pipelines.',
                'Periode' => 4,
                'IsRepeatable' => false,
                'IsActive' => false,  // Inactive example
            ],
        ];

        foreach ($keuzedelen as $keuzedeel) {
            Keuzedeel::create($keuzedeel);
        }

        // Create enrollment period
        EnrollmentPeriod::create([
            'Name' => 'Periode 2 - 2025',
            'StartDate' => now()->subDays(5),
            'EndDate' => now()->addDays(10),
            'IsActive' => true,
        ]);

        // Create sample enrollments
        // Jan -> Verdieping Software
        Enrollment::create([
            'UserId' => 4,  // Jan (first student after admins + SLB)
            'KeuzdeelId' => 1,
        ]);

        // Emma -> Basis Programmeren
        Enrollment::create([
            'UserId' => 5,
            'KeuzdeelId' => 2,
        ]);

        // Mohammed -> Web Development
        Enrollment::create([
            'UserId' => 6,
            'KeuzdeelId' => 3,
        ]);

        // Sophie -> Verdieping Software
        Enrollment::create([
            'UserId' => 7,
            'KeuzdeelId' => 1,
        ]);

        // Lucas -> Game Development
        Enrollment::create([
            'UserId' => 8,
            'KeuzdeelId' => 4,
        ]);

        // Maya completed Basis Programmeren last year
        CompletedKeuzedeel::create([
            'UserId' => 9,  // Maya
            'KeuzdeelCode' => '25604K0060',
            'CompletedAt' => now()->subMonths(6),
        ]);
    }
}
