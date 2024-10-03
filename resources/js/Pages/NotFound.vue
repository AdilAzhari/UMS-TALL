<template>
    <div class="not-found-container">
        <div class="logo">
            <img
                src="../../../public/images/logo Nova Horizon University (NHU).webp"
                alt="Nova Horizon University (NHU)"
                class="logo"
            />
        </div>
        <div class="content">
            <h1>404 - Page Not Found</h1>
            <p>The page you are looking for doesn't exist or has been moved.</p>
            <router-link to="/" class="home-button">Go to Homepage</router-link>
            <div class="links">
                <a href="#" @click.prevent="goBack">Go Back</a>
                <router-link to="/contact">Contact Support</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "NotFound",
    methods: {
        goBack() {
            this.$router.go(-1);
        },
    },
};

</script>

<style scoped>
.logo {
  height: 50px; /* Adjust the height as needed */
  width: auto; /* This will maintain the aspect ratio */
}
.not-found-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-color: #f5f5f5;
    font-family: Arial, sans-serif;
}

.logo img {
    max-width: 200px;
    margin-bottom: 2rem;
}

.content {
    background-color: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 400px;
    width: 100%;
}

h1 {
    color: #4a2c8f;
    font-size: 2rem;
    margin-bottom: 1rem;
}

p {
    color: #666;
    margin-bottom: 2rem;
}

.home-button {
    display: inline-block;
    background-color: #ffc0cb;
    color: #4a2c8f;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    margin-bottom: 1rem;
    transition: background-color 0.3s;
}

.home-button:hover {
    background-color: #ffb0c0;
}

.links {
    margin-top: 1rem;
}

.links a {
    color: #4a2c8f;
    text-decoration: none;
    margin: 0 0.5rem;
}

.links a:hover {
    text-decoration: underline;
}
</style>
