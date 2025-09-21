import { api } from "src/boot/axios"

export const getChats = (params = {}) => {
  return api.get('/chats', { params }).then(({ data }) => data)
}

export const storeChat = (params = {}) => {
  return api.post('/chats', params).then(({ data }) => data)
}

export const deleteChat = (id) => {
  return api.delete(`/chats/${id}`).then(({ data }) => data)
}
