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
                    <form @submit.prevent="catchPokemon()" v-show="!loading">
                        <button class="btn btn-warning" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Catch</button>
                    </form>
                    <div class="modal fade" ref="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">{{ title }}</h5>
                                </div>
                                <div class="modal-body">
                                    <p>{{ message }}</p>
                                    <div v-show="catched">
                                        <div class="d-flex justify-content-center">
                                            <img v-bind:src="'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'+pokemon.id+'.png'" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <form @submit.prevent="savePokemon()" v-show="catched">
                                        <div class="modal-footer d-flex justify-content-center">
                                            <label for="" class="form-label">Nickname</label>
                                            <input type="text" class="form-control" v-model="pokemon.nickname">
                                            <input type="submit" :disabled="pokemon.nickname==''" :value="btnMsg" role="button" class="btn btn-success" data-bs-dismiss="modal">
                                        </div>
                                    </form>
                                    <form @submit.prevent="goHome()" v-show="!catched">
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button role="button" class="btn btn-warning" data-bs-dismiss="modal">{{ btnMsg }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-show="loading" class="spinner-border text-primary mx-4" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
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
            pokemon: {
                nickname:""
            },
            mypokemon: [],
            loading:false,
            title:"",
            message:"",
            catched:false,
            btnMsg:""
        }
    },
    methods: {
        setPokemon(id, name, nickname, types, moves){
            this.pokemon.id = id;
            this.pokemon.name = name;
            this.pokemon.nickname = nickname;
            this.pokemon.types = types;
            this.pokemon.moves = moves;
        },
        catchPokemon(){
            this.loading = true;
            axios.get(`http://127.0.0.1:8000/api/fiftychance`)
            .then((result) => {
                this.loading = false;
                console.log(result.data.data);
                if(result.data.data==true){
                    // this.$router.push('/favorite');
                    // console.log(JSON.parse(localStorage.mypokemon));
                    // console.log(this.mypokemon);
                    this.catched = true;
                    this.title = "Congrats!"
                    this.message = "You get a new pokemon, give a nickname for your new pokemon!"
                    this.btnMsg = "Save the Pokemon"
                }
                else{
                    this.catched = false;
                    this.title = "Failed!"
                    this.message = "Failed to get pokemon, lets try to get another pokemon!"
                    this.btnMsg = "See Another Pokemon"
                }
            })
            .catch((err) => {
                console.log(err);
            });
        },
        goHome(){
            this.$router.push('/');
        },
        savePokemon(){
            if(this.pokemon.nickname!==""){
                if (localStorage.getItem("mypokemon") !== null) {
                    this.mypokemon=JSON.parse(localStorage.mypokemon);
                    localStorage.clear();
                }
                this.pokemon.pokeid = new Date().valueOf();
                this.mypokemon.push(this.pokemon);
                localStorage.setItem("mypokemon", JSON.stringify(this.mypokemon));
                this.$router.push('/favorite');
                // console.log(JSON.parse(localStorage.mypokemon));
                // console.log(this.mypokemon);
            }
        }
    },
    mounted() {
        const route = useRoute();
        axios.get(`https://pokeapi.co/api/v2/pokemon/${route.params.id}`)
        .then((result) => {
            this.setPokemon(
                result.data.id,
                result.data.name,
                "",
                result.data.types,
                result.data.moves
            );
            // result.data.moves.forEach(element => {
            //     console.log(element.move.name);
            // });
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