<template>
  <div class="bg-[#2A2634] w-full">
    <div v-if="formType === 'new'" class="flex" :class="{ 'justify-end': !formOpen }">
      <button
        @click="formOpen = !formOpen"
        :class="{ 'hidden': !formOpen }"
        class="p-2 border border-violet-200 rounded-full text-violet-200 hover:bg-violet-200 hover:text-violet-900"
      >
        <PhX size="16" />
      </button>
      <button
        @click="formOpen = !formOpen"
        :class="{ 'hidden': formOpen }"
        class="py-3 px-4 bg-violet-500 hover:bg-violet-600 text-white rounded flex items-center gap-3"
      >
        <PhChatCircleText size="24" />
        New comment
      </button>
    </div>
    <button v-if="formType === 'reply' && canReply" class="btn-repply" @click="formOpen = !formOpen">
      <PhArrowBendDownRight class="mr-1" />
      Repply
    </button>
    <div v-if="formOpen" class="transition-all mt-3 bg-zinc-700 shadow-xl p-3 rounded">
      <input
        placeholder="Your name"
        type="text"
        class="input-field"
        v-model="comment.name"
      >
      <textarea
        class="mt-3 input-field"
        cols="30"
        rows="5"
        placeholder="Your comment"
        v-model="comment.body"
      ></textarea>
      <div class="flex justify-end mt-2 gap-3">
        <button class="btn-seccondary" @click="formOpen = !formOpen">
          <PhX size="24" />
          Cancel
        </button>
        <button class="btn-violet" @click="submitForm">
          <PhPaperPlaneTilt size="24" />
          {{ formType === 'new' ? 'Comment' : 'Reply' }}
        </button>
      </div>
    </div>
  </div>
</template>
<script setup>
  import { ref, defineProps, onMounted } from "vue";
  import { PhPaperPlaneTilt, PhChatCircleText, PhX, PhArrowBendDownRight } from "@phosphor-icons/vue";
  import axios from "axios";
  import { inject, computed } from "vue";

  const formOpen = ref(false);
  const comment = ref({
    name: "",
    body: "",
  });
  const props = defineProps({
    formType: {
      type: String,
      required: true,
    },
    parentId: {
      type: Number,
      default: null,
    },
    path: {
      type: String,
      default: null,
    },
  });
  const { newComment, updateNewComment } = inject('newComment')

  const canReply = computed(() => {
    if (props.path !== null && props.path.split(".").length >= 4) {
      return false;
    }
    return true;
  });

  onMounted(() => {
    comment.value.name = localStorage.getItem("name") || "";
  });
  function submitForm() {
    axios.post("/comments", {
      ...comment.value,
      parent_id: props.parentId,
    }).then(response => {
      updateNewComment();
      alert('Comment created successfully!');
    }).catch(e => {
      alert('Something went wrong, please try again later!')
    }).finally(() => {
      formOpen.value = false;
    })
  }
</script>
