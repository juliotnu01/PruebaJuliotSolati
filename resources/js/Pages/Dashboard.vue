<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { onMounted, ref } from 'vue';

const Post = ref([]);
const getPosts = async () => {
    try {
        let { data } = await axios(route('list.all.posts'))
        Post.value = data
    } catch (error) {
        console.log({ error })
    }
}
onMounted(() => {
    getPosts()
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12 px-10">
            <div
                class="grid  gap-3 lg:grid-cols-4 md:grid-cols-3 md:justify-center sm:grid-cols-1 sm:justify-center max-[512px]:grid-cols-1 min-[512px]:grid-cols-1 ">
                <div class='rounded-3xl' v-for="(post, p) in Post" :key="p">
                    <div class="grid rounded-3xl max-w-sm shadow-sm bg-white  flex-col">
                        <div :style=" `background-image: url('${post.url_img}');` "
                                    class=" justify-center grid h-20 w-20 bg-cover bg-no-repeat bg-center mx-auto" />
                        <div class="group p-6 grid z-10">
                            <a href="#" class="group-hover:text-cyan-700 font-bold sm:text-2xl line-clamp-2">
                                 {{ post.title }}
                            </a>
                            <div class="h-26">
                                <span class="line-clamp-3 py-1 text-base font-light leading-relaxed">
                                    {{ post.description }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
