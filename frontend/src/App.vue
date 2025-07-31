<script setup lang="ts">
import { HomeIcon, UserIcon } from "@heroicons/vue/24/outline";
import { onMounted, onUnmounted, ref } from "vue";

const canvas = ref<HTMLCanvasElement | null>(null);

// animation config
const possibleColors = ["#ff1919", "#00c922", "#fa0fb0", "#196eff"]; // RED, GREEN, PINK,BLUE
const boxWidth = 40;
const boxHeight = 80;
const speed = 1;

// animation state
const currentColors: string[] = [];
let initialPosition = 0;
let animationId: number;

// Initialize the animation: setup canvas size, get initial colors,
// setup event listeners, and start the animation
const updateCanvasSize = () => {
  if (!canvas.value) return;

  canvas.value.height = boxHeight;
  canvas.value.width = window.innerWidth;
};
onMounted(() => {
  const c = canvas.value;
  if (!c) return;

  updateCanvasSize();

  const numBoxes = Math.ceil(c.width / boxWidth);
  for (let i = 0; i < numBoxes; i++) {
    const color = possibleColors[i % possibleColors.length];
    currentColors.push(color);
  }
  window.addEventListener("resize", updateCanvasSize);
  animationId = requestAnimationFrame(animate);
});

// Cleanup
onUnmounted(() => {
  cancelAnimationFrame(animationId);
  document.removeEventListener("resize", updateCanvasSize);
});

const animate = (time: number, lastTime: number = time) => {
  // draw the current state
  const ctx = canvas.value?.getContext("2d");
  if (!ctx) return;

  for (let i = 0; i < currentColors.length; i++) {
    ctx.fillStyle = currentColors[i];
    ctx.fillRect(initialPosition + i * boxWidth, 0, boxWidth, boxHeight);
  }

  // calculate the next state
  initialPosition -= (time - lastTime) * speed;

  // cleanup dangling boxes (if any) on the left side
  let firstColorEnd = initialPosition + boxWidth;
  while (currentColors.length > 0 && firstColorEnd < 0) {
    currentColors.shift();
    initialPosition = firstColorEnd;
    firstColorEnd += boxWidth;
  }

  // add new boxes on the right side if needed
  const emptyWidth =
    (canvas.value?.width ?? 0) -
    (initialPosition + boxWidth * currentColors.length);
  const lastColorIndex = possibleColors.findIndex(
    (color) => color === currentColors[currentColors.length - 1]
  );
  const numBoxesRemaining = Math.ceil(emptyWidth / boxWidth);
  for (let i = 0; i < numBoxesRemaining; i++) {
    currentColors.push(
      possibleColors[(lastColorIndex + i + 1) % possibleColors.length]
    );
  }

  animationId = requestAnimationFrame((newTime) => animate(newTime, time));
};
</script>

<template>
  <header>
    <div class="px-8 flex justify-between items-end py-8">
      <h1 class="text-4xl text-fuchsia-600 font-serif">
        <span class="text-8xl -mr-4 text-fuchsia-200">W</span>
        <span>elcome to Headlines</span>
      </h1>
      <div class="flex space-x-2">
        <RouterLink
          to="/"
          class="text-fuchsia-200"
          active-class="text-pink-400"
        >
          <HomeIcon class="size-6" />
        </RouterLink>
        <RouterLink
          to="/about"
          class="text-fuchsia-200"
          active-class="text-pink-400"
        >
          <UserIcon class="size-6" />
        </RouterLink>
      </div>
    </div>
    <div class="grid w-full">
      <canvas class="col-start-1 row-start-1 w-full" ref="canvas"></canvas>
      <div
        class="w-full h-8 bg-white place-self-center col-start-1 row-start-1 relative"
      ></div>
    </div>
  </header>
  <main>
    <RouterView />
  </main>
</template>
