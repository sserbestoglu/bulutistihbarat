<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import { Shield, Wrench, Clock, Mail, Phone } from 'lucide-vue-next';

// Animated dots
const dots = ref('');
let dotsInterval: ReturnType<typeof setInterval> | null = null;

// Floating particles
const particles = Array.from({ length: 18 }, (_, i) => ({
    id: i,
    size: Math.random() * 4 + 2,
    x: Math.random() * 100,
    y: Math.random() * 100,
    delay: Math.random() * 6,
    duration: Math.random() * 8 + 6,
}));

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
    <Head title="Yapım Aşamasında – Bulut İstihbarat" />

    <div class="relative min-h-screen overflow-hidden bg-[#020817] flex items-center justify-center">

        <!-- Ambient glow background -->
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute left-1/2 top-1/4 h-[600px] w-[600px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-sky-500/10 blur-[120px]" />
            <div class="absolute right-1/4 bottom-1/4 h-[400px] w-[400px] rounded-full bg-violet-500/8 blur-[100px]" />
        </div>

        <!-- Floating particles -->
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div
                v-for="p in particles"
                :key="p.id"
                class="absolute rounded-full bg-sky-400/20 animate-float"
                :style="{
                    width: p.size + 'px',
                    height: p.size + 'px',
                    left: p.x + '%',
                    top: p.y + '%',
                    animationDelay: p.delay + 's',
                    animationDuration: p.duration + 's',
                }"
            />
        </div>

        <!-- Grid overlay -->
        <div
            class="pointer-events-none absolute inset-0 opacity-[0.03]"
            style="background-image: linear-gradient(rgba(148,163,184,1) 1px, transparent 1px), linear-gradient(90deg, rgba(148,163,184,1) 1px, transparent 1px); background-size: 60px 60px;"
        />

        <!-- Main card -->
        <div class="relative z-10 mx-4 w-full max-w-2xl text-center">

            <!-- Logo / Brand -->
            <div class="mb-10 flex items-center justify-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-500/10 ring-1 ring-sky-500/30">
                    <Shield class="h-6 w-6 text-sky-400" />
                </div>
                <div class="text-left">
                    <p class="text-lg font-bold leading-none text-white tracking-wide">Bulut İstihbarat</p>
                    <p class="text-xs text-slate-500 mt-0.5">Araç Tespit & Saha İstihbarat Hizmetleri</p>
                </div>
            </div>

            <!-- Construction icon -->
            <div class="mb-8 flex justify-center">
                <div class="relative">
                    <div class="absolute inset-0 rounded-full bg-amber-500/20 blur-2xl scale-150" />
                    <div class="relative flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-amber-500/20 to-orange-500/10 ring-1 ring-amber-500/30">
                        <Wrench class="h-10 w-10 text-amber-400" />
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
            <div class="mb-10">
                <div class="mb-2 flex items-center justify-between text-sm">
                    <span class="text-slate-500">Geliştirme süreci</span>
                    <span class="font-semibold text-sky-400">%67</span>
                </div>
                <div class="h-2 w-full overflow-hidden rounded-full bg-slate-800">
                    <div
                        class="h-full rounded-full bg-gradient-to-r from-sky-500 to-violet-500 transition-all duration-1000"
                        style="width: 67%;"
                    />
                </div>
            </div>

            

            <!-- Footer note -->
            <p class="mt-10 text-xs text-slate-600">
                © 2026 Bulut İstihbarat · %100 Yasal Süreç Uyumu · KVKK Uyumlu
            </p>
        </div>

    </div>
</template>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px) scale(1); opacity: 0.2; }
    50%       { transform: translateY(-20px) scale(1.2); opacity: 0.5; }
}
.animate-float {
    animation: float ease-in-out infinite;
}
</style>
