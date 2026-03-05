<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import {
    Shield,
    Search,
    MapPin,
    FileText,
    Users,
    Cpu,
    Phone,
    Mail,
    CheckCircle,
    Lock,
    Zap,
    Award,
    ArrowRight,
    Menu,
    X,
    Car,
    Activity,
    Target,
    BarChart3,
    Handshake,
    Building2,
    Instagram,
} from 'lucide-vue-next';

// Navbar
const mobileMenuOpen = ref(false);
const scrolled = ref(false);

const handleScroll = () => {
    scrolled.value = window.scrollY > 50;
};

// Counter animation
const cVehicles = ref(0);
const cProvinces = ref(0);
const cExperience = ref(0);
const cTeam = ref(0);
const statsVisible = ref(false);

function animateCount(target: number, refVal: { value: number }, duration = 2000) {
    const step = target / (duration / 16);
    const interval = setInterval(() => {
        refVal.value = Math.min(refVal.value + step, target);
        if (refVal.value >= target) {
            refVal.value = target;
            clearInterval(interval);
        }
    }, 16);
}

function startCounters() {
    if (!statsVisible.value) {
        statsVisible.value = true;
        animateCount(65000, cVehicles);
        animateCount(81, cProvinces);
        animateCount(10, cExperience);
        animateCount(45, cTeam);
    }
}

let observer: IntersectionObserver | null = null;

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    const el = document.getElementById('stats-section');
    if (el) {
        observer = new IntersectionObserver(
            (entries) => {
                if (entries[0].isIntersecting) startCounters();
            },
            { threshold: 0.3 },
        );
        observer.observe(el);
    }
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    observer?.disconnect();
});

const services = [
    {
        icon: Car,
        title: 'Araç Tespit ve Yakalama',
        desc: 'Hacizli araç lokasyon tespiti, yasal süreç koordinasyonu ve yediemine güvenli teslim hizmetleri.',
        color: 'blue',
    },
    {
        icon: Search,
        title: 'Saha İstihbaratı',
        desc: 'Borçlu/araç lokasyonu, adres doğrulama, mal varlığı tespiti ve çevre araştırması.',
        color: 'violet',
    },
    {
        icon: Cpu,
        title: 'Plaka Tanıma ve Sorgulama',
        desc: 'Anlık plaka okuma ve ulusal veri tabanında sorgulama ile hızlı araç tespiti.',
        color: 'cyan',
    },
    {
        icon: FileText,
        title: 'Süreç Raporlama',
        desc: 'Anlık durum bildirimi, fotoğraflı dokümantasyon ve özelleştirilebilir kurumsal raporlar.',
        color: 'emerald',
    },
    {
        icon: Handshake,
        title: 'Süreç Koordinasyonu',
        desc: 'İcra müdürlüğü iletişimi, kolluk kuvvetleri koordinasyonu ve yediemin yönetimi.',
        color: 'orange',
    },
    {
        icon: MapPin,
        title: 'Ulusal Saha Ağı',
        desc: '81 ilde aktif operasyon ekibi ile Türkiye genelinde kesintisiz hizmet sunumu.',
        color: 'rose',
    },
];

const serviceGradients: Record<string, string> = {
    blue: '#2563eb,#3b82f6',
    violet: '#7c3aed,#8b5cf6',
    cyan: '#0891b2,#06b6d4',
    emerald: '#059669,#10b981',
    orange: '#ea580c,#f97316',
    rose: '#e11d48,#f43f5e',
};

const steps = [
    { num: '01', title: 'Dosya Paylaşımı', desc: 'İş ortaklarımızın paylaştığı araç ve borçlu verileri sisteme aktarılır.' },
    { num: '02', title: 'İstihbarat Analizi', desc: 'Saha araştırması, dijital soruşturma ve geniş istihbarat ağımız ile tespit yapılır.' },
    { num: '03', title: 'Koordinasyon', desc: 'İş ortakları, kolluk kuvvetleri ve adli birimlerle süreç yönetimi sağlanır.' },
    { num: '04', title: 'Yakalama', desc: 'Yasal süreç çerçevesinde araç teslim alınır ve tutanak tutulur.' },
    { num: '05', title: 'Teslim', desc: 'Araç yediemin otoparkına güvenli şekilde teslim edilir.' },
    { num: '06', title: 'Raporlama', desc: 'Tüm evrak ve fotoğraflı dokümantasyon kuruma iletilir.' },
];

const references = [
    'Garanti BBVA', 'Vakıfbank', 'Denizbank', 'Akbank',
    'QNB Finansbank', 'Yapı Kredi', 'TEB', 'İNG Bank',
    'Koç Finansman', 'Sümer Varlık', 'Emir Varlık', 'Yapı Kredi Leasing',
];

