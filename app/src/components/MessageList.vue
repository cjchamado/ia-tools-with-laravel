<template>
  <div
    id="scroll-target-id"
    style="max-height: 80vh; overflow: auto;"
    class="scroll"
  >
    <q-infinite-scroll
      reverse
      @load="fetchMessages"
      :offset="250"
      scroll-target="#scroll-target-id"
      ref="scrollRef"
      :class="`chat-messages-${$route.params.id}`"
      class="q-px-lg"
    >
      <q-list class="q-px-lg">
        <q-item
          v-for="(message, index) in messages"
          :key="index"
          clickable
          class="item-message"
          :class="`item-message-${message.id}`"
        >
          <q-item-section>
            <q-chat-message
              :text="[message.id, message.content]"
              :sent="message.role === 'user'"
              size="6"
            > 
              <template v-slot:avatar>
                <q-avatar icon="person" v-if="message.role === 'user'" />
                <q-avatar icon="smart_toy" v-else />
              </template>
            </q-chat-message>
          </q-item-section>
        </q-item>
      </q-list>
      <template v-slot:loading>
        <div class="row justify-center q-my-md">
          <q-spinner-dots color="primary" size="40px" />
        </div>
      </template>
    </q-infinite-scroll>
  </div>
</template>

<script>
import { getMessages } from 'src/api/messages'
import { onMounted } from 'vue'
import { defineComponent, ref } from 'vue'
import { useRoute } from 'vue-router'

import { scroll, Notify } from 'quasar'
const { getScrollTarget, setVerticalScrollPosition } = scroll

export default defineComponent({
  name: 'MessageList',
  setup() {
    const route = useRoute()
    const messages = ref([])
    const scrollRef = ref(null)

    const scrollToBottom = () => {
      const el = document.querySelector(`.chat-messages-${route.params.id}`)
      const target = getScrollTarget(el)
      const offset = target.scrollHeight
      const duration = 1000
      setVerticalScrollPosition(target, offset, duration)
    }

    const fetchMessages = (page, done) => {
      getMessages(route.params.id, { page }).then((data) => {
        messages.value.unshift(
          ...data.data.reverse()
        )
        if (!data.next_page_url) {
          scrollRef.value.stop()
        }
        done()
        setTimeout(() => {
          scrollToBottom()
        }, 800)
      }).catch((e) => {
        scrollRef.value.stop()
        let message = 'Falha ao processar solicitação'
        switch (e?.response?.status) {
          case 404:
            message = 'Chat não encontrado'
            break
        }
        Notify.create({
          type: 'negative',
          position: 'top',
          message,
        })
      })
    }

    onMounted(() => {
      const channelId = `chats.${route.params.id}`
      window.Echo.channel(channelId)
          .listen('.MessageCreated', (data) => {
            const message = data?.model ?? data
            messages.value.push(message)
            scrollToBottom()
          })
    })

    return {
      messages,
      scrollRef,
      fetchMessages,
    }
  }
})
</script>
