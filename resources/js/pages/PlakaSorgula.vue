<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Search, Shield, AlertCircle, CheckCircle2, Info, RotateCcw, Phone, Mail, MapPin, Instagram } from 'lucide-vue-next';

const plateInput = ref('');
const loading = ref(false);
const searched = ref(false);
const foundPlates = ref<string[]>([]);
const error = ref('');

const scrolled = ref(false);
const handleScroll = () => { scrolled.value = window.scrollY > 50; };
onMounted(() => window.addEventListener('scroll', handleScroll));
onUnmounted(() => window.removeEventListener('scroll', handleScroll));

const plateRegex = /^(\d{2})([A-Z]{1,3})(\d{2,4}|\d{1,3}[A-Z]{1,2})$/;

function formatPlate(value: string): string {
    return value.replace(/\s/g, '').toUpperCase();
}

function validatePlate(value: string): boolean {
    return plateRegex.test(value);
}

// Textarea'dan plaka listesini parse et (satır, virgül veya boşlukla ayrılmış)
const parsedPlates = computed<string[]>(() => {
    return plateInput.value
        .split(/[\n,;\s]+/)
        .map(formatPlate)
        .filter(p => p.length > 0);
});

const invalidPlates = computed<string[]>(() => {
    return parsedPlates.value.filter(p => !validatePlate(p));
});

const validPlates = computed<string[]>(() => {
    return parsedPlates.value.filter(p => validatePlate(p));
});

async function handleSearch() {
    error.value = '';

    if (parsedPlates.value.length === 0) {
        error.value = 'Lütfen en az bir plaka numarası girin.';
        return;
    }

    if (invalidPlates.value.length > 0) {
        error.value = `Geçersiz plaka formatı: ${invalidPlates.value.join(', ')}`;
        return;
    }

    loading.value = true;
    searched.value = false;
    foundPlates.value = [];

    try {
        const response = await fetch('https://cobweb.acarhukuk.com/api/plate/search-bulk', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ plates: validPlates.value }),
        });

        if (response.status === 429) {
            throw new Error('Çok fazla sorgulama yaptınız. Lütfen 30 dakika sonra tekrar deneyin.');
        }
        if (response.status === 404) {
            throw new Error('Sorgu servisi şu an kullanılamıyor. Lütfen daha sonra tekrar deneyin.');
        }
        if (response.status === 500) {
            throw new Error('Sunucuda bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
        }
        if (!response.ok) {
            throw new Error('Sorgu gerçekleştirilemedi. Lütfen tekrar deneyin.');
        }

        // Beklenen yanıt: { "found": ["34ABC123", ...] }
        const data = await response.json() as { found: string[] };
        foundPlates.value = data.found ?? [];
    } catch (e: any) {
        console.error('API fetch error:', e);
        error.value = e?.message || 'Bağlantı hatası. İnternet bağlantınızı kontrol edin.';
        foundPlates.value = [];
    } finally {
        loading.value = false;
        searched.value = true;
    }
}

function reset() {
    plateInput.value = '';
    searched.value = false;
    foundPlates.value = [];
    error.value = '';
    loading.value = false;
}

function onInput() {
    if (error.value) error.value = '';
}


</script>

