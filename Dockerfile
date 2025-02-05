# Dockerfile
FROM node:18

# Create app directory
WORKDIR /usr/src/app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm cache clean --force && npm install

# Copy source code
COPY . .


# Expose the necessary port (if running a server, adjust accordingly)
EXPOSE 3000  # Replace with your app's port

# Start the application
CMD [ "npm", "start" ]
