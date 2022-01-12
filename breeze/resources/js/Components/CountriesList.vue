<template>
    <div
        class="flex flex-col mt-2 transition-all duration-150"
    >
        <span class="text-sm">{{ title }}</span>
        <div class="flex flex-col mt-2">
            <div
                v-if="countries && countries.length != 0"
                class="flex flex-col"
            >
                <div
                    v-for="country in countries"
                    :key="country.text"
                    class="mb-2 p-2 rounded text-white flex"
                    :style="{ 'background': color }"
                >
                    <span
                        class="flex-1"
                    >{{ country.text }}</span>
                    <span
                        class="fill-white cursor-pointer transition-all duration-150 hover:scale-110 active:scale-100"
                        @click="onDelete(country.id)"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            enable-background="new 0 0 96 96"
                            height="24px"
                            id="circle_cross"
                            version="1.1"
                            viewBox="0 0 96 96"
                            width="24px"
                            xml:space="preserve"
                        >
                            <path
                                d="M48,4C23.7,4,4,23.699,4,48s19.7,44,44,44s44-19.699,44-44S72.3,4,48,4z M48,84c-19.882,0-36-16.118-36-36s16.118-36,36-36  s36,16.118,36,36S67.882,84,48,84z"
                            />
                            <path
                                d="M53.657,48l8.485-8.485c1.562-1.562,1.562-4.095,0-5.656c-1.562-1.562-4.096-1.562-5.658,0L48,42.343l-8.485-8.484  c-1.562-1.562-4.095-1.562-5.657,0c-1.562,1.562-1.562,4.096,0,5.656L42.343,48l-8.485,8.485c-1.562,1.562-1.562,4.095,0,5.656  c1.562,1.562,4.095,1.562,5.657,0L48,53.657l8.484,8.484c1.562,1.562,4.096,1.562,5.658,0c1.562-1.562,1.562-4.096,0-5.656  L53.657,48z"
                            />
                        </svg>
                    </span>
                </div>
            </div>
            <span
                v-else
                class="text-sm"
            >{{ text }}</span>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: String,
        text: String,
        color: String,
        countries: Array,
        onDelete: Function,
    },
    data() {
        return {}
    },

}
</script>