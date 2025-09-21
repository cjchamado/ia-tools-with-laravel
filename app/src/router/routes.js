const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        name: 'chat_start',
        component: () => import('pages/IndexPage.vue')
      },
      {
        path: 'chat/:id',
        name: 'chat_continue',
        component: () => import('pages/ChatPage.vue')
      }
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
]

export default routes
