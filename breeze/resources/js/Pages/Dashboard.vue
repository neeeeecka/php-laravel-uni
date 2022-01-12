<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight"
            >Dashboard</h2>
        </template>

        <div class="py-12 px-12 flex">
            <div
                class="flex-1 flex flex-col p-2 bg-gray-50"
            >
                <div
                    class="flex w-full justify-center text-white mb-2"
                >
                    <span
                        class="p-2 rounded mr-2"
                        :style="{ 'background': toTravelColor }"
                    >Yet to visit</span>
                    <span
                        class="p-2 rounded mr-2"
                        :style="{ 'background': travelledColor }"
                    >Visited</span>
                </div>
                <div
                    ref="mapRef"
                    class="relative w-full"
                    style="height:700px;"
                ></div>
            </div>
            <div
                class="flex flex-col p-2 w-96 bg-gray-50"
            >
                <div class="flex flex-col">
                    <span
                        class="mb-2"
                    >Select countries to visit.</span>
                    <Select2
                        v-model="countryToVisitID"
                        :options="[]"
                        :settings="{ width: '100%', ajax: ajaxOptionsList }"
                    />
                    <CountriesList
                        :title="'Currently planned'"
                        :text="'You have no countries planned to visit. Choose some.'"
                        :color="toTravelColor"
                        :countries="countriesToVisit"
                        :onDelete="onToVisitDelete"
                    />
                </div>
                <div class="mt-6 flex flex-col">
                    <span
                        class="mb-2"
                    >Select visited countries.</span>
                    <Select2
                        v-model="visitedCountryID"
                        :options="[]"
                        :settings="{ width: '100%', ajax: ajaxOptionsList }"
                    />
                    <CountriesList
                        :title="'Already visited'"
                        :text="'Choose the countries you have visited.'"
                        :color="travelledColor"
                        :countries="visitedCountries"
                        :onDelete="onVisitedDelete"
                    />
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



export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Select2,
        CountriesList
    },
    data() {
        // scoping constant to this component to avoid side-effects
        const cachedCountries = {};
        return {
            datamap: null,
            countryToVisitID: '',
            visitedCountryID: '',
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
            visitedCountries: [],
            countriesToVisit: [],

            toTravelColor: "#BE39FF",
            travelledColor: "#5AE1A1",
        }
    },
    mounted() {
        const { mapRef } = this.$refs;

        const fetchData = async () => {
            axios.get("/api/countries/visited").then(response => {
                this.visitedCountries = response.data;
            });
            axios.get("/api/countries/tovisit").then(response => {
                this.countriesToVisit = response.data;
            });
        };
        fetchData();

        this.datamap = new Datamap({
            element: mapRef,
            projection: 'mercator',
            fills: {
                defaultFill: "#382749",
                travelled: this.travelledColor,
                toTravel: this.toTravelColor,
            },
            data: {
                // USA: { fillKey: "travelled" },
                // DEU: { fillKey: "toTravel" },
            }
        });

    },
    watch: {
        async countryToVisitID(id) {
            const country = this.cachedCountries.current[id];

            const visitedIndex = this.visitedExists(id);
            if (visitedIndex >= 0) {
                this.visitedCountries.splice(visitedIndex, 1);
            }

            this.countriesToVisit.push(country);

            axios.post("/api/add-country-to-visit", {
                country_id: id,
            }).catch((err) => {
                this.countriesToVisit.pop();
                console.error("Error adding to visit country", data);
            });

        },
        async visitedCountryID(id) {
            const country = this.cachedCountries.current[id];

            const toVisitIndex = this.toVisitExists(id);
            if (toVisitIndex >= 0) {
                this.countriesToVisit.splice(toVisitIndex, 1);
            }

            this.visitedCountries.push(country);

            axios.post("/api/add-visited-country", {
                country_id: id,
            }).catch((err) => {
                this.visitedCountries.pop();
                console.error("Error adding visited country", data);
            });

        },
        countriesToVisit: {
            deep: true,
            handler() {
                this.updateMapData();
            }
        },
        visitedCountries: {
            deep: true,
            handler() {
                this.updateMapData();
            }
        }
    },
    methods: {
        onToVisitDelete(id) {
            const index = this.toVisitExists(id);

            const countryTmp = this.countriesToVisit[index];

            this.countriesToVisit.splice(index, 1);

            axios.delete(`/api/remove-country-to-visit/${id}`).catch((err) => {
                this.countriesToVisit.splice(index, 0, countryTmp);
            });

        },
        onVisitedDelete(id) {
            const index = this.visitedExists(id);

            const countryTmp = this.visitedCountries[index];

            this.visitedCountries.splice(index, 1);

            axios.delete(`/api/remove-visited-country/${id}`).catch((err) => {
                this.visitedCountries.splice(index, 0, countryTmp);
            });
        },
        updateMapData() {
            console.log("Updating map data");

            const newMapData = {};

            this.visitedCountries.forEach(visitedCountry => {
                newMapData[visitedCountry.code] = { fillKey: "travelled" }
            });
            this.countriesToVisit.forEach(countryToVisit => {
                newMapData[countryToVisit.code] = { fillKey: "toTravel" }
            });

            console.log(newMapData);
            this.datamap.updateChoropleth(newMapData, { reset: true });

        },
        visitedExists(id) {
            return this.visitedCountries.findIndex((country) => {
                return country.id == id;
            });
        },
        toVisitExists(id) {
            return this.countriesToVisit.findIndex((country) => {
                return country.id == id;
            });
        }
    }
}
</script>
