<template>
  <div id="scroll-target-id" style="max-height: 80vh; overflow: auto;">
    <q-infinite-scroll
      @load="fetchChats"
      :offset="250"
      scroll-target="#scroll-target-id"
      ref="scrollRef"
    >
      <q-list separator>
        <q-item
          v-for="(chat, index) in chats"
          :key="index"
          clickable
          :to="{
            name: 'chat_continue',
            params: {
              id: chat.id
            }
          }"
        >
          <q-item-section>
            <q-item-label>
              {{ chat.title }}
            </q-item-label>
          </q-item-section>
          <q-item-section side @click.prevent>
            <q-btn
              round
              icon="close"
              @click="doDelete(chat, index)"
            />
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
import { deleteChat, getChats } from 'src/api/chats'
import { defineComponent, ref, onMounted } from 'vue'
import { Dialog } from 'quasar'
import { useRoute, useRouter } from 'vue-router'

export default defineComponent({
  name: 'ChatList',
  setup() {
    const chats = ref([])
    const scrollRef = ref(null)
    const route = useRoute()
    const router = useRouter()

    const fetchChats = (page, done) => {
      getChats({ page }).then((data) => {
        chats.value.push(...data.data)
        if (!data.next_page_url) {
          scrollRef.value.stop()
        }
        done()
      })
    }

    const doDelete = (chat, index) => {
      Dialog.create({
        message: 'Deseja excluir este chat?'
      }).onOk(() => {
        deleteChat(chat.id).then(() => {
          chats.value.splice(index, 1)
          if (route.params.id === chat.id) {
            router.push({
              name: 'chat_start',
            })
          }
        })
      })
    }

    onMounted(() => {
      window.Echo.channel('chats')
          .listen('.ChatCreated', (data) => {
            const chat = data?.model ?? data
            if (chat?.id) {
              chats.value.unshift(chat)
            }
          })
    })

    return {
      chats,
      scrollRef,
      fetchChats,
      doDelete,
    }
  }
})
</script>
