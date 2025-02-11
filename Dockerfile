# Dockerfile using Node.js base image
FROM node:18-alpine

# Set working directory
WORKDIR /usr/src/app

# Debug: Print working directory contents before copy
RUN pwd && ls -la

# Copy package.json first
COPY package.json ./

# Debug: Print contents after copy
RUN ls -la

# Install dependencies
RUN npm install

# Copy the rest of the application
COPY . .

# Debug: Print final contents
RUN ls -la

EXPOSE 8181

CMD [ "npm", "start" ]