const features = [
    {
        icon: Cpu,
        title: 'Teknoloji Destekli Operasyon',
        desc: 'Coğrafi istihbarat araçları, gerçek zamanlı saha takibi ve özel yazılım altyapımız ile sektörün en gelişmiş operasyon sistemini kullanıyoruz.',
        items: ['Gelişmiş PTS sistemi', 'Gerçek zamanlı takip', 'Otomatik raporlama'],
    },
    {
        icon: Lock,
        title: 'Hukuki Uyum ve Güvenlik',
        desc: 'Tüm süreçler yalnızca kendi personelimizle yürütülür. KVKK uyumlu, ISO 27001 standartlarında veri güvenliği garantisi.',
        items: ['%100 KVKK uyumlu', 'ISO 27001 standardı', 'Veri güvenliği garantisi'],
    },
    {
        icon: Award,
        title: 'Memnuniyet Odaklı',
        desc: 'Kapasitemizi verimli yöneterek her müşterimize maksimum değer sunuyoruz. Misyonumuz dosya adedini artırmak değil, kaliteli hizmet vermektir.',
        items: ['Uzun vadeli iş birlikleri', 'Kişiselleştirilmiş hizmet', 'Şeffaf iletişim'],
    },
];
</script>

<template>
    <Head title="Bulut İstihbarat – Araç Yakalama ve İstihbarat Hizmetleri">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    </Head>

    <!-- Ana Wrapper -->
    <div class="min-h-screen" style="background:#030b18; font-family:'Inter',sans-serif; color:#f1f5f9;">

        <!-- ===== NAVBAR ===== -->
        <nav
            :class="['fixed top-0 left-0 right-0 z-50 transition-all duration-300', scrolled ? 'py-3' : 'py-5']"
            :style="scrolled ? 'background:rgba(3,11,24,0.95);backdrop-filter:blur(20px);border-bottom:1px solid rgba(56,189,248,0.1);' : 'background:transparent;'"
        >
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6">
                <!-- Logo -->
                <a href="#" class="flex items-center group">
                    <img src="/new_icon.png" alt="Bulut İstihbarat Logo" class="h-48 w-48 -my-16 shrink-0 object-contain transition-transform duration-200 hover:scale-110" />
                    <span class="text-2xl font-bold tracking-tight text-white">Bulut <span style="background:linear-gradient(90deg,#60a5fa,#38bdf8);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">İstihbarat</span></span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden items-center gap-8 md:flex">
                    <a href="#iletisim" class="text-sm text-slate-300 transition-colors hover:text-white">İletişim</a>
                    <Link href="/plaka-sorgula" class="rounded-lg px-5 py-2.5 text-sm font-semibold text-white transition-all hover:opacity-90" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                        <Search class="mr-2 inline h-4 w-4" />Araç Sorgula
                    </Link>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-slate-300 hover:text-white" @click="mobileMenuOpen = !mobileMenuOpen">
                    <X v-if="mobileMenuOpen" class="h-6 w-6" />
                    <Menu v-else class="h-6 w-6" />
                </button>
            </div>

            <!-- Mobile Menu -->
            <div v-if="mobileMenuOpen" class="md:hidden px-6 pb-4 pt-2 border-t mt-3" style="background:rgba(3,11,24,0.98);border-color:rgba(56,189,248,0.1);">
                <div class="flex flex-col gap-3">
                    <a href="#iletisim" @click="mobileMenuOpen=false" class="text-sm text-slate-300 py-2 hover:text-white">İletişim</a>
                    <Link href="/plaka-sorgula" class="rounded-lg px-5 py-2.5 text-sm font-semibold text-white text-center mt-2" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                        Araç Sorgula
                    </Link>
                </div>
            </div>
        </nav>

        <!-- ===== HERO ===== -->
        <section class="relative flex min-h-screen items-center overflow-hidden pt-20">
            <!-- Background grid pattern -->
            <div class="absolute inset-0 opacity-20" style="background-image:linear-gradient(rgba(56,189,248,0.15) 1px,transparent 1px),linear-gradient(90deg,rgba(56,189,248,0.15) 1px,transparent 1px);background-size:50px 50px;"></div>
            <!-- Radial glow -->
            <div class="absolute inset-0" style="background:radial-gradient(ellipse 80% 50% at 50% 40%,rgba(59,130,246,0.15) 0%,transparent 70%);"></div>
            <!-- Bottom fade -->
            <div class="absolute bottom-0 left-0 right-0 h-32" style="background:linear-gradient(transparent,#030b18);"></div>

            <div class="relative mx-auto max-w-7xl px-6 py-20 text-center">
                <!-- Headline -->
                <h1 class="mb-6 text-5xl font-black leading-tight tracking-tight md:text-7xl">
                    <span class="text-white">Profesyonel ve Güvenilir</span><br />
                    <span style="background:linear-gradient(135deg,#3b82f6 0%,#06b6d4 50%,#38bdf8 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Araç İstihbaratı</span>
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-slate-400 leading-relaxed">
                    Rehinli, hacizli, yakalamalı, çalıntı, şüpheli ve terk edilmiş araçların bildirilmesi şirketimizce ödüllendirilmektedir.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="#iletisim" class="group flex items-center gap-2 rounded-xl px-8 py-4 text-base font-semibold text-white shadow-lg transition-all hover:shadow-blue-500/25 hover:scale-105" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                        İletişim
                        <ArrowRight class="h-5 w-5 transition-transform group-hover:translate-x-1" />
                    </a>
                    <Link href="/plaka-sorgula" class="flex items-center gap-2 rounded-xl border px-8 py-4 text-base font-semibold text-white transition-all hover:border-sky-400/50 hover:bg-white/5" style="border-color:rgba(255,255,255,0.15);">
                        <Search class="h-5 w-5" />
                        Araç Sorgula
                    </Link>
                </div>


            </div>
        </section>


        <!-- ===== ARAÇ SORGULA CTA ===== -->
        <section class="py-20">
            <div class="mx-auto max-w-5xl px-6">
                <div class="relative overflow-hidden rounded-3xl p-12 text-center" style="background:linear-gradient(135deg,rgba(59,130,246,0.2),rgba(6,182,212,0.2));border:1px solid rgba(56,189,248,0.2);">
                    <div class="absolute inset-0 opacity-10" style="background-image:linear-gradient(rgba(56,189,248,0.3) 1px,transparent 1px),linear-gradient(90deg,rgba(56,189,248,0.3) 1px,transparent 1px);background-size:30px 30px;"></div>
                    <div class="relative">
                        <div class="mb-4 flex justify-center">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                                <Search class="h-8 w-8 text-white" />
                            </div>
                        </div>
                        <h2 class="mb-4 text-4xl font-black text-white">Araç Sorgula</h2>
                        <p class="mb-8 text-slate-300 text-lg max-w-xl mx-auto">
                            Araç plakasını sorgulayın, araç bilgilerini anlık kontrol edin.
                            Sistemimizde kayıtlı araçlara ilişkin bilgilere erişin.
                        </p>
                        <Link href="/plaka-sorgula" class="inline-flex items-center gap-2 rounded-xl px-8 py-4 text-base font-bold text-white shadow-lg transition-all hover:scale-105" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                            <Search class="h-5 w-5" />
                            Araç Sorgula
                            <ArrowRight class="h-5 w-5" />
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== İLETİŞİM ===== -->
        <section id="iletisim" class="py-28" style="background:rgba(255,255,255,0.01);">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mb-16 text-center">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-medium" style="background:rgba(59,130,246,0.1);color:#60a5fa;border:1px solid rgba(59,130,246,0.2);">
                        İletişim
                    </div>
                    <h2 class="mb-4 text-4xl font-black text-white">Birlikte Çalışalım</h2>
                    <p class="mx-auto max-w-xl text-slate-400 text-lg">Hizmetlerimiz hakkında detaylı bilgi almak için bizimle iletişime geçin</p>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-2xl border p-6 flex items-start gap-4" style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                            <Phone class="h-6 w-6" style="color:#60a5fa;" />
                        </div>
                        <div>
                            <div class="text-sm text-slate-400 mb-1">Telefon</div>
                            <a href="tel:02167400840" class="text-white font-semibold">0216 740 08 40</a>
                            <div class="text-slate-400 text-sm mt-0.5">Pzt–Cum 08:30–18:00</div>
                        </div>
                    </div>
                    <div class="rounded-2xl border p-6 flex items-start gap-4" style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                            <Mail class="h-6 w-6" style="color:#60a5fa;" />
                        </div>
                        <div>
                            <div class="text-sm text-slate-400 mb-1">E-posta</div>
                            <a href="mailto:info@bulutistihbarat.com" class="text-white font-semibold hover:text-sky-400 transition-colors">info@bulutistihbarat.com</a>
                            <div class="text-slate-400 text-sm mt-0.5">7/24 yanıt veriyoruz</div>
                        </div>
                    </div>
                    <div class="rounded-2xl border p-6 flex items-start gap-4" style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                            <MapPin class="h-6 w-6" style="color:#60a5fa;" />
                        </div>
                        <div>
                            <div class="text-sm text-slate-400 mb-1">Adres</div>
                            <div class="text-white font-semibold text-sm leading-snug">Çavuş Mah. Çayırlar Cad. No:129/3 D:6 Şile/İstanbul</div>
                        </div>
                    </div>
                    <div class="rounded-2xl border p-6 flex items-start gap-4" style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                            <Instagram class="h-6 w-6" style="color:#60a5fa;" />
                        </div>
                        <div>
                            <div class="text-sm text-slate-400 mb-1">Instagram</div>
                            <a href="https://www.instagram.com/bulutistihbarat" target="_blank" rel="noopener noreferrer" class="text-white font-semibold hover:text-sky-400 transition-colors">@bulutistihbarat</a>
                            <div class="text-slate-400 text-sm mt-0.5">7/24 yanıt veriyoruz</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



    </div>
</template>
