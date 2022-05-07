<template>
    <div class="container">
        <figure class="text-center">
            <blockquote class="blockquote">
                <h1>Pokemon</h1>
            </blockquote>
        </figure>
        <div class="row row-cols-1 row-cols-md-5 g-4">
            <div class="col" v-for="(pokemon, index) in pokemons.results" :key="index">
                <router-link :to="{ name:'pokemon.detail', params:{id:pokemon.id} }" >
                    <div class="card">
                        <img :src="pokemon.image" class="card-img-top" alt="...">
                        <div class="card-body mx-auto">
                            <h5 class="card-title">{{pokemon.name}}</h5>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {onMounted, ref} from 'vue';

export default {
    setup() {
        let pokemons = ref([]);

        onMounted(()=>{
            axios.get('https://pokeapi.co/api/v2/pokemon')
            .then((result)=>{
                pokemons.value = result.data
                pokemons.value.results.forEach(element => {
                    const pokemonId = element.url.split('/')[element.url.split('/').length - 2];
                    element.id = pokemonId;
                    element.image = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${pokemonId}.png`;
                });
            })
            .catch((err)=>{
                console.log(err.response)
            });
        });

        return {
            pokemons
        }
    },
}
</script>