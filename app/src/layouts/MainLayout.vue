<template>
  <q-layout view="lHh Lpr lFf">
    <q-header class="bg-transparent">
      <q-toolbar>
        <q-btn flat dense round icon="menu" aria-label="Menu" @click="toggleLeftDrawer" />
        <q-toolbar-title> Chat.it </q-toolbar-title>
        <div>Chat.it v{{ $q.version }}</div>
      </q-toolbar>
    </q-header>

    <q-footer
      class="bg-transparent"
      v-if="$route.name === 'chat_continue'"
    >
      <div class="q-pa-md justify-center items-center row">
        <div class="col-12 col-md-6">
          <q-card flat class="bg-transparent">
            <q-card-section>
              <ChatInput />
            </q-card-section>
          </q-card>
        </div>
      </div>
    </q-footer>

    <q-drawer v-model="leftDrawerOpen" show-if-above bordered>
      <q-list>
        <q-item
          clickable
          :to="{ name: 'chat_start' }"
        >
          <q-item-section side>
            <q-icon name="mark_chat_unread" />
          </q-item-section>
          <q-item-section>
            <q-item-label>
              Novo chat
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
      <ChatList />
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue'
import ChatInput from 'src/components/ChatInput.vue'
import ChatList from 'src/components/ChatList.vue'

export default defineComponent({
  name: 'MainLayout',

  components: {
    ChatInput,
    ChatList,
  },

  setup() {
    const leftDrawerOpen = ref(false)

    onMounted(() => {
      // window.Echo.channel('chats.1')
      //     .listen('.message.created', (data) => {
      //       console.log(data)
      //     })
      // window.Echo.channel('chats')
      //     .listen('.ChatCreated', (data) => {
      //       console.log(data)
      //     })
    })

    return {
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value
      },
    }
  },
})
</script>
