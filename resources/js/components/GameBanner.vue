<template>
  <router-link to="post-page" class="
    relative
    rounded-lg
    overflow-hidden
    transition-shadow
    duration-300
    ease-linear
    transform
    hover:scale-110
    hover:shadow-lg
    hover:shadow-indigo-500/50
  ">
    <img :src="cardImage" alt="" />
    <div class="w-full pt-16 pb-4 px-4 bg-game-gradient absolute bottom-0 left-0 right-0">
      <strong class="font-bold text-white block">{{ title }}</strong>
    </div>
  </router-link>
</template>
<script setup>
import { ref, watchEffect } from 'vue'

const props = defineProps({
  imagePath: { type: String },
  title: { type: String },
  bannerUrl: { type: String },
  adsCount: { type: Number },
})

const cardImage = ref()
watchEffect(async () => {
  cardImage.value = (await import(/* @vite-ignore */`../../images/${props.bannerUrl}`)).default
})
</script>
