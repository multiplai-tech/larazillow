# Vue 3 + Inertia.js + Laravel 8 + Tailwind (VILT Stack)

*Disclaimer: This open-source project has been shared by the instructor at Fado Code Camp exclusively for demonstration purposes, and is not intended for production use.*

<br>

> *Note: Upon completion of the course, the intention is to further develop this project.*


## Features
- 🔥 Composition API
- 📋 The `<script setup>` syntax.
- 📦 Service Pattern
- 🐋 Docker compose
- 🧮 Adminer for database management
- 📧 Mailhog for email testing

### Installation

1. Clone the repository

```bash
  git clone https://github.com/multiplai-tech/larazillow.git
  cd larazillow
```

2. Install the dependencies

```bash
  npm install
  composer install
```

3. Copy the example env file and make the required configuration changes in the .env file

```bash
  cp .env.example .env
```

4. Build the images and start the services:

```bash
  ./vendor/bin/sail build
  ./vendor/bin/sail up -d
```

5. Start the development server. *Note: Execute this on different terminal*

```bash
  npm run dev
  php artisan serve
```

