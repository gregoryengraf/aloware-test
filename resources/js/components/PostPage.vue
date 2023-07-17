<template>
  <div class="max-w-[900px]">
    <div class="rounded-lg overflow-hidden w-full max-h-[350px] mb-10 shadow-md">
      <img src="https://cdn2.unrealengine.com/fortnite-velocity-edge-pickaxe-1900x600-62094fd204d1.jpg" alt="" />
    </div>
    <h1 class="text-white font-bold text-3xl mb-2">GRAB THE VELOCITY EDGE PICKAXE IN FORTNITE BY LOGGING IN THROUGH AMAZON LUNA!</h1>
    <p class="text-zinc-400 text-sm mb-12">By The Fortnite Team</p>
    <p class="text-zinc-300 text-justify">
      Turn the tide of battle at home or on the go! With the Amazon Luna cloud gaming service, jump into Fortnite on Windows PC, macOS, iOS, iPadOS, Android phones, Chromebook, Chrome browser, Microsoft Edge, Fire tablets, Fire TVs, or select Samsung Smart TVs in supported regions. Amazon Prime members can play Fortnite through Luna at no additional cost. Not an Amazon Prime member? Amazon Luna+ subscribers can play Fortnite through Luna as well.
      Get ready to swing into action: all players who log into Fortnite through Amazon Luna anytime from July 3 at 12 PM ET to July 17, 2023, at 11:59 PM ET will receive the Velocity Edge Pickaxe within seven days after July 19, 2023 ET.
    </p>
    <br>
    <p class="text-zinc-300 text-justify">
      All Amazon Luna players can play Fortnite with touch controls on mobile. Players who prefer a different control input can use a keyboard-and-mouse on Windows PC, macOS, and Chromebook, or use a Bluetooth controller (including the Luna Controller) on any Luna-supported device. For more info, including how to link your Epic account to your Luna subscription, see our Amazon Luna FAQ!
    </p>
    <AllComments :comments="comments" />
  </div>
</template>
<script setup>
  import { ref, onMounted, provide, watchEffect } from "vue";
  import AllComments from "./comments/All.vue";

  const newComment = ref(false);

  function updateNewComment() {
    newComment.value = true;
  }

  provide('newComment', {
    newComment,
    updateNewComment
  });

  watchEffect(async () => {
    if (newComment.value) {
      getAllComments();
      newComment.value = false;
    }
  });

  function getAllComments() {
    axios.get("/comments")
    .then(response => {
      comments.value = response.data;
    })
    .catch(e => {
      console.log(e);
    });
  }

  const comments = ref([]);

  onMounted(() => {
    getAllComments();
  });
</script>
