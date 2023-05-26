<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">History</div>

                    <div class="card-body">
                        <table class="table table-striped">                            
                            <tbody>
                                <tr>
                                    <th>Date</th>
                                    <th>Ball numbers</th>
                                </tr>
                                <tr v-for="(entry, i) in entries">
                                    <td >{{ entry.created_at | formatDate }}</td>
                                    <td >{{ entry.combinations }}</td>
                                </tr>
                            </tbody>
                            
                        </table>
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
                entries: [],
            }
        },  
        mounted() {
            this.getUserEntries();
        },
        methods: {
            getUserEntries() {
        
                return axios.get('./fetch-user-entries').then(response => {
                    if(response.data.success) {
                        this.entries = response.data.data;
                    }else{
                        response.data.errors.forEach(e => {
                            this.$toastr.w(e, "Warning!");
                        });                     
                    }      
                }).catch(function (error) {
                    this.$toastr.w(error.toJSON().message, "Warning!");
                });
            },
        }
    }
</script>
