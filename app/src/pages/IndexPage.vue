<template>
  <q-page class="flex flex-center">
    <div class="row full-width justify-center">
      <div class="col-12 col-md-8 col-lg-6 q-gutter-md">
        <div class="text-h6 text-center">
          Vamos começar
        </div>
        <ChatInput />
      </div>
    </div>
  </q-page>
</template>

<script>
import ChatInput from 'src/components/ChatInput.vue';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'IndexPage',
  components: {
    ChatInput,
  }
})
</script>
