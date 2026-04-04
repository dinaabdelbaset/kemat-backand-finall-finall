FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_sqlite

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create a user with UID 1000 for Hugging Face compatibility
RUN useradd -m -u 1000 user

# Set working directory
WORKDIR /app

# Copy application files
COPY --chown=user:user . .

# Switch to the new user
USER user

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader

# Expose port required by Hugging Face
EXPOSE 7860

# Run entrypoint script
CMD ["bash", "start.sh"]
