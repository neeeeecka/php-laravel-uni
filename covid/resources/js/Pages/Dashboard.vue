<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight"
            >Covid-Life Dashboard</h2>
        </template>

        <div class="py-12 px-12 flex">
            <div
                class="flex-1 flex flex-col p-2 bg-gray-50"
            >
                <span class="mb-2">World Map</span>

                <div
                    class="flex w-full justify-center text-white mb-2"
                >
                    <span
                        class="p-2 rounded mr-2"
                        :style="{ 'background': selectedColor }"
                    >Selected</span>
                    <span
                        class="p-2 rounded mr-2"
                        :style="{ 'background': '#382749' }"
                    >unselected</span>
                </div>
                <div
                    ref="mapRef"
                    class="relative w-full"
                    style="height:600px;"
                ></div>
            </div>
            <div
                class="bg-white flex flex-col px-3 py-2"
                style="min-width: 400px;"
            >
                <span class="mb-2">Statistics</span>
                <div class="flex flex-col">
                    <StatsCard />
                </div>
                <div
                    class="flex flex-col mt-2"
                >
                    <span
                        class="mb-2"
                    >Select countries to see covid statistics.</span>
                    <Select2
                        v-model="selectedCountryID"
                        :options="[]"
                        :settings="{ width: '100%', ajax: ajaxOptionsList }"
                    />
                    <div
                        class="flex flex-col mt-2"
                    >
                        <StatsCard
                            v-for="country in selectedCountries"
                            :key="country.id"
                            :country="country"
                            :onDelete="onSelectedDelete"
                        />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Select2 from 'vue3-select2-component';
import CountriesList from '@/Components/CountriesList.vue';
import axios from 'axios';
import StatsCard from '@/Components/StatsCard.vue';


export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Select2,
        CountriesList,
        StatsCard
    },
    data() {
        // scoping constant to this component to avoid side-effects
        const cachedCountries = {};
        return {
            datamap: null,
            selectedCountryID: '',
            cachedCountries: { current: cachedCountries }, // make it un-reactive
            ajaxOptionsList: {
                url: "/api/countries/list",
                dataType: 'json',
                processResults: (data) => {
                    const { results } = data;
                    results.forEach((country) => {
                        cachedCountries[country.id] = country;
                    });
                    return data;
                }
            },
            selectedCountries: [],

            selectedColor: "#9FCA42",
        }
    },
    mounted() {
        const { mapRef } = this.$refs;

        const fetchData = async () => {
            axios.get("/api/countries/selected").then(response => {
                this.selectedCountries = response.data;
            });
        };
        fetchData();

        this.datamap = new Datamap({
            element: mapRef,
            projection: 'mercator',
            fills: {
                defaultFill: "#382749",
                selected: this.selectedColor,
            },
            data: {

            }
        });

    },
    watch: {
        async selectedCountryID(id) {
            const country = this.cachedCountries.current[id];

            this.selectedCountries.push(country);

            axios.post("/api/add-selected-country", {
                country_id: id,
            }).catch((err) => {
                this.selectedCountries.pop();
                console.error("Error adding to visit country", data);
            });

        },

        selectedCountries: {
            deep: true,
            handler() {
                this.updateMapData();
            }
        }
    },
    methods: {
        onSelectedDelete(id) {
            const index = this.selectedExists(id);

            const countryTmp = this.selectedCountries[index];

            this.selectedCountries.splice(index, 1);

            axios.delete(`/api/remove-selected-country/${id}`).catch((err) => {
                this.selectedCountries.splice(index, 0, countryTmp);
            });
        },
        updateMapData() {
            console.log("Updating map data");

            const newMapData = {};

            this.selectedCountries.forEach(selectedCountry => {
                newMapData[selectedCountry.code] = { fillKey: "selected" }
            });

            console.log(newMapData);
            this.datamap.updateChoropleth(newMapData, { reset: true });

        },
        selectedExists(id) {
            return this.selectedCountries.findIndex((country) => {
                return country.id == id;
            });
        },
    }
}
</script>
