# syntax=docker/dockerfile:1

# Stage 1: Build Stage
FROM node:22.13.1-slim AS builder

# Set working directory
WORKDIR /app

# Install dependencies
COPY --link package.json package-lock.json ./
RUN --mount=type=cache,target=/root/.npm npm ci

# Copy application files
COPY --link . .

# Build the application
RUN npm run build

# Stage 2: Production Stage
FROM node:22.13.1-slim AS production

# Set working directory
WORKDIR /app

# Copy built application and dependencies from builder stage
COPY --from=builder /app/dist ./dist
COPY --from=builder /app/node_modules ./node_modules
COPY --from=builder /app/package*.json ./

# Set environment variables
ENV NODE_ENV=production

# Use a non-root user for security
RUN useradd -m appuser
USER appuser

# Expose application port
EXPOSE 3000

# Start the application
CMD ["node", "dist/index.js"]