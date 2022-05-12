<template>
    <div class="container">
        <figure class="text-center">
            <blockquote class="blockquote">
                <h1>Pokemon</h1>
            </blockquote>
        </figure>
        <div class="text-center">
            <div v-show="loading" style="width: 3rem; height: 3rem;" class="spinner-border text-primary mx-4" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div v-show="!loading" class="row row-cols-1 row-cols-md-5 g-4">
            <div class="col" v-for="(pokemon, index) in pokemons.results" :key="index">
                <router-link :to="{ name:'pokemon.detail', params:{id:pokemon.id} }" >
                    <div class="card">
                        <img :src="pokemon.image" class="card-img-top" :alt="pokemon.name">
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
    name:"Detail",
    data() {
        return{
            pokemons:[],
            loading:false,
        }
    },
    mounted(){
        this.loading=true;

        axios.get('https://pokeapi.co/api/v2/pokemon?limit=1126')
        .then((result)=>{
            this.loading=false;
            this.pokemons = result.data;
            this.pokemons.results.forEach(element => {
                const pokemonId = element.url.split('/')[element.url.split('/').length - 2];
                element.id = pokemonId;
                element.image = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${pokemonId}.png`;
            });
        })
        .catch((err)=>{
            console.log(err.response)
        });
    }
}
</script>