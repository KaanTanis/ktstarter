<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            [
                'key' => 'maintenance_mode',
                'value' => json_encode(false),
                'data_type' => 'boolean',
            ],
            [
                'key' => 'maintenance_message',
                'value' => json_encode('Bakım çalışması, lütfen daha sonra tekrar deneyiniz.'),
                'data_type' => 'string',
            ],
            [
                'key' => 'cookie_consent',
                'value' => json_encode(str('<h1>ÇEREZ POLİTİKASI</h1>
                    <p><strong>Yürürlük Tarihi:</strong> 07.04.2025</p>
                    <p><strong>Web Sitesi:</strong> [site-adresi.com]</p>
                    <p><strong>Veri Sorumlusu:</strong> [Firma Adı]</p>

                    <h2>1. Çerez Nedir?</h2>
                    <p>Çerezler (cookies), ziyaret ettiğiniz web siteleri tarafından tarayıcınıza veya cihazınıza kaydedilen küçük metin dosyalarıdır. Bu dosyalar sayesinde site tercihlerinizi hatırlayabilir, kullanım deneyiminizi geliştirebilir ve analiz verileri elde edebiliriz.</p>

                    <h2>2. Hangi Tür Çerezleri Kullanıyoruz?</h2>
                    <ul>
                        <li><strong>Zorunlu Çerezler:</strong> Web sitemizin düzgün çalışması için gereklidir. Oturum yönetimi, güvenlik ve form işlemleri gibi temel işlevleri sağlar.</li>
                        <li><strong>İstatistik Çerezleri:</strong> Site trafiğini analiz etmek ve kullanıcıların nasıl etkileşimde bulunduğunu anlamak için kullanılır. Bu veriler anonimdir.</li>
                        <li><strong>Tercih Çerezleri:</strong> Kullanıcının dil seçimi gibi kişisel tercihlerini hatırlamamızı sağlar.</li>
                        <li><strong>Pazarlama Çerezleri:</strong> İzin vermeniz durumunda ilgi alanlarınıza uygun reklamlar sunmamıza yardımcı olur. Üçüncü taraf hizmet sağlayıcılar aracılığıyla çalışabilir.</li>
                    </ul>

                    <h2>3. Çerezleri Nasıl Kullanıyoruz?</h2>
                    <p>Çerezler sayesinde:</p>
                    <ul>
                        <li>Web sitesinin performansını artırıyor,</li>
                        <li>Kullanıcı deneyimini geliştiriyor,</li>
                        <li>İçerikleri kişiselleştiriyor,</li>
                        <li>Ziyaretçi analizleri gerçekleştiriyoruz.</li>
                    </ul>

                    <h2>4. Çerezleri Nasıl Kontrol Edebilirsiniz?</h2>
                    <p>Tarayıcı ayarlarınız üzerinden çerezlerin kullanımını kontrol edebilir veya tamamen engelleyebilirsiniz. Ancak bu durumda bazı site özellikleri düzgün çalışmayabilir.</p>
                    <p><strong>Tarayıcı ayarlarını kontrol etmek için:</strong></p>
                    <ul>
                        <li>Chrome</li>
                        <li>Firefox</li>
                        <li>Safari</li>
                        <li>Edge</li>
                    </ul>

                    <h2>5. Değişiklikler</h2>
                    <p>Bu Çerez Politikası, gerektiğinde güncellenebilir. Güncel sürüm her zaman <strong>[site-adresi.com]</strong> üzerinde yayınlanacaktır.</p>

                    <h2>6. İletişim</h2>
                    <p>Çerezler ve kişisel verilerle ilgili sorularınız için bizimle iletişime geçebilirsiniz:</p>
                    <p><strong>E-posta:</strong> [email@adres.com]</p>')->squish()->value()),
                'data_type' => 'string',
            ],
        ]);
    }
}
