<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import { Wrench } from 'lucide-vue-next';

// Animated dots
const dots = ref('');
let dotsInterval: ReturnType<typeof setInterval> | null = null;

onMounted(() => {
    dotsInterval = setInterval(() => {
        dots.value = dots.value.length >= 3 ? '' : dots.value + '.';
    }, 500);
});

onUnmounted(() => {
    if (dotsInterval) clearInterval(dotsInterval);
});
</script>


<template>
    <Head title="Yapım Aşamasında – Bulut İstihbarat">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    </Head>

    <div class="relative min-h-screen overflow-hidden flex items-center justify-center" style="background:#030b18; font-family:'Inter',sans-serif; color:#f1f5f9;">

        <!-- Radial glow -->
        <div class="pointer-events-none absolute inset-0" style="background:radial-gradient(ellipse 80% 50% at 50% 40%,rgba(59,130,246,0.15) 0%,transparent 70%);"></div>

        <!-- Grid overlay -->
        <div
            class="pointer-events-none absolute inset-0 opacity-20"
            style="background-image:linear-gradient(rgba(56,189,248,0.15) 1px,transparent 1px),linear-gradient(90deg,rgba(56,189,248,0.15) 1px,transparent 1px);background-size:50px 50px;"
        />

        <!-- Main card -->
        <div class="relative z-10 mx-4 w-full max-w-2xl text-center">

            <!-- Logo / Brand -->
            <div class="mb-10 flex items-center justify-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl" style="background:linear-gradient(145deg,#1a3461,#0d2d4a);box-shadow:0 0 0 1px rgba(99,179,237,0.22),inset 0 1px 0 rgba(255,255,255,0.07),0 4px 16px rgba(10,30,66,0.65);">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <circle cx="10.5" cy="10.5" r="6" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
                        <circle cx="10.5" cy="10.5" r="3.2" stroke="rgba(255,255,255,0.25)" stroke-width="1"/>
                        <line x1="5.8" y1="10.5" x2="8.3" y2="10.5" stroke="rgba(255,255,255,0.65)" stroke-width="1.1"/>
                        <line x1="12.7" y1="10.5" x2="15.2" y2="10.5" stroke="rgba(255,255,255,0.65)" stroke-width="1.1"/>
                        <line x1="10.5" y1="5.8" x2="10.5" y2="8.3" stroke="rgba(255,255,255,0.65)" stroke-width="1.1"/>
                        <line x1="10.5" y1="12.7" x2="10.5" y2="15.2" stroke="rgba(255,255,255,0.65)" stroke-width="1.1"/>
                        <circle cx="10.5" cy="10.5" r="1.4" fill="white"/>
                        <line x1="15.2" y1="15.2" x2="19.5" y2="19.5" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="text-left">
                    <p class="text-lg font-bold leading-none tracking-wide text-white">Bulut <span style="background:linear-gradient(90deg,#60a5fa,#38bdf8);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">İstihbarat</span></p>
                    <p class="text-xs text-slate-500 mt-0.5">Araç Tespit & Saha İstihbarat Hizmetleri</p>
                </div>
            </div>

            <!-- Badge -->
            <div class="mb-8 inline-flex items-center gap-2 rounded-full border px-4 py-2 text-sm" style="border-color:rgba(56,189,248,0.3);background:rgba(56,189,248,0.05);color:#38bdf8;">
                <div class="h-2 w-2 rounded-full animate-pulse" style="background:#38bdf8;"></div>
                Çok Yakında · %100 Yasal Süreç Uyumu
            </div>

            <!-- Construction icon -->
            <div class="mb-8 flex justify-center">
                <div class="relative">
                    <div class="absolute inset-0 rounded-full blur-2xl scale-150" style="background:rgba(251,191,36,0.15);"></div>
                    <div class="relative flex h-24 w-24 items-center justify-center rounded-full" style="background:linear-gradient(135deg,rgba(251,191,36,0.15),rgba(234,88,12,0.08));border:1px solid rgba(251,191,36,0.25);">
                        <Wrench class="h-10 w-10" style="color:#fbbf24;" />
                    </div>
                </div>
            </div>

            <!-- Title -->
            <h1 class="mb-4 text-4xl font-bold tracking-tight text-white sm:text-5xl">
                Yapım Aşamasında<span class="text-amber-400">{{ dots }}</span>
            </h1>

            <!-- Subtitle -->
            <p class="mb-10 text-lg leading-relaxed text-slate-400 max-w-lg mx-auto">
                Sitemiz şu anda yenileniyor. Çok yakında çok daha güçlü bir platform ile hizmetinizdeyiz.
            </p>

            <!-- Progress bar -->
            <div class="mb-10 rounded-2xl border p-6 text-left" style="border-color:rgba(56,189,248,0.15);background:rgba(255,255,255,0.03);">
                <div class="mb-3 flex items-center justify-between text-sm">
                    <span class="text-slate-400">Geliştirme süreci</span>
                    <span class="font-semibold" style="color:#38bdf8;">%67</span>
                </div>
                <div class="h-2 w-full overflow-hidden rounded-full" style="background:rgba(255,255,255,0.05);">
                    <div
                        class="h-full rounded-full transition-all duration-1000"
                        style="width:67%;background:linear-gradient(90deg,#3b82f6,#06b6d4);"
                    />
                </div>
            </div>

            

            <!-- Footer note -->
            <p class="mt-10 text-xs" style="color:rgba(100,116,139,0.7);">© 2026 Bulut İstihbarat · %100 Yasal Süreç Uyumu · KVKK Uyumlu</p>
        </div>

    </div>
</template>

