<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import textInput from '@/Components/TextInput.vue'
import { router } from '@inertiajs/vue3'
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
                Post
            </h2>
        </template>
        <div class="py-12 px-10">
            <div class="my-2 flex justify-between">
                <label for="buscar" class="flex relative">
                    <textInput placeholder="buscar" id="buscar" class="pl-10 " />
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" class="self-center absolute ml-2 ">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10 5.5C7.51472 5.5 5.5 7.51472 5.5 10C5.5 12.4853 7.51472 14.5 10 14.5C10.7763 14.5 11.5046 14.3041 12.1403 13.9596C12.5244 13.7514 12.8751 13.4888 13.182 13.182C13.4888 12.8751 13.7514 12.5244 13.9596 12.1403C14.3041 11.5046 14.5 10.7763 14.5 10C14.5 7.51472 12.4853 5.5 10 5.5ZM4 10C4 6.68629 6.68629 4 10 4C13.3137 4 16 6.68629 16 10C16 11.032 15.7388 12.0052 15.2784 12.855C15.1212 13.145 14.9409 13.4206 14.7399 13.6792L20.003 18.9423L18.9423 20.003L13.6792 14.7399C13.4206 14.9408 13.1451 15.1212 12.855 15.2784C12.0052 15.7388 11.032 16 10 16C6.68629 16 4 13.3137 4 10Z"
                            fill="#1F2328" />
                    </svg>
                </label>
                <PrimaryButton @click="() => { router.get(route('create.post')) }">CREAR POST </PrimaryButton>
            </div>
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6 text-center">Imagen</th>
                            <th scope="col" class="py-3 px-6 text-center">Titulo</th>
                            <th scope="col" class="py-3 px-6 text-center">Descripcion</th>
                            <th scope="col" class="py-3 px-6 text-center">Estado</th>
                            <th scope="col" class="py-3 px-6 text-center">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="(post, p) in Post" :key="p">
                            <td class="py-4 px-6 text-center content-center ">
                                <div :style=" `background-image: url('${post.url_img}');` "
                                    class=" justify-center grid h-20 w-20 bg-cover bg-no-repeat bg-center mx-auto" />
                            </td>
                            <td class="py-4 px-6 text-center ">
                                {{ post.title }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                {{ post.description }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div>
                                <div
                                    class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="toggle" id="toggle" v-model="post.status"
                                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                                    <label for="toggle"
                                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                                <label for="toggle" class="text-xs text-gray-700">{{ post.status.toString() == 'true' ?
                                    'Visible' : 'No visible' }}</label>
                            </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex gap-2 justify-center">
                                    <button>
                                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                            class="text-yellow-400 hover:cursor-pointer self-center ">
                                            <path
                                                d="M5 15L4 16V20H8L14 14M18 10L21 7L17 3L14 6M18 10L17 11M18 10L14 6M14 6L7.5 12.5"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <button>
                                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                            class="text-blue-400 hover:cursor-pointer  self-center ">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 8.25C9.92893 8.25 8.25 9.92893 8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25ZM9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 3.25C7.48587 3.25 4.44529 5.9542 2.68057 8.24686L2.64874 8.2882C2.24964 8.80653 1.88206 9.28392 1.63269 9.8484C1.36564 10.4529 1.25 11.1117 1.25 12C1.25 12.8883 1.36564 13.5471 1.63269 14.1516C1.88206 14.7161 2.24964 15.1935 2.64875 15.7118L2.68057 15.7531C4.44529 18.0458 7.48587 20.75 12 20.75C16.5141 20.75 19.5547 18.0458 21.3194 15.7531L21.3512 15.7118C21.7504 15.1935 22.1179 14.7161 22.3673 14.1516C22.6344 13.5471 22.75 12.8883 22.75 12C22.75 11.1117 22.6344 10.4529 22.3673 9.8484C22.1179 9.28391 21.7504 8.80652 21.3512 8.28818L21.3194 8.24686C19.5547 5.9542 16.5141 3.25 12 3.25ZM3.86922 9.1618C5.49864 7.04492 8.15036 4.75 12 4.75C15.8496 4.75 18.5014 7.04492 20.1308 9.1618C20.5694 9.73159 20.8263 10.0721 20.9952 10.4545C21.1532 10.812 21.25 11.2489 21.25 12C21.25 12.7511 21.1532 13.188 20.9952 13.5455C20.8263 13.9279 20.5694 14.2684 20.1308 14.8382C18.5014 16.9551 15.8496 19.25 12 19.25C8.15036 19.25 5.49864 16.9551 3.86922 14.8382C3.43064 14.2684 3.17374 13.9279 3.00476 13.5455C2.84684 13.188 2.75 12.7511 2.75 12C2.75 11.2489 2.84684 10.812 3.00476 10.4545C3.17374 10.0721 3.43063 9.73159 3.86922 9.1618Z"
                                                fill="currentColor" />
                                        </svg>
                                    </button>
                                    <button>
                                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                            class="text-red-400 hover:cursor-pointer  self-center ">
                                            <path
                                                d="M9.1709 4C9.58273 2.83481 10.694 2 12.0002 2C13.3064 2 14.4177 2.83481 14.8295 4"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path
                                                d="M18.8332 8.5L18.3732 15.3991C18.1962 18.054 18.1077 19.3815 17.2427 20.1907C16.3777 21 15.0473 21 12.3865 21H11.6132C8.95235 21 7.62195 21 6.75694 20.1907C5.89194 19.3815 5.80344 18.054 5.62644 15.3991L5.1665 8.5"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            <path d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
<style scoped >
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
