<template>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img v-bind:src="'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'+pokemon.id+'.png'" class="img-fluid rounded-start" style="width:100%;" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ pokemon.name }}</h1>
                    <h5 class="card-text">Types</h5>
                    <div class="scrollmenu">
                        <div class="btn btn-outline-success" v-for="(types, index) in pokemon.types" :key="index">{{types.type.name}}</div>
                    </div>
                    <h5 class="card-text">Moves</h5>
                    <div class="scrollmenu">
                        <div class="btn btn-outline-danger" v-for="(moves, index) in pokemon.moves" :key="index">{{moves.move.name}}</div>
                    </div>
                    <br>
                    <a class="btn btn-warning" href="#" role="button">Catch</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

export default {
    name:"Detail",
    data(){
        return {
            pokemon: {}
        }
    },
    methods: {
        setPokemon(data){
            this.pokemon = data;
        }
    },
    mounted() {
        const route = useRoute();
        axios.get(`https://pokeapi.co/api/v2/pokemon/${route.params.id}`)
        .then((result) => {
            this.setPokemon(result.data);
            result.data.moves.forEach(element => {
                console.log(element.move.name);
            });
        })
        .catch((err) => {
            console.log(err.response);
        });
    },
}
</script>

<style>
    div.scrollmenu {
    overflow: auto;
    white-space: nowrap;
    }
    div.btn {
        margin-right: 10px;
        margin-bottom: 10px;
    }
</style>