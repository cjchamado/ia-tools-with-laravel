import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
// import { api } from './axios'
// import { getAuthToken } from 'src/utils/resolve-token';

window.Pusher = Pusher

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  forceTLS: true,
  // encrypted: true,
  // channelAuthorization: {
  //   endpoint: `${api.defaults.baseURL}/broadcasting/auth`,
  //   headers: {
  //     Authorization: `Bearer ${getAuthToken()}`
  //   }
  // },
})
