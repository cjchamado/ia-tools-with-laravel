<template>
  <q-page>
    <MessageList
      :key="$route.fullPath"
    />
  </q-page>
</template>

<script>
import MessageList from 'src/components/MessageList.vue';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'ChatPage',
  components: {
    MessageList,
  },
  setup() {
    return {}
  }
})
</script>
