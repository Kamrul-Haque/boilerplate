<script setup>
const props = defineProps({
    thumbnail: {
        type: String,
        required: true
    }
})
</script>

<template>
    <div class="book-container">
        <div class="book-cover">
            <img :src="thumbnail"
                 alt="Book Thumbnail"
                 class="thumbnail">
        </div>
        <div class="book-bottom"></div>
    </div>
</template>

<style scoped>
.book-container {
    position: relative;
    width: 100px;
    height: 150px;
    background-color: #222222;
    border-radius: 5px;
}

.book-container::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 5px;
    bottom: -2px;
    left: 0;
    background-color: #222222;
    border-bottom-left-radius: 5px;
}

.book-cover {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 20px;
    left: 7px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-right: 2px solid #222222;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    overflow: hidden;
}

.thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.book-bottom {
    position: absolute;
    width: calc(100% - 2px);
    height: 20px;
    bottom: 0;
    left: 2px;
    background-color: beige;
    border-radius: 5px 0 0 5px;
}
</style>
