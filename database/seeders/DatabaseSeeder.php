<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with real-world data.
     */
    public function run(): void
    {
        // 1. Seed Users (Admins and Students/Clients)
        $admin = User::firstOrCreate(
            ['email' => 'admin@library.edu'],
            [
                'name' => 'Dr. Robert Vance (Librarian)',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $student1 = User::firstOrCreate(
            ['email' => 'sophia.chen@student.edu'],
            [
                'name' => 'Sophia Chen',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        $student2 = User::firstOrCreate(
            ['email' => 'marcus.johnson@student.edu'],
            [
                'name' => 'Marcus Johnson',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        $student3 = User::firstOrCreate(
            ['email' => 'emma.watson@student.edu'],
            [
                'name' => 'Emma Watson',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        $student4 = User::firstOrCreate(
            ['email' => 'david.kim@student.edu'],
            [
                'name' => 'David Kim',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed Real Academic Categories
        $categoriesData = [
            [
                'name' => 'Computer Science & AI',
                'description' => 'Algorithms, data structures, artificial intelligence, software engineering, and systems architecture.',
            ],
            [
                'name' => 'Data Science & Mathematics',
                'description' => 'Statistical learning, linear algebra, probability theory, machine learning, and data visualization.',
            ],
            [
                'name' => 'Psychology & Behavioral Science',
                'description' => 'Cognitive science, human behavior, decision making, neurobiology, and clinical psychology.',
            ],
            [
                'name' => 'Business, Economics & Finance',
                'description' => 'Microeconomics, behavioral economics, startup management, venture finance, and leadership strategy.',
            ],
            [
                'name' => 'Philosophy & Scientific Thought',
                'description' => 'Epistemology, ethics, history of modern science, logic, and philosophy of mind.',
            ],
            [
                'name' => 'Design & Human-Computer Interaction',
                'description' => 'User experience principles, graphic design theory, interaction patterns, and ergonomics.',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['name']] = Category::firstOrCreate(
                ['name' => $cat['name']],
                ['description' => $cat['description']]
            );
        }

        // 3. Seed 14 Real World Famous Books with Real Cover Images
        $booksData = [
            // Computer Science
            [
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'author' => 'Robert C. Martin',
                'isbn' => '978-0132350884',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2008-08-01',
                'category_id' => $categories['Computer Science & AI']->id,
            ],
            [
                'title' => 'The Pragmatic Programmer: Your Journey To Mastery',
                'author' => 'Andrew Hunt & David Thomas',
                'isbn' => '978-0135957059',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2019-09-13',
                'category_id' => $categories['Computer Science & AI']->id,
            ],
            [
                'title' => 'Designing Data-Intensive Applications',
                'author' => 'Martin Kleppmann',
                'isbn' => '978-1449373320',
                'image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2017-03-16',
                'category_id' => $categories['Computer Science & AI']->id,
            ],
            [
                'title' => 'Clean Architecture: A Craftsman’s Guide to Software Structure',
                'author' => 'Robert C. Martin',
                'isbn' => '978-0134494166',
                'image' => 'https://images.unsplash.com/photo-1516116211227-bbc00c920f06?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2017-09-10',
                'category_id' => $categories['Computer Science & AI']->id,
            ],
            [
                'title' => 'Artificial Intelligence: A Modern Approach',
                'author' => 'Stuart Russell & Peter Norvig',
                'isbn' => '978-0134610993',
                'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2020-04-28',
                'category_id' => $categories['Computer Science & AI']->id,
            ],

            // Data Science & Math
            [
                'title' => 'Hands-On Machine Learning with Scikit-Learn, Keras, and TensorFlow',
                'author' => 'Aurélien Géron',
                'isbn' => '978-1098125974',
                'image' => 'https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2022-10-18',
                'category_id' => $categories['Data Science & Mathematics']->id,
            ],
            [
                'title' => 'An Introduction to Statistical Learning',
                'author' => 'Gareth James & Daniela Witten',
                'isbn' => '978-1071614174',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2021-07-28',
                'category_id' => $categories['Data Science & Mathematics']->id,
            ],

            // Psychology & Behavioral Science
            [
                'title' => 'Thinking, Fast and Slow',
                'author' => 'Daniel Kahneman',
                'isbn' => '978-0374533557',
                'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2011-10-25',
                'category_id' => $categories['Psychology & Behavioral Science']->id,
            ],
            [
                'title' => 'Atomic Habits: Tiny Changes, Remarkable Results',
                'author' => 'James Clear',
                'isbn' => '978-0735211292',
                'image' => 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2018-10-16',
                'category_id' => $categories['Psychology & Behavioral Science']->id,
            ],

            // Business & Economics
            [
                'title' => 'Zero to One: Notes on Startups, or How to Build the Future',
                'author' => 'Peter Thiel',
                'isbn' => '978-0804139298',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2014-09-16',
                'category_id' => $categories['Business, Economics & Finance']->id,
            ],
            [
                'title' => 'The Lean Startup: How Constant Innovation Creates Radically Successful Businesses',
                'author' => 'Eric Ries',
                'isbn' => '978-0307887894',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2011-09-13',
                'category_id' => $categories['Business, Economics & Finance']->id,
            ],

            // Design & HCI
            [
                'title' => 'The Design of Everyday Things',
                'author' => 'Don Norman',
                'isbn' => '978-0465050659',
                'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2013-11-05',
                'category_id' => $categories['Design & Human-Computer Interaction']->id,
            ],
            [
                'title' => 'Don’t Make Me Think, Revisited: A Common Sense Approach to Web Usability',
                'author' => 'Steve Krug',
                'isbn' => '978-0321965516',
                'image' => 'https://images.unsplash.com/photo-1581291518655-9523c932deb8?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2014-01-03',
                'category_id' => $categories['Design & Human-Computer Interaction']->id,
            ],

            // Philosophy & Science
            [
                'title' => 'The Structure of Scientific Revolutions',
                'author' => 'Thomas S. Kuhn',
                'isbn' => '978-0226458120',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=600&q=80',
                'published_date' => '2012-04-30',
                'category_id' => $categories['Philosophy & Scientific Thought']->id,
            ],
        ];

        $createdBooks = [];
        foreach ($booksData as $b) {
            $createdBooks[] = Book::updateOrCreate(
                ['isbn' => $b['isbn']],
                [
                    'title' => $b['title'],
                    'author' => $b['author'],
                    'image' => $b['image'],
                    'published_date' => $b['published_date'],
                    'category_id' => $b['category_id'],
                ]
            );
        }

        // 4. Seed Real Student Borrowings (Mix of Active & Returned Loans)
        $now = Carbon::now();

        // Check if existing borrowings exist, if none seed them
        if (Borrowing::count() === 0 && count($createdBooks) >= 6) {
            // Sophia active loan 1
            Borrowing::create([
                'user_id' => $student1->id,
                'book_id' => $createdBooks[0]->id, // Clean Code
                'borrowed_at' => $now->copy()->subDays(4)->toDateString(),
                'created_at' => $now->copy()->subDays(4),
                'returned_at' => null,
            ]);

            // Sophia returned loan 2
            Borrowing::create([
                'user_id' => $student1->id,
                'book_id' => $createdBooks[7]->id, // Thinking, Fast and Slow
                'borrowed_at' => $now->copy()->subDays(25)->toDateString(),
                'created_at' => $now->copy()->subDays(25),
                'returned_at' => $now->copy()->subDays(12)->toDateString(),
            ]);

            // Marcus active loan
            Borrowing::create([
                'user_id' => $student2->id,
                'book_id' => $createdBooks[2]->id, // Designing Data-Intensive Applications
                'borrowed_at' => $now->copy()->subDays(2)->toDateString(),
                'created_at' => $now->copy()->subDays(2),
                'returned_at' => null,
            ]);

            // Marcus returned loan
            Borrowing::create([
                'user_id' => $student2->id,
                'book_id' => $createdBooks[9]->id, // Zero to One
                'borrowed_at' => $now->copy()->subDays(30)->toDateString(),
                'created_at' => $now->copy()->subDays(30),
                'returned_at' => $now->copy()->subDays(15)->toDateString(),
            ]);

            // Emma active loan
            Borrowing::create([
                'user_id' => $student3->id,
                'book_id' => $createdBooks[11]->id, // The Design of Everyday Things
                'borrowed_at' => $now->copy()->subDays(7)->toDateString(),
                'created_at' => $now->copy()->subDays(7),
                'returned_at' => null,
            ]);

            // David Kim active loan
            Borrowing::create([
                'user_id' => $student4->id,
                'book_id' => $createdBooks[5]->id, // Hands-On Machine Learning
                'borrowed_at' => $now->copy()->subDays(6)->toDateString(),
                'created_at' => $now->copy()->subDays(6),
                'returned_at' => null,
            ]);

            // David Kim returned loan
            Borrowing::create([
                'user_id' => $student4->id,
                'book_id' => $createdBooks[8]->id, // Atomic Habits
                'borrowed_at' => $now->copy()->subDays(40)->toDateString(),
                'created_at' => $now->copy()->subDays(40),
                'returned_at' => $now->copy()->subDays(26)->toDateString(),
            ]);
        }
    }
}
