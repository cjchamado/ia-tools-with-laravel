# Use Node 20 como base
FROM node:20

# Diretório de trabalho dentro do container
WORKDIR /app

# Copia todo o código do frontend
COPY . .

# Copia apenas os manifests primeiro (aproveita cache do Docker)
COPY package.json yarn.lock ./

# Instala dependências do projeto
RUN yarn install

# Expor porta do Quasar dev server
EXPOSE 9000

# Comando para rodar o dev server
CMD ["yarn", "dev"]