<template>
    <Head title="Araç Sorgula – Bulut İstihbarat">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    </Head>

    <div class="min-h-screen" style="background:#030b18; font-family:'Inter',sans-serif;">

        <!-- Navbar -->
        <nav
            :class="['fixed top-0 left-0 right-0 z-50 transition-all duration-300', scrolled ? 'py-3' : 'py-5']"
            :style="scrolled ? 'background:rgba(3,11,24,0.95);backdrop-filter:blur(20px);border-bottom:1px solid rgba(56,189,248,0.1);' : 'background:transparent;'"
        >
            <div class="mx-auto flex max-w-7xl items-center justify-center md:justify-start px-6">
                <Link href="/" class="flex items-center">
                    <img src="/new_icon.png" alt="Bulut İstihbarat Logo" class="h-32 w-32 -my-8 md:h-48 md:w-48 md:-my-12 shrink-0 object-contain transition-transform duration-200 hover:scale-110" />
                </Link>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="mx-auto max-w-2xl px-6 py-16 pt-28">

            <!-- Header -->
            <div class="mb-12 text-center">
                <div class="mb-6 flex justify-center">
                    <div class="relative">
                        <div class="absolute -inset-3 rounded-3xl opacity-30 blur-xl" style="background:linear-gradient(135deg,#1e3a8a,#0c4a6e);"></div>
                        <div class="relative flex h-24 w-24 items-center justify-center rounded-3xl" style="background:linear-gradient(145deg,#1a3461,#0d2d4a);box-shadow:0 0 0 1px rgba(99,179,237,0.25),inset 0 1px 0 rgba(255,255,255,0.08),0 8px 32px rgba(10,30,66,0.7);">
                            <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none">
                                <circle cx="10.5" cy="10.5" r="6" stroke="rgba(255,255,255,0.65)" stroke-width="1.5"/>
                                <circle cx="10.5" cy="10.5" r="3.2" stroke="rgba(255,255,255,0.28)" stroke-width="1"/>
                                <line x1="5.8" y1="10.5" x2="8.3" y2="10.5" stroke="rgba(255,255,255,0.7)" stroke-width="1.1"/>
                                <line x1="12.7" y1="10.5" x2="15.2" y2="10.5" stroke="rgba(255,255,255,0.7)" stroke-width="1.1"/>
                                <line x1="10.5" y1="5.8" x2="10.5" y2="8.3" stroke="rgba(255,255,255,0.7)" stroke-width="1.1"/>
                                <line x1="10.5" y1="12.7" x2="10.5" y2="15.2" stroke="rgba(255,255,255,0.7)" stroke-width="1.1"/>
                                <circle cx="10.5" cy="10.5" r="1.5" fill="white"/>
                                <line x1="15.2" y1="15.2" x2="19.5" y2="19.5" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <h1 class="mb-3 text-4xl font-black text-white">Araç Sorgulama</h1>
                <p class="text-slate-400 text-lg leading-relaxed">
                    Araç plaka numarasını girerek sistemimizde kayıtlı bilgilere ulaşın.
                </p>
                <div class="mt-4 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm" style="background:rgba(56,189,248,0.08);color:#38bdf8;border:1px solid rgba(56,189,248,0.2);">
                    <Shield class="h-3.5 w-3.5" />
                    Güvenli ve Yasal Sorgulama
                </div>
            </div>

            <!-- Search Form -->
            <div class="rounded-3xl border p-8" style="border-color:rgba(56,189,248,0.15);background:rgba(255,255,255,0.02);">
                <form @submit.prevent="handleSearch">
                    <!-- Plate Input -->
                    <div class="mb-2">
                        <label class="mb-3 block text-sm font-medium text-slate-300">
                            Plaka Numaraları
                            <span v-if="parsedPlates.length > 0" class="ml-2 rounded-full px-2 py-0.5 text-xs font-normal" style="background:rgba(56,189,248,0.12);color:#38bdf8;">
                                {{ parsedPlates.length }} plaka
                            </span>
                        </label>
                        <textarea
                            v-model="plateInput"
                            rows="6"
                            placeholder="Her satıra bir plaka girin veya yapıştırın:&#10;34ABC123&#10;06A1234&#10;35BC456"
                            class="w-full rounded-2xl border bg-transparent px-4 py-4 text-base font-semibold tracking-wider text-white outline-none transition-all resize-none placeholder:text-slate-600 placeholder:font-normal placeholder:tracking-normal"
                            :style="`border-color:${error ? 'rgba(239,68,68,0.5)' : 'rgba(56,189,248,0.25)'};`"
                            @input="onInput"
                            :disabled="loading"
                        />
                        <!-- Parsed plate tags preview -->
                        <div v-if="parsedPlates.length > 0 && !searched" class="mt-2 flex flex-wrap gap-1.5">
                            <span
                                v-for="p in parsedPlates"
                                :key="p"
                                class="rounded-lg px-2 py-0.5 text-xs font-bold tracking-wider"
                                :style="validatePlate(p)
                                    ? 'background:rgba(56,189,248,0.1);color:#38bdf8;border:1px solid rgba(56,189,248,0.25);'
                                    : 'background:rgba(239,68,68,0.1);color:#ef4444;border:1px solid rgba(239,68,68,0.3);'"
                            >
                                {{ p }}
                            </span>
                        </div>
                        <!-- Error message -->
                        <div v-if="error" class="mt-2 flex items-center gap-2 text-sm text-red-400">
                            <AlertCircle class="h-4 w-4 shrink-0" />
                            {{ error }}
                        </div>
                        <!-- Format hint -->
                        <div v-else class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                            <Info class="h-3.5 w-3.5" />
                            Her satıra veya virgülle ayrılmış olarak girebilirsiniz. Örn: 34ABC123, 06A1234
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        :disabled="loading || parsedPlates.length === 0"
                        class="mt-6 flex w-full items-center justify-center gap-2 rounded-2xl py-4 text-base font-semibold text-white transition-all"
                        :style="loading || parsedPlates.length === 0 ? 'background:rgba(59,130,246,0.3);cursor:not-allowed;' : 'background:linear-gradient(135deg,#3b82f6,#06b6d4);'"
                    >
                        <template v-if="loading">
                            <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            Sorgulanıyor...
                        </template>
                        <template v-else>
                            <Search class="h-5 w-5" />
                            {{ validPlates.length > 1 ? `${validPlates.length} Aracı Sorgula` : 'Araç Sorgula' }}
                        </template>
                    </button>
                </form>

                <!-- RESULTS -->
                <Transition name="fade-slide">
                    <div v-if="searched" class="mt-8">
                        <div class="border-t pt-8" style="border-color:rgba(255,255,255,0.06);">

                            <!-- NONE FOUND -->
                            <div v-if="foundPlates.length === 0" class="text-center">
                                <div class="mb-4 flex justify-center">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);">
                                        <AlertCircle class="h-8 w-8" style="color:#ef4444;" />
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-white">Araç Bulunamadı</h3>
                                <p class="mt-2 text-slate-400 text-sm leading-relaxed">
                                    Sorgulanan plakalardan hiçbiri sistemimizde bulunamadı.
                                </p>
                                <div class="mt-4 rounded-xl border p-4 text-left text-sm" style="border-color:rgba(239,68,68,0.1);background:rgba(239,68,68,0.04);">
                                    <div class="flex items-start gap-2">
                                        <Info class="h-4 w-4 mt-0.5 shrink-0" style="color:#ef4444;" />
                                        <p class="text-slate-400">
                                            Sonuç yalnızca Bulut İstihbarat sistemindeki kayıtlara göre verilmiştir.
                                            Resmi kayıtlar için ilgili kurumlara başvurunuz.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- FOUND PLATES -->
                            <div v-else>
                                <div class="mb-5 flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl" style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);">
                                        <CheckCircle2 class="h-5 w-5" style="color:#22c55e;" />
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-white">{{ foundPlates.length }} Araç Bulundu</h3>
                                        <p class="text-xs text-slate-400">Aşağıdaki plakalar sistemimizde kayıtlıdır</p>
                                    </div>
                                </div>

                                <div class="space-y-2 mb-5">
                                    <div
                                        v-for="plate in foundPlates"
                                        :key="plate"
                                        class="flex items-center justify-between rounded-xl border px-4 py-3"
                                        style="border-color:rgba(34,197,94,0.2);background:rgba(34,197,94,0.06);"
                                    >
                                        <span class="text-lg font-black tracking-widest" style="color:#22c55e;">{{ plate }}</span>
                                        <span class="text-xs font-medium text-slate-400">Listede mevcut</span>
                                    </div>
                                </div>

                                <p class="text-slate-400 text-sm text-center mb-4">
                                    Bizimle iletişime geçin ve <span class="text-yellow-400 font-semibold">ödül kazanın!</span>
                                </p>

                                <div class="grid gap-3 sm:grid-cols-2 text-left">
                                    <a href="tel:02167400840" class="rounded-2xl border p-4 flex items-center gap-3 transition-all hover:border-sky-500/40 hover:bg-white/5" style="border-color:rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                                            <Phone class="h-5 w-5" style="color:#60a5fa;" />
                                        </div>
                                        <div>
                                            <div class="text-xs text-slate-400">Telefon</div>
                                            <div class="text-white font-semibold text-sm">0216 740 08 40</div>
                                            <div class="text-slate-400 text-xs mt-0.5">Pzt–Cum 08:30–18:00</div>
                                        </div>
                                    </a>
                                    <a href="mailto:info@bulutistihbarat.com" class="rounded-2xl border p-4 flex items-center gap-3 transition-all hover:border-sky-500/40 hover:bg-white/5" style="border-color:rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                                            <Mail class="h-5 w-5" style="color:#60a5fa;" />
                                        </div>
                                        <div>
                                            <div class="text-xs text-slate-400">E-posta</div>
                                            <div class="text-white font-semibold text-sm">info@bulutistihbarat.com</div>
                                            <div class="text-slate-400 text-xs mt-0.5">7/24 yanıt veriyoruz</div>
                                        </div>
                                    </a>
                                    <div class="rounded-2xl border p-4 flex items-center gap-3" style="border-color:rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                                            <MapPin class="h-5 w-5" style="color:#60a5fa;" />
                                        </div>
                                        <div>
                                            <div class="text-xs text-slate-400">Adres</div>
                                            <div class="text-white font-semibold text-sm leading-snug">Çavuş Mah. Çayırlar Cad. No:129/3 D:6 Şile/İstanbul</div>
                                        </div>
                                    </div>
                                    <a href="https://www.instagram.com/bulutistihbarat" target="_blank" rel="noopener noreferrer" class="rounded-2xl border p-4 flex items-center gap-3 transition-all hover:border-sky-500/40 hover:bg-white/5" style="border-color:rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl" style="background:rgba(59,130,246,0.15);">
                                            <Instagram class="h-5 w-5" style="color:#60a5fa;" />
                                        </div>
                                        <div>
                                            <div class="text-xs text-slate-400">Instagram</div>
                                            <div class="text-white font-semibold text-sm">@bulutistihbarat</div>
                                            <div class="text-slate-400 text-xs mt-0.5">7/24 yanıt veriyoruz</div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- New Search Button -->
                            <button
                                @click="reset"
                                class="mt-6 flex w-full items-center justify-center gap-2 rounded-2xl border py-3 text-sm font-medium text-slate-300 transition-all hover:text-white hover:border-slate-400"
                                style="border-color:rgba(255,255,255,0.1);"
                            >
                                <RotateCcw class="h-4 w-4" />
                                Yeni Sorgulama Yap
                            </button>
                        </div>
                    </div>
                </Transition>
            </div>

        </div>

        <!-- Footer -->
        <div class="border-t py-8 text-center" style="border-color:rgba(255,255,255,0.06);">
            <p class="text-sm text-slate-600">© 2026 Bulut İstihbarat - Tüm Hakları Saklıdır</p>
        </div>
    </div>
</template>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
    transition: all 0.4s ease;
}
.fade-slide-enter-from,
.fade-slide-leave-to {
    opacity: 0;
    transform: translateY(10px);
}
</style>
