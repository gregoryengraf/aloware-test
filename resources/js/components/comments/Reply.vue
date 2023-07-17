<template>
  <div class="ml-10 pr-3 py-3 flex gap-2">
    <div class="w-[80px] h-[80px] overflow-hidden rounded-lg border-solid	border-zinc-400/20 border-4">
      <img
        class="w-full h-full object-cover"
        src="@/images/default_avatar.png"
        :alt="`Avatar of ${comment.name}`"
      />
    </div>
    <div class="w-full">
      <p class="text-lg text-white font-black block">{{ comment.name }}</p>
      <p class="text-xs text-zinc-500 mb-2">{{ commentedAt }}</p>
      <p class="text-zinc-200 block">{{ comment.body }}</p>
      <div class="mt-2 flex items-center gap-4">
        <NewComment form-type="reply" :parent-id="comment.id" :path="comment.path" class="pr-8" />
      </div>
    </div>
  </div>
  <div v-if="replies.length" class="pl-10 block">
    <Reply
      v-for="(reply, index) in replies"
      :key="index"
      :comment="reply"
      :replies="reply.children"
    />
  </div>
</template>
<script>
import { PhArrowBendDownRight, PhArrowBendDoubleUpRight } from '@phosphor-icons/vue';
import { formatDistance } from 'date-fns'
import NewComment from './NewComment.vue'
export default {
  name: 'Reply',
  props: {
    comment: {
      type: Object,
      required: true,
    },
    replies: {
      type: Array,
      default: () => [],
    },
  },
  components: {
    NewComment,
    PhArrowBendDownRight,
    PhArrowBendDoubleUpRight,
  },
  data() {
    return {
      commentedAt: formatDistance(new Date(this.comment.created_at), new Date(), { addSuffix: true }),
    }
  },
}
</script>
