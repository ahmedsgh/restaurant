<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@restau.com',
            'password' => bcrypt('password'),
        ]);

        // Create categories
        $appetizers = Category::create([
            'name' => [
                'en' => 'Appetizers',
                'fr' => 'Entrées',
                'ar' => 'المقبلات',
                'es' => 'Aperitivos'
            ],
            'slug' => 'appetizers',
            'is_active' => true,
        ]);

        $mainCourses = Category::create([
            'name' => [
                'en' => 'Main Courses',
                'fr' => 'Plats Principaux',
                'ar' => 'الأطباق الرئيسية',
                'es' => 'Platos Principales'
            ],
            'slug' => 'main-courses',
            'is_active' => true,
        ]);

        $desserts = Category::create([
            'name' => [
                'en' => 'Desserts',
                'fr' => 'Desserts',
                'ar' => 'الحلويات',
                'es' => 'Postres'
            ],
            'slug' => 'desserts',
            'is_active' => true,
        ]);

        $beverages = Category::create([
            'name' => [
                'en' => 'Beverages',
                'fr' => 'Boissons',
                'ar' => 'المشروبات',
                'es' => 'Bebidas'
            ],
            'slug' => 'beverages',
            'is_active' => true,
        ]);

        // Create products
        Product::create([
            'category_id' => $appetizers->id,
            'name' => [
                'en' => 'Caesar Salad',
                'fr' => 'Salade César',
                'ar' => 'سلطة سيزر',
                'es' => 'Ensalada César'
            ],
            'description' => [
                'en' => 'Fresh romaine lettuce with parmesan cheese and croutons',
                'fr' => 'Laitue romaine fraîche avec fromage parmesan et croûtons',
                'ar' => 'خس روماني طازج مع جبن بارميزان وخبز محمص',
                'es' => 'Lechuga romana fresca con queso parmesano y picatostes'
            ],
            'price' => 8.99,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $mainCourses->id,
            'name' => [
                'en' => 'Grilled Chicken',
                'fr' => 'Poulet Grillé',
                'ar' => 'دجاج مشوي',
                'es' => 'Pollo a la Parrilla'
            ],
            'description' => [
                'en' => 'Tender grilled chicken breast with vegetables',
                'fr' => 'Poitrine de poulet grillée tendre avec légumes',
                'ar' => 'صدر دجاج مشوي طري مع خضروات',
                'es' => 'Pechuga de pollo tierna a la parrilla con verduras'
            ],
            'price' => 15.99,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $mainCourses->id,
            'name' => [
                'en' => 'Beef Burger',
                'fr' => 'Burger de Boeuf',
                'ar' => 'برجر لحم البقر',
                'es' => 'Hamburguesa de Res'
            ],
            'description' => [
                'en' => 'Juicy beef patty with cheese, lettuce, and tomato',
                'fr' => 'Steak de boeuf juteux avec fromage, laitue et tomate',
                'ar' => 'فطيرة لحم بقري طرية مع جبن وخس وطماطم',
                'es' => 'Jugosa hamburguesa de res con queso, lechuga y tomate'
            ],
            'price' => 12.99,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $desserts->id,
            'name' => [
                'en' => 'Chocolate Cake',
                'fr' => 'Gâteau au Chocolat',
                'ar' => 'كعكة الشوكولاتة',
                'es' => 'Pastel de Chocolate'
            ],
            'description' => [
                'en' => 'Rich chocolate cake with chocolate frosting',
                'fr' => 'Gâteau au chocolat riche avec glaçage au chocolat',
                'ar' => 'كعكة شوكولاتة غنية مع صقيع الشوكولاتة',
                'es' => 'Rico pastel de chocolate con glaseado de chocolate'
            ],
            'price' => 6.99,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $beverages->id,
            'name' => [
                'en' => 'Fresh Orange Juice',
                'fr' => 'Jus d\'Orange Frais',
                'ar' => 'عصير برتقال طازج',
                'es' => 'Jugo de Naranja Fresco'
            ],
            'description' => [
                'en' => 'Freshly squeezed orange juice',
                'fr' => 'Jus d\'orange fraîchement pressé',
                'ar' => 'عصير برتقال طازج معصور',
                'es' => 'Jugo de naranja recién exprimido'
            ],
            'price' => 4.99,
            'is_active' => true,
        ]);

        // Generate additional categories and products using factories
        \App\Models\Category::factory(5)->create()->each(function ($category) {
            \App\Models\Product::factory(rand(3, 8))->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
