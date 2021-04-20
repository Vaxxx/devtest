<template>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h2 class="card-header">Gigs  <router-link to="/addgig" class="btn btn-primary btn-xs d-flex float-right">New gig &nbsp; <i class="fas fa-plus"></i></router-link> </h2>
                    <div class="row mt-3 p-4">
                        <div class="col-md-4">
                            All gigs <span class="badge rounded-pill bg-danger text-white p-2">{{gigLength}}</span>
                            <hr style="background-color: #fbb30b; width: 100px">
                        </div>
                        <div class="col-md-4">
                            My gig <span class="badge rounded-pill bg-danger text-white p-2">0</span>
                            <hr style="background-color: #fbb30b; width: 100px">
                        </div>
                        <div class="col-md-4">
                            Rejected gigs <span class="badge rounded-pill bg-danger text-white p-2">0</span>
                            <hr style="background-color: #fbb30b; width: 100px">
                        </div>
                    </div>
                    <div class="card-body text-center">
                       <table class="table table-responsive table-responsive-sm w-auto ml-4" >
                           <tr >
                               <th scope="col"> Role</th>
                               <th scope="col"> Company</th>
                               <th scope="col"> Date</th>
                               <th scope="col"> Salary</th>
                               <th scope="col"> Actions</th>
                           </tr>
                           <tr v-for="gig in gigs" :key="gig.id">
                               <td>{{gig.role}}</td>
                               <td>{{gig.company}}</td>
                               <td>{{gig.created_at}}</td>
                               <td>{{gig.salarymin}}-{{gig.salarymax}}</td>
                               <td><button class="btn btn-danger btn-sm" @click.prevent="deleteGig(gig.id)"> <i class="fas fa-trash"></i> </button> </td>
                           </tr>

                       </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'GigComponent',
        data(){
            return{
                gigs: [],
                gigLength:''
            }
        },
        methods: {
            getGigs(){
                let url = '/api/gigs';
                axios.get(url).then(response => {
                    this.gigs = response.data
                    this.gigLength = this.gigs.length
                    console.log(this.gigs);
                });
            },
            deleteGig(id){
                if(confirm("Do you really want to delete?")) {
                    let url = `/api/gigs/${id}`;
                    axios.delete(url).then(response => {
                        if (response.status) {
                            this.getGigs();
                            // Swal.fire({
                            //     position: 'top-end',
                            //     icon: 'success',
                            //     title: "Deleted Successfully",
                            //     text: response.message,
                            //     showConfirmButton: false,
                            //     timer: 1500
                            // })
                        } else {
                            // Swal.fire({
                            //     position: 'top-end',
                            //     icon: 'error',
                            //     title: "Error in deleting",
                            //     text: response.message,
                            //     showConfirmButton: false,
                            //     timer: 1500
                            // })
                        }
                    });
                }
            }//deleteGig
        },
        mounted() {
            this.getGigs();

        }
    }
</script>
