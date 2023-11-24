<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'

// variables
const model = ref({
    title: '',
    description: '',
    status: true
});
const imgPost = ref(null);
const UrlImageTmp = ref('');

//metodos
const changeImgPost = () => {
    UrlImageTmp.value = URL.createObjectURL(imgPost.value.files[0])
}

const storePost = async  () => {
    try {
        let formData = new FormData();
        formData.append('title', model.value.title);
        formData.append('description', model.value.description);
        formData.append('status', model.value.status);
        formData.append('imgPost', imgPost.value.files[0]);
        await axios.post(route('store.post'), formData, {headers: { 'Content-Type': 'multipart/form-data' } })
        router.get(route('posts'))
    } catch (e) {
        console.log({ e })
    }
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear Post
            </h2>
        </template>
        <div class="py-12 px-10">
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-1 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600">

                        <div class='rounded-3xl'>
                            <div class="grid rounded-3xl max-w-sm shadow-sm bg-white  flex-col">
                                <img :src="UrlImageTmp" class=" object-cover ">
                                <div class="group p-6 grid z-10">
                                    <a href="#" class="group-hover:text-cyan-700 font-bold sm:text-2xl line-clamp-2">
                                        {{ model.title }}
                                    </a>
                                    <div class="h-26">
                                        <span class="line-clamp-3 py-1 text-base font-light leading-relaxed">
                                            {{ model.description }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                            <div class="md:col-span-5">
                                <label for="title">Titulo</label>
                                <input type="text" name="title" id="title" v-model="model.title"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" />
                            </div>

                            <div class="md:col-span-5">
                                <label for="description">Descripcion</label>
                                <textarea name="description" id="description" rows="8" cols="40" v-model="model.description"
                                    class="h-40 border mt-1 rounded px-4 w-full bg-gray-50">
                                </textarea>
                            </div>

                            <div class="md:col-span-5">
                                <label for="img">Imagen</label>
                                <input accept="image/*" type="file" name="img" id="img" ref="imgPost"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" @change="changeImgPost" />
                            </div>

                            <div>
                                <div
                                    class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="toggle" id="toggle" v-model="model.status"
                                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                                    <label for="toggle"
                                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                                <label for="toggle" class="text-xs text-gray-700">{{ model.status.toString() == 'true' ?
                                    'Visible' : 'No visible' }}</label>
                            </div>

                            <div class="md:col-span-5 text-right">
                                <div class="inline-flex items-end">
                                    <button
                                        @click.prevent="storePost()"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style scoped  >
.toggle-checkbox:checked {
    @apply: right-0 border-green-400;
    right: 0;
    border-color: #68D391;
}

.toggle-checkbox:checked+.toggle-label {
    @apply: bg-green-400;
    background-color: #68D391;
}
</style>

