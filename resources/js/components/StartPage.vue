<template>
  <div>
    <h1 class="text-5xl text-white font-black text-center">
      The <span class="text-transparent bg-nlw-gradient bg-clip-text">BEST</span> content about games and more!
    </h1>
    <p class="text-3xl text-white font-thin mt-6 text-center">Select one game to show your summary and comments</p>
    <div class="grid grid-cols-6 gap-6 mt-20">
      <GameBanner
        v-for="(game, index) in games"
        :key="index"
        :title="game.title"
        :banner-url="game.bannerUrl"
        :ads-count="game.adsCount"
      />
    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue';
  import GameBanner from './GameBanner.vue';

  const games = ref([
    {
      title: 'League of Legends',
      bannerUrl: 'game-1.png'
    },
    {
      title: 'Valorant',
      bannerUrl: 'game-2.png'
    },
    {
      title: 'CS:GO',
      bannerUrl: 'game-3.png'
    },
    {
      title: 'Dota 2',
      bannerUrl: 'game-4.png'
    },
    {
      title: 'Free Fire',
      bannerUrl: 'game-5.png'
    },
    {
      title: 'Fortnite',
      bannerUrl: 'game-6.png'
    },
  ]);
</script>
