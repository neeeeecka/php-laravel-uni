<template>
    <div
        class="bg-white flex shadow rounded flex-col px-2.5 py-2 my-2"
    >
        <div v-if="todayCases != null">
            <div class="flex">
                <span
                    class="flex items-center"
                >
                    <span>
                        <img
                            :src="image == null ? worldImage : image"
                            class="shadow-md"
                            width="24"
                        />
                    </span>
                    <h1
                        class="ml-2"
                    >{{ country ? country.text : "World" }}</h1>
                </span>
                <span
                    v-if="country"
                    @click="handleOnDelete"
                    class="ml-auto mr-0 cursor-pointer transition-all duration-150 hover:scale-110 active:scale-100"
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
            <div
                class="flex mt-1.5 py-2 gap-1 justify-evenly text-sm text-center"
            >
                <div
                    class="flex flex-col items-center"
                >
                    <span>{{ todayCases }}</span>
                    <span>Today cases</span>
                </div>
                <div
                    class="flex flex-col items-center"
                >
                    <span>{{ todayDeaths }}</span>

                    <span>Today deaths</span>
                </div>
                <div
                    class="flex flex-col items-center"
                >
                    <span>{{ todayRecovered }}</span>
                    <span>Today recovered</span>
                </div>
            </div>
        </div>
        <div
            v-else
            class="flex loading justify-center"
        >
            <svg
                class="loading__spinner"
                version="1.1"
                id="L9"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px"
                y="0px"
                viewBox="0 0 100 100"
                enable-background="new 0 0 0 0"
                xml:space="preserve"
            >
                <path
                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50"
                >
                    <animateTransform
                        attributeName="transform"
                        attributeType="XML"
                        type="rotate"
                        dur="1s"
                        from="0 50 50"
                        to="360 50 50"
                        repeatCount="indefinite"
                    />
                </path>
            </svg>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    props: {
        country: Object,
        onDelete: Function,
    },
    data() {
        return {
            todayCases: null,
            todayDeaths: null,
            todayRecovered: null,
            image: null,
            worldImage: '/img/world.svg'
        }
    },
    async mounted() {
        let response;
        if (this.country) {
            response = await axios.get(`https://disease.sh/v3/covid-19/countries/${this.country.code}`);
        } else {
            response = await axios.get(`https://disease.sh/v3/covid-19/all`)
        }

        if (response.data) {
            const { todayCases, todayDeaths, todayRecovered, countryInfo } = response.data;
            this.todayCases = todayCases;
            this.todayDeaths = todayCases;
            this.todayRecovered = todayRecovered;

            this.image = countryInfo ? countryInfo.flag : null;
            // console.log(response.data);
        }
    }
    ,
    methods: {
        handleOnDelete() {
            if (this.country) {
                this.onDelete(this.country.id);
            }
        }
    }
}
</script>
<style scoped>
.loading {
}
.loading__spinner {
    width: 50px;
    height: 50px;
    display: inline-block;
    fill: black;
}
</style>