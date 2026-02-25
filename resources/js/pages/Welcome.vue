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
    Cloud,
    Car,
    Activity,
    Target,
    BarChart3,
    Handshake,
    Building2,
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
                <a href="#" class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                        <Cloud class="h-5 w-5 text-white" />
                    </div>
                    <span class="text-lg font-bold text-white">Bulut <span style="background:linear-gradient(90deg,#3b82f6,#06b6d4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">İstihbarat</span></span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden items-center gap-8 md:flex">
                    <a href="#hakkimizda" class="text-sm text-slate-300 transition-colors hover:text-white">Hakkımızda</a>
                    <a href="#hizmetler" class="text-sm text-slate-300 transition-colors hover:text-white">Hizmetler</a>
                    <a href="#nasil-calisiyoruz" class="text-sm text-slate-300 transition-colors hover:text-white">Nasıl Çalışırız</a>
                    <a href="#referanslar" class="text-sm text-slate-300 transition-colors hover:text-white">Referanslar</a>
                    <a href="#iletisim" class="text-sm text-slate-300 transition-colors hover:text-white">İletişim</a>
                    <Link href="/plaka-sorgula" class="rounded-lg px-5 py-2.5 text-sm font-semibold text-white transition-all hover:opacity-90" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                        <Search class="mr-2 inline h-4 w-4" />Plaka Sorgula
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
                    <a href="#hakkimizda" @click="mobileMenuOpen=false" class="text-sm text-slate-300 py-2 hover:text-white">Hakkımızda</a>
                    <a href="#hizmetler" @click="mobileMenuOpen=false" class="text-sm text-slate-300 py-2 hover:text-white">Hizmetler</a>
                    <a href="#nasil-calisiyoruz" @click="mobileMenuOpen=false" class="text-sm text-slate-300 py-2 hover:text-white">Nasıl Çalışırız</a>
                    <a href="#referanslar" @click="mobileMenuOpen=false" class="text-sm text-slate-300 py-2 hover:text-white">Referanslar</a>
                    <a href="#iletisim" @click="mobileMenuOpen=false" class="text-sm text-slate-300 py-2 hover:text-white">İletişim</a>
                    <Link href="/plaka-sorgula" class="rounded-lg px-5 py-2.5 text-sm font-semibold text-white text-center mt-2" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                        Plaka Sorgula
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
                <!-- Badge -->
                <div class="mb-8 inline-flex items-center gap-2 rounded-full border px-4 py-2 text-sm" style="border-color:rgba(56,189,248,0.3);background:rgba(56,189,248,0.05);color:#38bdf8;">
                    <div class="h-2 w-2 rounded-full animate-pulse" style="background:#38bdf8;"></div>
                    %100 Yasal Süreç Uyumu · 7/24 Kesintisiz Operasyon
                </div>

                <!-- Headline -->
                <h1 class="mb-6 text-5xl font-black leading-tight tracking-tight md:text-7xl">
                    <span class="text-white">Profesyonel ve Güvenilir</span><br />
                    <span style="background:linear-gradient(135deg,#3b82f6 0%,#06b6d4 50%,#38bdf8 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Araç İstihbaratı</span>
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-slate-400 leading-relaxed">
                    Uzman saha ekibimiz, ulusal istihbarat ağımız ve hukuki uyumlu operasyon yönetimi ile
                    finans kuruluşlarına uçtan uca araç tespit ve yakalama hizmetleri sunuyoruz.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="#iletisim" class="group flex items-center gap-2 rounded-xl px-8 py-4 text-base font-semibold text-white shadow-lg transition-all hover:shadow-blue-500/25 hover:scale-105" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                        Teklif Alın
                        <ArrowRight class="h-5 w-5 transition-transform group-hover:translate-x-1" />
                    </a>
                    <Link href="/plaka-sorgula" class="flex items-center gap-2 rounded-xl border px-8 py-4 text-base font-semibold text-white transition-all hover:border-sky-400/50 hover:bg-white/5" style="border-color:rgba(255,255,255,0.15);">
                        <Search class="h-5 w-5" />
                        Plaka Sorgula
                    </Link>
                </div>

                <!-- Hero Stats -->
                <div class="mt-20 grid grid-cols-2 gap-6 md:grid-cols-4">
                    <div class="rounded-2xl border p-6 text-center" style="border-color:rgba(56,189,248,0.15);background:rgba(255,255,255,0.03);">
                        <div class="text-3xl font-black text-white">65K+</div>
                        <div class="mt-1 text-sm text-slate-400">Yakalanan Araç</div>
                    </div>
                    <div class="rounded-2xl border p-6 text-center" style="border-color:rgba(56,189,248,0.15);background:rgba(255,255,255,0.03);">
                        <div class="text-3xl font-black text-white">81</div>
                        <div class="mt-1 text-sm text-slate-400">İl Kapsama</div>
                    </div>
                    <div class="rounded-2xl border p-6 text-center" style="border-color:rgba(56,189,248,0.15);background:rgba(255,255,255,0.03);">
                        <div class="text-3xl font-black text-white">10+</div>
                        <div class="mt-1 text-sm text-slate-400">Yıl Deneyim</div>
                    </div>
                    <div class="rounded-2xl border p-6 text-center" style="border-color:rgba(56,189,248,0.15);background:rgba(255,255,255,0.03);">
                        <div class="text-3xl font-black text-white">7/24</div>
                        <div class="mt-1 text-sm text-slate-400">Kesintisiz Operasyon</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== HAKKIMIZDA ===== -->
        <section id="hakkimizda" class="py-28">
            <div class="mx-auto max-w-7xl px-6">
                <div class="grid items-center gap-16 lg:grid-cols-2">
                    <div>
                        <div class="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-medium" style="background:rgba(59,130,246,0.1);color:#60a5fa;border:1px solid rgba(59,130,246,0.2);">
                            Hakkımızda
                        </div>
                        <h2 class="mb-6 text-4xl font-black text-white leading-tight">
                            Türkiye'nin Öncü<br />
                            <span style="background:linear-gradient(90deg,#3b82f6,#06b6d4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">İstihbarat Firması</span>
                        </h2>
                        <p class="mb-6 text-slate-400 leading-relaxed text-lg">
                            Bulut İstihbarat, bankacılık ve finans sektörüne hacizli araç tespiti, yakalama operasyonları ve
                            saha istihbaratı hizmetleri sunan uzman bir operasyon şirketidir.
                        </p>
                        <p class="mb-8 text-slate-400 leading-relaxed">
                            Kendi bünyemizde istihdam ettiğimiz profesyonel ekibimiz, özgün teknolojik altyapımız ve
                            Türkiye genelini kapsayan istihbarat ağımızla hizmet veriyoruz. Tüm süreçler KVKK uyumlu
                            ve ISO 27001 standartlarında yürütülür.
                        </p>
                        <div class="grid grid-cols-2 gap-4">
                            <div v-for="item in ['Profesyonel Kadro','Özgün Teknoloji','81 İl Kapsama','KVKK Uyumlu']" :key="item"
                                class="flex items-center gap-3 rounded-xl border p-4" style="border-color:rgba(56,189,248,0.1);background:rgba(255,255,255,0.02);">
                                <CheckCircle class="h-5 w-5 shrink-0" style="color:#06b6d4;" />
                                <span class="text-sm text-slate-300">{{ item }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Visual Card -->
                    <div class="relative">
                        <div class="absolute -inset-4 rounded-3xl opacity-20 blur-2xl" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);"></div>
                        <div class="relative rounded-3xl border p-8" style="border-color:rgba(56,189,248,0.15);background:rgba(255,255,255,0.03);">
                            <div class="mb-6 flex items-center gap-4">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                                    <Cloud class="h-7 w-7 text-white" />
                                </div>
                                <div>
                                    <div class="text-lg font-bold text-white">Bulut İstihbarat</div>
                                    <div class="text-sm text-slate-400">Kurumsal İstihbarat Hizmetleri</div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div v-for="stat in [{l:'Toplam Yakalanan Araç',v:'65.000+',p:85},{l:'Müşteri Memnuniyeti',v:'%98',p:98},{l:'İl Kapsama',v:'81/81',p:100}]" :key="stat.l">
                                    <div class="mb-1.5 flex justify-between text-sm">
                                        <span class="text-slate-400">{{ stat.l }}</span>
                                        <span class="font-semibold text-white">{{ stat.v }}</span>
                                    </div>
                                    <div class="h-2 rounded-full overflow-hidden" style="background:rgba(255,255,255,0.05);">
                                        <div class="h-full rounded-full transition-all" :style="`width:${stat.p}%;background:linear-gradient(90deg,#3b82f6,#06b6d4);`"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 grid grid-cols-3 gap-4 rounded-2xl p-4 text-center" style="background:rgba(255,255,255,0.03);">
                                <div>
                                    <div class="text-2xl font-black text-white">10+</div>
                                    <div class="text-xs text-slate-400">Yıl Deneyim</div>
                                </div>
                                <div class="border-x" style="border-color:rgba(255,255,255,0.07);">
                                    <div class="text-2xl font-black text-white">45+</div>
                                    <div class="text-xs text-slate-400">Uzman Ekip</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-black text-white">30+</div>
                                    <div class="text-xs text-slate-400">İş Ortağı</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== HİZMETLER ===== -->
        <section id="hizmetler" class="py-28" style="background:rgba(255,255,255,0.01);">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mb-16 text-center">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-medium" style="background:rgba(59,130,246,0.1);color:#60a5fa;border:1px solid rgba(59,130,246,0.2);">
                        Hizmetlerimiz
                    </div>
                    <h2 class="mb-4 text-4xl font-black text-white">Uçtan Uca Çözümler</h2>
                    <p class="mx-auto max-w-2xl text-slate-400 text-lg">
                        Araç tespitinden yakalama ve teslime kadar tüm süreçleri tek çatı altında yönetiyoruz.
                    </p>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="service in services"
                        :key="service.title"
                        class="group rounded-2xl border p-6 transition-all duration-300 hover:border-sky-500/30 hover:-translate-y-1"
                        style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);"
                    >
                        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl" :style="`background:linear-gradient(135deg,${serviceGradients[service.color]});`">
                            <component :is="service.icon" class="h-6 w-6 text-white" />
                        </div>
                        <h3 class="mb-3 text-lg font-bold text-white">{{ service.title }}</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">{{ service.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== NEDEN BİZ ===== -->
        <section class="py-28">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mb-16 text-center">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-medium" style="background:rgba(59,130,246,0.1);color:#60a5fa;border:1px solid rgba(59,130,246,0.2);">
                        Neden Bulut İstihbarat?
                    </div>
                    <h2 class="mb-4 text-4xl font-black text-white">Farkımız</h2>
                    <p class="mx-auto max-w-2xl text-slate-400 text-lg">Rakiplerimizden bizi ayıran üç temel özellik</p>
                </div>

                <div class="grid gap-8 lg:grid-cols-3">
                    <div
                        v-for="(feat, i) in features"
                        :key="feat.title"
                        class="rounded-3xl border p-8"
                        :style="i===0?'border-color:rgba(59,130,246,0.3);background:rgba(59,130,246,0.05);':'border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);'"
                    >
                        <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                            <component :is="feat.icon" class="h-7 w-7 text-white" />
                        </div>
                        <h3 class="mb-4 text-xl font-bold text-white">{{ feat.title }}</h3>
                        <p class="mb-6 text-slate-400 leading-relaxed text-sm">{{ feat.desc }}</p>
                        <ul class="space-y-2.5">
                            <li v-for="item in feat.items" :key="item" class="flex items-center gap-2.5 text-sm">
                                <CheckCircle class="h-4 w-4 shrink-0" style="color:#06b6d4;" />
                                <span class="text-slate-300">{{ item }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== NASIL ÇALIŞIYORUZ ===== -->
        <section id="nasil-calisiyoruz" class="py-28" style="background:rgba(255,255,255,0.01);">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mb-16 text-center">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-medium" style="background:rgba(59,130,246,0.1);color:#60a5fa;border:1px solid rgba(59,130,246,0.2);">
                        Süreç
                    </div>
                    <h2 class="mb-4 text-4xl font-black text-white">Nasıl Çalışıyoruz?</h2>
                    <p class="mx-auto max-w-2xl text-slate-400 text-lg">6 adımda uçtan uca operasyon yönetimi</p>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="step in steps"
                        :key="step.num"
                        class="group relative rounded-2xl border p-6 transition-all duration-300 hover:border-sky-500/30"
                        style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);"
                    >
                        <div class="mb-4 text-6xl font-black opacity-10 transition-opacity group-hover:opacity-20" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                            {{ step.num }}
                        </div>
                        <h3 class="mb-2 text-lg font-bold text-white">{{ step.title }}</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">{{ step.desc }}</p>
                        <div class="absolute top-4 right-4 flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold" style="background:rgba(56,189,248,0.1);color:#38bdf8;border:1px solid rgba(56,189,248,0.2);">
                            {{ step.num }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== İSTATİSTİKLER ===== -->
        <section id="stats-section" class="py-24">
            <div class="mx-auto max-w-7xl px-6">
                <div class="rounded-3xl border p-12" style="border-color:rgba(56,189,248,0.15);background:linear-gradient(135deg,rgba(59,130,246,0.08),rgba(6,182,212,0.08));">
                    <div class="mb-10 text-center">
                        <h2 class="text-3xl font-black text-white">Rakamlarla Bulut İstihbarat</h2>
                    </div>
                    <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                        <div class="text-center">
                            <div class="text-5xl font-black text-white mb-2">{{ Math.floor(cVehicles).toLocaleString('tr-TR') }}+</div>
                            <div class="text-slate-400">Yakalanan Araç</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-black text-white mb-2">{{ Math.floor(cProvinces) }}</div>
                            <div class="text-slate-400">İl Kapsama</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-black text-white mb-2">{{ Math.floor(cExperience) }}+</div>
                            <div class="text-slate-400">Yıl Deneyim</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-black text-white mb-2">{{ Math.floor(cTeam) }}+</div>
                            <div class="text-slate-400">Uzman Personel</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== REFERANSLAR ===== -->
        <section id="referanslar" class="py-28" style="background:rgba(255,255,255,0.01);">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mb-16 text-center">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-medium" style="background:rgba(59,130,246,0.1);color:#60a5fa;border:1px solid rgba(59,130,246,0.2);">
                        Referanslar
                    </div>
                    <h2 class="mb-4 text-4xl font-black text-white">Türkiye'nin Önde Gelen</h2>
                    <p class="mx-auto max-w-xl text-slate-400 text-lg">Finans kuruluşları ve varlık yönetim şirketleri bizimle çalışıyor</p>
                </div>

                <div class="flex flex-wrap justify-center gap-4">
                    <div
                        v-for="ref in references"
                        :key="ref"
                        class="rounded-xl border px-6 py-3 text-sm font-medium text-slate-300 transition-all hover:border-sky-500/40 hover:text-white hover:bg-white/5"
                        style="border-color:rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);"
                    >
                        {{ ref }}
                    </div>
                </div>

                <div class="mt-12 rounded-2xl border p-8 text-center" style="border-color:rgba(56,189,248,0.1);background:rgba(255,255,255,0.02);">
                    <p class="text-slate-400 text-sm leading-relaxed max-w-2xl mx-auto">
                        <span class="text-white font-semibold">Referanslarımız en büyük güvencemizdir.</span>
                        Hizmet verdiğimiz kurumların yetkili kişilerini sizinle paylaşmaktan memnuniyet duyarız.
                        Kurumsal güven ilişkisi çerçevesinde detaylı referans bilgisi için bizimle iletişime geçin.
                    </p>
                </div>
            </div>
        </section>

        <!-- ===== PLAKA SORGULA CTA ===== -->
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
                        <h2 class="mb-4 text-4xl font-black text-white">Plaka Sorgulama</h2>
                        <p class="mb-8 text-slate-300 text-lg max-w-xl mx-auto">
                            Araç plakasını sorgulayın, araç bilgilerini anlık kontrol edin.
                            Sistemimizde kayıtlı araçlara ilişkin bilgilere erişin.
                        </p>
                        <Link href="/plaka-sorgula" class="inline-flex items-center gap-2 rounded-xl px-8 py-4 text-base font-bold text-white shadow-lg transition-all hover:scale-105" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                            <Search class="h-5 w-5" />
                            Plakayı Sorgula
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

                <div class="grid gap-12 lg:grid-cols-2">
                    <!-- Contact Info -->
                    <div class="space-y-6">
                        <div class="rounded-2xl border p-6 flex items-start gap-4" style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                                <Phone class="h-6 w-6" style="color:#60a5fa;" />
                            </div>
                            <div>
                                <div class="text-sm text-slate-400 mb-1">Telefon</div>
                                <div class="text-white font-semibold">0850 XXX XX XX</div>
                                <div class="text-slate-400 text-sm mt-0.5">Pzt–Cum 08:30–18:00</div>
                            </div>
                        </div>
                        <div class="rounded-2xl border p-6 flex items-start gap-4" style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                                <Mail class="h-6 w-6" style="color:#60a5fa;" />
                            </div>
                            <div>
                                <div class="text-sm text-slate-400 mb-1">E-posta</div>
                                <div class="text-white font-semibold">info@bulutistihbarat.com</div>
                                <div class="text-slate-400 text-sm mt-0.5">7/24 yanıt veriyoruz</div>
                            </div>
                        </div>
                        <div class="rounded-2xl border p-6 flex items-start gap-4" style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                                <MapPin class="h-6 w-6" style="color:#60a5fa;" />
                            </div>
                            <div>
                                <div class="text-sm text-slate-400 mb-1">Adres</div>
                                <div class="text-white font-semibold">İstanbul, Türkiye</div>
                                <div class="text-slate-400 text-sm mt-0.5">Türkiye genelinde operasyon</div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="rounded-3xl border p-8" style="border-color:rgba(56,189,248,0.15);background:rgba(255,255,255,0.02);">
                        <form class="space-y-5" @submit.prevent>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm text-slate-400">Ad Soyad</label>
                                    <input type="text" placeholder="Adınız Soyadınız" class="w-full rounded-xl border bg-transparent px-4 py-3 text-white text-sm outline-none transition-all focus:border-sky-500/50 placeholder:text-slate-600"
                                        style="border-color:rgba(255,255,255,0.1);" />
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm text-slate-400">Kurum</label>
                                    <input type="text" placeholder="Kurum adı" class="w-full rounded-xl border bg-transparent px-4 py-3 text-white text-sm outline-none transition-all focus:border-sky-500/50 placeholder:text-slate-600"
                                        style="border-color:rgba(255,255,255,0.1);" />
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-400">E-posta</label>
                                <input type="email" placeholder="ornek@kurum.com" class="w-full rounded-xl border bg-transparent px-4 py-3 text-white text-sm outline-none transition-all focus:border-sky-500/50 placeholder:text-slate-600"
                                    style="border-color:rgba(255,255,255,0.1);" />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-400">Telefon</label>
                                <input type="tel" placeholder="0 5XX XXX XX XX" class="w-full rounded-xl border bg-transparent px-4 py-3 text-white text-sm outline-none transition-all focus:border-sky-500/50 placeholder:text-slate-600"
                                    style="border-color:rgba(255,255,255,0.1);" />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-400">Mesajınız</label>
                                <textarea rows="4" placeholder="Hizmet talebiniz hakkında bilgi verin..." class="w-full resize-none rounded-xl border bg-transparent px-4 py-3 text-white text-sm outline-none transition-all focus:border-sky-500/50 placeholder:text-slate-600"
                                    style="border-color:rgba(255,255,255,0.1);"></textarea>
                            </div>
                            <button type="submit" class="w-full rounded-xl py-3.5 text-sm font-semibold text-white transition-all hover:opacity-90 hover:scale-[1.01]" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                                Mesaj Gönder
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== FOOTER ===== -->
        <footer class="border-t py-16" style="border-color:rgba(255,255,255,0.06);">
            <div class="mx-auto max-w-7xl px-6">
                <div class="grid gap-10 md:grid-cols-4 mb-12">
                    <!-- Brand -->
                    <div class="md:col-span-2">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                                <Cloud class="h-5 w-5 text-white" />
                            </div>
                            <span class="text-lg font-bold text-white">Bulut <span style="background:linear-gradient(90deg,#3b82f6,#06b6d4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">İstihbarat</span></span>
                        </div>
                        <p class="text-sm text-slate-400 leading-relaxed max-w-xs">
                            Uzman ekip ve geniş saha ağımızla hukuki uyumlu operasyon yönetimi.
                            Finans sektörüne özel 7/24 saha hizmeti.
                        </p>
                        <div class="mt-4 flex items-center gap-2 text-sm" style="color:#38bdf8;">
                            <div class="h-2 w-2 rounded-full animate-pulse" style="background:#38bdf8;"></div>
                            7/24 Aktif Operasyon
                        </div>
                    </div>
                    <!-- Links -->
                    <div>
                        <h4 class="mb-4 text-sm font-semibold text-white">Hızlı Linkler</h4>
                        <ul class="space-y-2.5">
                            <li v-for="link in [{l:'Hakkımızda',h:'#hakkimizda'},{l:'Hizmetler',h:'#hizmetler'},{l:'Nasıl Çalışırız',h:'#nasil-calisiyoruz'},{l:'Referanslar',h:'#referanslar'},{l:'İletişim',h:'#iletisim'}]" :key="link.l">
                                <a :href="link.h" class="text-sm text-slate-400 transition-colors hover:text-white">{{ link.l }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Hizmetler -->
                    <div>
                        <h4 class="mb-4 text-sm font-semibold text-white">Hizmetler</h4>
                        <ul class="space-y-2.5">
                            <li v-for="s in ['Araç Tespit','Saha İstihbaratı','Plaka Tanıma','Raporlama','Koordinasyon']" :key="s">
                                <a href="#hizmetler" class="text-sm text-slate-400 transition-colors hover:text-white">{{ s }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-between gap-4 border-t pt-8 sm:flex-row" style="border-color:rgba(255,255,255,0.06);">
                    <p class="text-sm text-slate-500">© 2026 Bulut İstihbarat. Tüm hakları saklıdır.</p>
                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <Shield class="h-4 w-4" style="color:#38bdf8;" />
                        %100 Yasal Süreç Uyumu · KVKK Uyumlu
                    </div>
                </div>
            </div>
        </footer>

    </div>
</template>
