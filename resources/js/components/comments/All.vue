<template>
  <div class="pt-1 bg-nlw-gradient self-stretch rounded-lg mt-8 overflow-hidden shadow-xl">
    <div class="bg-[#2A2634] px-8 py-6">
      <div class="flex items-center space-x-2 text-base">
        <h4 class="text-2xl text-white font-black block">Comments</h4>
      </div>
      <span class="text-zinc-400 block" v-if="!hasComments">
        We don't have any comments yet, be the first to comment!
      </span>
    </div>
    <NewComment class="px-8 py-6" form-type="new" />
    <Comment
      v-for="(comment, index) in comments"
      :key="index"
      :comment="comment"
      :replies="comment.children"
    />
  </div>
</template>

<script setup>
import { defineProps, computed } from "vue";
import Comment from "./Single.vue";
import NewComment from "./NewComment.vue";
const props = defineProps({
  comments: {
    type: Array,
    required: true,
  },
});
const hasComments = computed(() => {
  return props.comments.length > 0;
});
</script>
