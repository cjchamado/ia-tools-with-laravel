import { api } from "src/boot/axios"

export const getMessages = (chatId, params = {}) => {
  return api.get(`/chats/${chatId}/messages`, { params }).then(({ data }) => data)
}

export const storeMessage = (chatId, params = {}) => {
  return api.post(`/chats/${chatId}/messages`, params).then(({ data }) => data)
}
