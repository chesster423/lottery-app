<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lottery</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label>Combination #1</label>
                            <div class="row">
                                <div class="col-2" v-for="(n, index) in 6" :key="index">                        
                                    <select v-model="combinations.comb1[index]" class="form-control">
                                        <option value=""></option>
                                        <option v-for="(option, i) in combination_list"
                                        :key="i" :value="option" v-bind:disabled="combinations.comb1.includes(option)">
                                            {{ option }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label>Combination #2</label>
                            <div class="row">
                                <div class="col-2" v-for="(n, index) in 6" :key="index">
                                    <select v-model="combinations.comb2[index]" class="form-control">
                                        <option value=""></option>
                                        <option v-for="(option, i) in combination_list"
                                        :key="i" :value="option" v-bind:disabled="combinations.comb2.includes(option)">
                                            {{ option }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label>Combination #3</label>
                            <div class="row">
                                <div class="col-2" v-for="(n, index) in 6" :key="index">
                                    <select v-model="combinations.comb3[index]" class="form-control">
                                        <option value=""></option>
                                        <option v-for="(option, i) in combination_list"
                                        :key="i" :value="option" v-bind:disabled="combinations.comb3.includes(option)">
                                            {{ option }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button class="btn btn-primary" v-on:click="submitCombinations()">Submit</button>
                            <button class="btn btn-warning" v-on:click="generateCombinations()">Generate Random Entries</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        data() {
            return {
                combinations : {
                    comb1: [],
                    comb2: [],
                    comb3: []
                },
                combination_list: [],
            }
        },  
        mounted() {
            this.fillCombinationList();
        },
        methods: {
            submitCombinations() {
                
                const payload = {
                    combinations : this.combinations
                }
                return axios.post('./save-entries', payload).then(response => {
                    if(response.data.success) {
                        this.resetCombinations();
                        this.$toastr.s(response.data.msg, "Success!");
                        window.location.reload();
                    }else{
                        response.data.errors.forEach(e => {
                            this.$toastr.w(e, "Warning!");
                        });                        
                    }      
                }).catch(function (error) {
                    this.$toastr.w(error.toJSON().message, "Warning!");
                });
            },
            fillCombinationList() {
                this.combination_list = this.$root.combination_list;
            },
            resetCombinations() {
                this.combinations = {
                    comb1: [],
                    comb2: [],
                    comb3: [],
                };
            },  
            generateCombinations() {
                this.resetCombinations();

                for (const key in this.combinations) {
                    for (let index = 0; index <= 5; index++) {
                        var number = Math.floor(Math.random() * 58) + 1;
                        console.log(number);
                        if (this.combinations[`${key}`].includes(number)) {
                            index -= 1;
                        }else{
                            this.combinations[`${key}`].push( this.combination_list[number] ); 
                        }                                    
                    }
                }
            }
        }
    }
</script>
