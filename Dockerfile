# Dockerfile
FROM node:18

# Create app directory
WORKDIR /usr/src/app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy source code
COPY . .

# Expose port 8181
EXPOSE 8181

# Start the application
CMD [ "npm", "start" ]
