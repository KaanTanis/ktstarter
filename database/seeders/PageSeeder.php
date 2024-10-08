<?php

namespace Database\Seeders;

use App\Models\Page;
use Database\Seeders\Traits\UploadFile;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    use UploadFile;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedHome();
    }

    public function seedHome()
    {
        Page::create([
            'type' => 'home',
            'data' => [
                'hero' => [
                    'title' => 'Designer',
                    'title_2' => 'Developer',
                    'image' => $this->uploadFilePublicPath('assets/img/designer.jpg'),
                    'image_2' => $this->uploadFilePublicPath('assets/img/developer.jpg'),
                    'github_user_name' => 'KaanTanis',
                    'whatsapp_no' => '+90 (544) 237 3323',
                    'email' => 'kt@kaantanis.com',
                ],
                'about' => [
                    'title' => 'Minimalizmde Şıklık, Yaratıcılıkta Güç!',
                    'content' => str('<p>
                        Modern yazılım teknolojileriyle şık ve minimal web yazılımları geliştiriyorum. <strong>Her projeye farklı bir dokunuş</strong> katmayı seviyorum.
                    </p>
                    <p>
                        Her projeye özenle yaklaşıp, kullanıcı odaklı ve estetik web tasarımları sunuyorum. Minimalizmin zarafetini, teknolojinin gücüyle birleştirerek <strong>eşsiz dijital deneyimler</strong> oluşturuyorum.
                    </p>')->squish()->value(),
                    'images' => [
                        $this->uploadFilePublicPath('assets/img/m3.jpg'),
                        $this->uploadFilePublicPath('assets/img/m2.png'),
                        $this->uploadFilePublicPath('assets/img/m1.jpg'),
                    ],
                ],
                'how_it_works' => [
                    'steps' => [
                        [
                            'title' => 'Keşif & Strateji Geliştirme',
                            'content' => 'İlk toplantıda hedefleriniz ve istekleriniz doğrultusunda detaylı bir analiz yapılır. Rakip analizi, pazar araştırması ve hedef kitlenin belirlenmesi bu aşamada tamamlanır. Projenin kapsamı ve stratejik yol haritası çıkarılır.',
                            'image' => $this->uploadFilePublicPath('assets/img/1.jpg'),
                        ],
                        [
                            'title' => 'Taslak & Prototip Oluşturma',
                            'content' => 'Proje için bir taslak veya wireframe hazırlanır ve sizinle paylaşılır. Bu aşamada görsel tasarım unsurları üzerinde geri bildirimler alınarak iterasyonlar yapılır. Nihai prototip onaylanmadan önce gerekli düzenlemeler yapılır.',
                            'image' => $this->uploadFilePublicPath('assets/img/2.jpg'),
                        ],
                        [
                            'title' => 'Geliştirme & Lansman',
                            'content' => 'Onaylanan prototip üzerinden proje geliştirilir. Teknik gereksinimler ve işlevsellikler tamamlanır. Test aşaması gerçekleştirilir ve proje teslim edilir. Teslim sonrası destek ve bakım seçenekleri sunulur.',
                            'image' => $this->uploadFilePublicPath('assets/img/3.jpg'),
                        ],
                    ],
                ],
            ],
        ]);

        Page::create([
            'type' => 'about',
            'data' => [
                'hero' => [
                    'title' => 'Merhaba, Ben Kaan Tanış',
                    'titles' => [
                        ['title' => 'WEB DEVELOPER'],
                        ['title' => 'UI/UX DESIGNER'],
                        ['title' => 'SEO SPECIALIST'],
                        ['title' => 'BUG HUNTER'],
                        ['title' => 'OPEN SOURCE CONTRIBUTOR'],
                        ['title' => 'LIFELONG LEARNER'],
                    ],
                ],
                'content' => str('<h2>Hakkımda</h2><p>lorem ipsum</p>')->squish()->value(),
                'technologies' => [
                    'title' => 'Kullandığım Teknolojiler',
                    'technologies' => [
                        [
                            'title' => 'Laravel',
                            'logo' => $this->uploadFilePublicPath('assets/img/laravel.png'),
                        ],
                        [
                            'title' => 'Vue.js',
                            'logo' => $this->uploadFilePublicPath('assets/img/vue.png'),
                        ],
                        [
                            'title' => 'Tailwind CSS',
                            'logo' => $this->uploadFilePublicPath('assets/img/tailwind.png'),
                        ],
                        [
                            'title' => 'Livewire',
                            'logo' => $this->uploadFilePublicPath('assets/img/livewire.png'),
                        ],
                        [
                            'title' => 'Alpine.js',
                            'logo' => $this->uploadFilePublicPath('assets/img/alpine.png'),
                        ],
                        [
                            'title' => 'Inertia.js',
                            'logo' => $this->uploadFilePublicPath('assets/img/inertia.png'),
                        ],
                    ],
                ],
            ],
        ]);

        Page::create([
            'type' => 'blogs',
            'data' => [
                //
            ],
        ]);

        Page::create([
            'type' => 'works',
            'data' => [
                //
            ],
        ]);
    }
}
