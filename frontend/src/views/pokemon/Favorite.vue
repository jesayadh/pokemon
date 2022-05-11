<template>
    <div class="container">
        <figure class="text-center">
            <blockquote class="blockquote">
                <h1>My Pokemon</h1>
            </blockquote>
        </figure>
        <div class="row row-cols-1 row-cols-md-5 g-4">
            <div class="col" v-for="(pokemon, index) in pokemons" :key="index">
                <div class="card">
                    <img v-bind:src="'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'+pokemon.id+'.png'" class="card-img-top" alt="...">
                    <div class="card-body mx-auto">
                        <h5 class="card-title">{{pokemon.nickname}}</h5>
                        <div class="d-flex justify-content-center">
                            <form @submit.prevent="editPokemon(pokemon.pokeid)">
                                <button role="button" class="btn btn-primary m-1"><ion-icon name="create-outline"></ion-icon></button>
                            </form>
                            <form @submit.prevent="removePokemon()">
                                <button role="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">{{ title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ message }}
                                        </div>
                                        <div class="modal-footer">
                                            <form @submit.prevent="deletePokemon(pokemon.pokeid)">
                                                <button v-if="chance" role="button" class="btn btn-danger" data-bs-dismiss="modal">{{btnMsg}}</button>
                                            </form>
                                            <button v-if="!chance" type="button" class="btn btn-primary" data-bs-dismiss="modal">{{btnMsg}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {onMounted, ref} from 'vue';

export default {
    name:"Favorite",
    data() {
        return {
            pokemons: [],
            loading:false,
            title:"",
            message:"",
            btnMsg:"",
            chance:false,
        }
    },
    methods: {
        refreshPokemon(){
            if (localStorage.getItem("mypokemon") !== null) {
                this.pokemons = JSON.parse(localStorage.mypokemon);
            }
        },
        removePokemon(){
            axios.get(`http://127.0.0.1:8000/api/primechance`)
            .then((result) => {
                if(result.data.data%2 == 0){
                    this.title = "You get a chance!"
                    this.message = "Are you sure you release the selected Pokemon?"
                    this.btnMsg = "Release"
                    this.chance = true
                }
                else{
                    this.title = "Failed!"
                    this.message = "You failed to release Pokemon, please try again later!"
                    this.btnMsg = "OK"
                    this.chance = false
                }
            })
            .catch((err) => {
                console.log(err);
            });
        },
        deletePokemon(pokeid){
            var mypokemon = this.pokemons.filter(x => {
                return x.pokeid != pokeid;
            });
            localStorage.clear();
            localStorage.setItem("mypokemon", JSON.stringify(mypokemon));
            this.refreshPokemon();
        },
        editPokemon(pokeid){
            var findId = this.pokemons.findIndex((obj => obj.pokeid == pokeid));
            this.pokemons[findId].nickname = "bud";
            localStorage.clear();
            localStorage.setItem("mypokemon", JSON.stringify(this.pokemons));
            this.refreshPokemon();
            console.log(this.pokemons[findId].nickname);
        }
    },
    mounted() {
        // localStorage.clear();
        this.refreshPokemon();
    }
}
</script>