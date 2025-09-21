<template>
  <q-input
    rounded
    outlined
    autogrow
    v-model="text"
    @keydown.enter.exact.prevent="doSubmit()"
    @keydown.enter.shift.exact.prevent="breakLine()"
  >
    <template v-slot:prepend>
      <q-icon name="chat" />
    </template>
    <template v-slot:append>
      <q-btn
        flat
        round
        icon="send"
        @click="doSubmit"
      />
    </template>
  </q-input>
</template>

<script>
import { storeChat } from 'src/api/chats'
import { storeMessage } from 'src/api/messages'
import { ref } from 'vue'
import { defineComponent } from 'vue'
import { useRoute, useRouter } from 'vue-router'

export default defineComponent({
  name: 'ChatInput',
  setup() {
    const route = useRoute()
    const router = useRouter()
    const thinking = ref(false)
    const text = ref('')

    const doSubmit = () => {
      if (thinking.value) {
        console.log('thinking...')
        return
      }

      const params = {
        title: text.value,
        content: text.value,
      }

      text.value = ''

      if (!route.params.id) {
          storeChat(params).then((data) => {
            router.push({
              name: 'chat_continue',
              params: {
                id: data.id
              }
            })
          }).finally(() => {
            thinking.value = false
          })
          return
      }

      thinking.value = true
      storeMessage(route.params.id, params).then(() => {
        // console.log(data)
      }).finally(() => {
        thinking.value = false
      })
    }

    const breakLine = () => text.value += '\n'

    return {
      text,
      doSubmit,
      breakLine,
    }
  }
})
</script>
